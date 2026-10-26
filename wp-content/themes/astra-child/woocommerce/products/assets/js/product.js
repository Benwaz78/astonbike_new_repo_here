(function () {
    'use strict';

/**
* Get variation data for a product.
*/
function getVariations(container) {
    try {
        const data = JSON.parse(
            container.dataset.productVariations || '[]'
        );

        return Array.isArray(data) ? data : [];
    } catch (error) {
        console.error('Unable to read product variations.', error);
        return [];
    }
}

/**
 * Get the customer's current attribute selections.
 */
function getSelections(container) {
    const selections = {};

    container.querySelectorAll('.attribute-item').forEach(function (group) {
        const selected = group.querySelector('.variation-option.is-selected');

        if (selected) {
            selections[selected.dataset.attribute] = selected.dataset.value;
        }
    });

    return selections;
}

/**
 * Check whether a variation matches the current selections.
 * An empty variation attribute matches any selection for that attribute.
 */
function matchesSelections(variation, selections) {
    return Object.entries(selections).every(function ([attribute, value]) {
        const variationValue = variation.attributes[attribute];

        return variationValue === '' || variationValue === value;
    });
}


function findMatchingVariation(variations, selections, container) {
    if (!Array.isArray(variations) || !variations.length) {
        return null;
    }

    const groups = container.querySelectorAll('.attribute-item');

    // Wait until every attribute has been selected.
    if (Object.keys(selections).length !== groups.length) {
        return null;
    }

    return variations.find(function (variation) {
        return Object.entries(variation.attributes).every(
            function ([attribute, value]) {
                return value === '' || value === selections[attribute];
            }
        );
    }) || null;
}



/**
 * Update the variation availability message.
 */
function updateAvailability(productContent, variation) {
    const stockElement = productContent.querySelector(
        '[data-product-stock] strong'
    );

    if (!stockElement) {
        return;
    }

    if (!variation) {
        stockElement.textContent = 'Choose options to check availability';
        return;
    }

    if (!variation.is_in_stock) {
        stockElement.textContent = 'Out of stock';
        return;
    }

    if (variation.is_on_backorder) {
        stockElement.textContent = 'Available on backorder';
        return;
    }

   const quantity = variation.stock_quantity;

    if (quantity !== null && quantity !== undefined) {
        stockElement.textContent = Number(quantity) > 0
            ? quantity + ' in stock'
            : 'Out of stock';

        return;
    }

    stockElement.textContent = 'In stock';
}


/**
 * Update the single-product price for the selected variation.
 */
function updatePrice(productContent, variation) {
    const priceElement = productContent.querySelector(
        '[data-product-price]'
    );

    if (!priceElement || !variation) {
        return;
    }

    const currentPrice = Number(variation.display_price);
    const regularPrice = Number(variation.display_regular_price);

    if (
        !Number.isFinite(currentPrice) ||
        !Number.isFinite(regularPrice)
    ) {
        return;
    }

    const formatPrice = function (price) {
        return priceElement.dataset.currencySymbol
            ? priceElement.dataset.currencySymbol + price.toLocaleString(
                'en-NG',
                {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }
            )
            : price.toLocaleString('en-NG', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
    };

    const currentElements = priceElement.querySelectorAll(
        '[data-price-current]'
    );

    const regularElement = priceElement.querySelector(
        '[data-price-regular]'
    );

    if (!currentElements.length) {
        return;
    }

    // Update the first current-price element and remove the range endpoint.
    currentElements[0].textContent = formatPrice(currentPrice);

    currentElements.forEach(function (element, index) {
        if (index > 0) {
            element.remove();
        }
    });

    // Remove the range separator left behind by the original price range.
    const walker = document.createTreeWalker(
        priceElement,
        NodeFilter.SHOW_TEXT
    );

    let node;

    while ((node = walker.nextNode())) {
        if (node.nodeValue.includes('–')) {
            node.nodeValue = node.nodeValue.replace('–', '');
            break;
        }
    }

    if (currentPrice < regularPrice) {
        if (regularElement) {
            regularElement.textContent = formatPrice(regularPrice);
            regularElement.hidden = false;
        }
    } else if (regularElement) {
        regularElement.hidden = true;
    }
}


/**
 * Update the product SKU.
 */
function updateSKU(productContent, variation) {
    const skuElement = productContent.querySelector('[data-product-sku]');

    if (skuElement && variation) {
        skuElement.textContent = variation.sku || 'N/A';
    }
}

/**
 * Update the product image.
 */
function updateImage(productContent, variation) {
    if (!variation || !variation.image || !variation.image.src) {
        return;
    }

    const mainImage = productContent.querySelector('.product-main-image');

    if (mainImage) {
        mainImage.src = variation.image.src;
        mainImage.srcset = variation.image.srcset || '';
        mainImage.alt = variation.image.alt || '';
    }
}

    
/**
 * Apply the default attributes configured in WooCommerce admin.
 */
function applyDefaultVariation(container) {
    let defaults = {};

    try {
        defaults = JSON.parse(
            container.dataset.defaultAttributes || '{}'
        );
    } catch (error) {
        console.error('Unable to read default product attributes.', error);
        return;
    }

    const groups = Array.from(
        container.querySelectorAll('.attribute-item')
    );

    // Do nothing if no defaults are configured or not all attributes
    // have a default value.
    if (
        !Object.keys(defaults).length ||
        Object.keys(defaults).length !== groups.length
    ) {
        return;
    }

    // Select the matching option for each default attribute.
    const selections = {};

    for (const [key, value] of Object.entries(defaults)) {
        const attribute = key.startsWith('attribute_')
            ? key
            : 'attribute_' + key;

        const group = groups.find(function (item) {
            return item.querySelector('.variation-option')?.dataset.attribute
                === attribute;
        });

        if (!group) {
            return;
        }

        const button = Array.from(
            group.querySelectorAll('.variation-option')
        ).find(function (option) {
            return option.dataset.value === String(value);
        });

        if (!button) {
            return;
        }

        selections[attribute] = String(value);
    }

    if (Object.keys(selections).length !== groups.length) {
        return;
    }

    const variations = getVariations(container);
    const variation = findMatchingVariation(
        variations,
        selections,
        container
    );

    // Don't automatically select an unavailable default variation.
    if (
        !variation ||
        variation.is_purchasable === false ||
        (
            !variation.is_in_stock &&
            !variation.backorders_allowed &&
            !variation.is_on_backorder
        )
    ) {
        return;
    }

    // Apply the selected state to the matching buttons.
    groups.forEach(function (group) {
        group.querySelectorAll('.variation-option').forEach(function (button) {
            const selected =
                button.dataset.value ===
                selections[button.dataset.attribute];

            button.classList.toggle('is-selected', selected);
            button.setAttribute('aria-pressed', String(selected));
        });
    });

    const productContent = container.closest('.shop-product-content');

    if (!productContent) {
        return;
    }

    const variationInput = container.querySelector(
        'input[name="variation_id"]'
    );

    if (variationInput) {
        variationInput.value = variation.variation_id;
    }

    updateAvailability(productContent, variation);
    updatePrice(productContent, variation);
    updateSKU(productContent, variation);
    updateImage(productContent, variation);

    // Notify the pricing module and any other listeners.
    container.dispatchEvent(
        new CustomEvent('product:variation-change', {
            bubbles: true,
            detail: {
                variation: variation,
                selections: selections
            }
        })
    );
}


/**
 * Initialize default variations on page load.
 */

function initializeDefaultVariations(root = document) {
    root.querySelectorAll('[data-variation-options]').forEach(
        applyDefaultVariation
    );
}


function initializeProductPrices(root = document) {
    root.querySelectorAll('.shop-product-content').forEach(
        storeInitialPrice
    );
}

// Make the functions available to quick-view.js.
window.initializeDefaultVariations = initializeDefaultVariations;
window.initializeProductPrices = initializeProductPrices;

// Initialize products already present on page load.
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
        initializeDefaultVariations();
        initializeProductPrices();
    });
} else {
    initializeDefaultVariations();
    initializeProductPrices();
}



/**
 * Save the initial product price markup for reset.
 */
function storeInitialPrice(productContent) {
    const priceElement = productContent.querySelector(
        '[data-product-price]'
    );

    if (!priceElement || priceElement.dataset.initialPrice) {
        return;
    }

    priceElement.dataset.initialPrice = priceElement.innerHTML;
}


/**
 * Restore the initial product price markup.
 */
function resetPrice(productContent) {
    const priceElement = productContent.querySelector(
        '[data-product-price]'
    );

    if (
        priceElement &&
        priceElement.dataset.initialPrice !== undefined
    ) {
        priceElement.innerHTML = priceElement.dataset.initialPrice;
    }
}
/**
 * Handle variation button clicks.
 */
document.addEventListener('click', function (event) {
     
    const button = event.target.closest(
        '[data-variation-options] .variation-option'
    );

    if (!button) {
        return;
    }

    const container = button.closest('[data-variation-options]');
    const productContent = button.closest('.shop-product-content');

    if (!container || !productContent) {
        return;
    }

    const group = button.closest('.attribute-item');

    if (!group) {
        return;
    }

    group.querySelectorAll('.variation-option').forEach(function (option) {
        option.classList.remove('is-selected');
        option.setAttribute('aria-pressed', 'false');
    });

    button.classList.add('is-selected');
    button.setAttribute('aria-pressed', 'true');



    const selections = getSelections(container);
    const variations = getVariations(container);
   
    const variation = findMatchingVariation(
        variations,
        selections,
        container
    );

    const variationInput = container.querySelector(
        'input[name="variation_id"]'
    );

    if (variationInput) {
        variationInput.value = variation
            ? variation.variation_id
            : '';
    }

    if (variation) {
        updateAvailability(productContent, variation);
        updatePrice(productContent, variation);
        updateSKU(productContent, variation);
        updateImage(productContent, variation);
    } else {
        updateAvailability(productContent, null);
        updateSKU(productContent, null);
    }

    container.dispatchEvent(
        new CustomEvent('product:variation-change', {
            bubbles: true,
            detail: {
                variation: variation,
                selections: selections
            }
        })
    );
});

    /**
     * Clear all selected attributes.
     */

 document.addEventListener('click', function (event) {
    const resetButton = event.target.closest('.variation-reset');

    if (!resetButton) {
        return;
    }

    const container = resetButton.closest('[data-variation-options]');
    const productContent = resetButton.closest('.shop-product-content');

    if (!container || !productContent) {
        return;
    }

    container.querySelectorAll('.variation-option').forEach(function (button) {
        button.classList.remove('is-selected');
        button.setAttribute('aria-pressed', 'false');
    });

    const variationInput = container.querySelector(
        'input[name="variation_id"]'
    );

    if (variationInput) {
        variationInput.value = '';
    }

    updateAttributeLabels(container);
    updateAvailability(productContent, null);

    // Restore the original product price range.
    resetPrice(productContent);

    // Restore the original product SKU and image.
    updateSKU(productContent, null);
    updateImage(productContent, null);

    container.dispatchEvent(
        new CustomEvent('product:variation-reset', {
            bubbles: true
        })
    );
});

})();

