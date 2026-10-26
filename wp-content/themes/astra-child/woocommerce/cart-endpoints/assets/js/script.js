function updateCartCount(count) {

    /*
     * Cart canvas count.
     */
    const cartCounts =
        document.querySelectorAll('.prd__count');

    cartCounts.forEach(function (element) {

        element.textContent = count;

    });


    /*
     * Header cart badge.
     */
    const headerCartCounts =
        document.querySelectorAll('.number-order');

    headerCartCounts.forEach(function (element) {

        element.textContent = count;

    });

}

function loadCart() {

    const formData =
        new FormData();

    formData.append(
        'action',
        'oltouch_get_cart'
    );


    fetch(
        oltouchCart.ajax_url,
        {
            method: 'POST',
            body: formData
        }
    )

    .then(function (response) {

        return response.json();

    })

    .then(function (response) {

        console.log(
            'Get cart response:',
            response
        );


        if (!response.success) {

            console.error(
                response.data?.message ||
                'Unable to load cart.'
            );

            return;
        }


        const cart =
            response.data;


        /*
         * Render cart items.
         */
        updateCartItems(
            cart.items
        );


        /*
         * Update cart count.
         */
        updateCartCount(
            cart.cart_count
        );


        /*
         * Update cart total.
         */
        updateCartTotal(
            cart.cart_total
        );

    })

    .catch(function (error) {

        console.error(
            'Oltouch Get Cart Error:',
            error
        );

    });

}

function getCart() {

    const formData = new FormData();

    formData.append(
        'action',
        'oltouch_get_cart'
    );


    return fetch(oltouchCart.ajax_url, {
        method: 'POST',
        body: formData
    })

    .then(function (response) {

        return response.json();

    })

    .then(function (response) {

        if (!response.success) {

            throw new Error(
                response.data?.message ||
                'Unable to get cart.'
            );

        }

        return response.data;

    });

}



function updateCartItems(items) {

    const cartItems =
        document.querySelector('.tf-mini-cart-items');

    if (!cartItems) {
        return;
    }


    const template =
        cartItems.querySelector(
            '[data-cart-item-template]'
        );

    if (!template) {
        return;
    }


    /*
     * Remove every generated cart item.
     */
    cartItems
        .querySelectorAll(
            '.tf-mini-cart-item[data-cart-item]'
        )
        .forEach(function (item) {

            item.remove();

        });

        /*
    * Empty cart message.
    */
    const emptyMessage =
        cartItems.querySelector('.box-text_empty');


    /*
    * Cart is empty.
    */
    if (!items || !items.length) {

        template.style.display = 'none';

        if (emptyMessage) {

            emptyMessage.style.display = '';

        }

        return;
    }


    /*
    * Cart has products.
    */
    if (emptyMessage) {

        emptyMessage.style.display = 'none';

    }


    /*
    * Hide the original template.
    */
    template.style.display = 'none';


    


    /*
     * Hide template.
     */
    template.style.display = 'none';


    /*
     * Create cart items.
     */
    items.forEach(function (item) {

        const cartItem =
            template.cloneNode(true);


        /*
         * Mark this as a generated cart item.
         */
        cartItem.removeAttribute(
            'data-cart-item-template'
        );

        cartItem.setAttribute(
            'data-cart-item',
            ''
        );


        cartItem.style.display = '';


        /*
         * Store WooCommerce cart item key.
         */
        cartItem.dataset.cartItemKey =
            item.cart_item_key;


        /*
         * Product image.
         */
        const image =
            cartItem.querySelector(
                '.tf-mini-cart-image img'
            );

        if (image) {

            image.src =
                item.image || '';

            image.alt =
                item.name || '';

        }


        /*
         * Product links.
         */
        const imageLink =
            cartItem.querySelector(
                '.tf-mini-cart-image'
            );

        const nameLink =
            cartItem.querySelector(
                '.tf-mini-cart-info .name'
            );


        if (imageLink) {

            imageLink.href =
                item.url;

        }


        if (nameLink) {

            nameLink.href =
                item.url;

            nameLink.textContent =
                item.name;

        }


        /*
         * Product price.
         */
        const price =
            cartItem.querySelector(
                '.tf-mini-card-price'
            );

        if (price) {

            price.innerHTML =
                item.subtotal_html;

        }


        /*
         * Regular price.
         */
        const oldPrice =
            cartItem.querySelector(
                '.price-old'
            );


        if (oldPrice) {

            if (
                item.on_sale &&
                item.regular_price_html
            ) {

                oldPrice.innerHTML =
                    item.regular_price_html;

                oldPrice.style.display =
                    '';

            } else {

                oldPrice.innerHTML =
                    '';

                oldPrice.style.display =
                    'none';

            }

        }


        /*
         * Quantity.
         */
        const quantity =
            cartItem.querySelector(
                '.quantity-product'
            );

        if (quantity) {

            quantity.value =
                item.quantity;

        }


        /*
         * Quantity buttons.
         */
        cartItem
            .querySelectorAll('.btn-quantity')
            .forEach(function (button) {

                button.dataset.cartItemKey =
                    item.cart_item_key;

            });


        /*
         * Remove button.
         */
        const removeButton =
            cartItem.querySelector('.remove');

        if (removeButton) {

            removeButton.dataset.cartItemKey =
                item.cart_item_key;

        }


        /*
         * Variation.
         */
        const variationBox =
            cartItem.querySelector(
                '.tf-prd-select'
            );

        const select =
            cartItem.querySelector(
                '.tf-prd-select select'
            );


        if (
            item.variation &&
            item.variation.length
        ) {

            const variation =
                item.variation[0];


            const typeText =
                cartItem.querySelector(
                    '.tf-prd-select .type-text'
                );


            if (typeText) {

                typeText.textContent =
                    variation.name + ': ';

            }


            if (select) {

                select.innerHTML = '';

                const option =
                    document.createElement(
                        'option'
                    );

                option.textContent =
                    variation.value;

                option.value =
                    variation.value;

                option.selected = true;

                select.appendChild(
                    option
                );

            }

        } else {

            /*
             * Simple product.
             */
            if (variationBox) {

                variationBox.remove();

            }

        }


        /*
         * Add generated item.
         */
        cartItems.appendChild(
            cartItem
        );

    });

}

function updateCartTotal(total) {

    const totals =
        document.querySelectorAll(
            '.tf-totals-total-value'
        );


    totals.forEach(function (element) {

        element.innerHTML = total;

    });

}



document.addEventListener('click', function (event) {

    const button =
        event.target.closest('.oltouch-add-to-cart');

    if (!button) {
        return;
    }

    event.preventDefault();


    const productId =
        button.dataset.product_id;

    const quantity =
        button.dataset.quantity || 1;


    if (!productId) {
        return;
    }


    /*
     * Prevent double clicking.
     */
    if (button.classList.contains('loading')) {
        return;
    }

    button.classList.add('loading');


    /*
     * Prepare AJAX request.
     */
    const formData = new FormData();

    formData.append(
        'action',
        'oltouch_add_to_cart'
    );

    formData.append(
        'product_id',
        productId
    );

    formData.append(
        'quantity',
        quantity
    );


    /*
     * Send AJAX request.
     */
    fetch(oltouchCart.ajax_url, {
        method: 'POST',
        body: formData
    })

    .then(function (response) {

        return response.json();

    })

    .then(function (response) {

        /*
         * AJAX / WooCommerce error.
         */
        if (!response.success) {

            alert(
                response.data?.message ||
                'Unable to add product to cart.'
            );

            return;
        }


        /*
         * Update cart count.
         */
        getCart().then(function (cart) {

            console.log('Cart data:', cart);

            updateCartCount(
                cart.cart_count
            );

            updateCartItems(
                cart.items
            );

            updateCartTotal(
                cart.cart_total
            );

    });


        /*
         * Open shopping cart.
         */
        const shoppingCart =
            document.getElementById('shoppingCart');


        if (
            shoppingCart &&
            typeof bootstrap !== 'undefined'
        ) {

            const offcanvas =
                bootstrap.Offcanvas.getOrCreateInstance(
                    shoppingCart
                );

            offcanvas.show();

        }

    })

    .catch(function (error) {

        console.error(
            'Oltouch Add to Cart Error:',
            error
        );

        alert(
            'Something went wrong. Please try again.'
        );

    })

    .finally(function () {

        button.classList.remove('loading');

    });

});


document.addEventListener('click', function (event) {

    const button =
        event.target.closest('.tf-mini-cart-item .remove');

    if (!button) {
        return;
    }

    event.preventDefault();

    const cartItemKey =
        button.dataset.cartItemKey;

    if (!cartItemKey) {
        console.error('Missing cart item key.');
        return;
    }

    if (button.classList.contains('loading')) {
        return;
    }

    button.classList.add('loading');


    const formData = new FormData();

    formData.append(
        'action',
        'oltouch_remove_from_cart'
    );

    formData.append(
        'cart_item_key',
        cartItemKey
    );


    fetch(oltouchCart.ajax_url, {

        method: 'POST',
        body: formData

    })

    .then(function (response) {

        return response.json();

    })

    .then(function (response) {

        console.log(
            'Remove cart response:',
            response
        );


        if (!response.success) {

            alert(
                response.data?.message ||
                'Unable to remove product from cart.'
            );

            return;
        }


        /*
         * Get updated cart.
         */
        const cart =
            response.data.cart;


        /*
         * Re-render cart items.
         */
        updateCartItems(
            cart.items
        );


        /*
         * Update cart count.
         */
        updateCartCount(
            cart.cart_count
        );


        /*
         * Update cart total.
         */
        updateCartTotal(
            cart.cart_total
        );

    })

    .catch(function (error) {

        console.error(
            'Oltouch Remove From Cart Error:',
            error
        );

        alert(
            'Something went wrong. Please try again.'
        );

    })

    .finally(function () {

        button.classList.remove(
            'loading'
        );

    });

});

document.addEventListener('click', function (event) {

    const button =
        event.target.closest(
            '.tf-mini-cart-item[data-cart-item] .btn-quantity'
        );

    if (!button) {
        return;
    }

    event.preventDefault();


    const cartItem =
        button.closest(
            '.tf-mini-cart-item[data-cart-item]'
        );

    if (!cartItem) {
        return;
    }


    const cartItemKey =
        cartItem.dataset.cartItemKey;

    if (!cartItemKey) {
        console.error(
            'Missing cart item key.'
        );

        return;
    }


    const quantityInput =
        cartItem.querySelector(
            '.quantity-product'
        );

    if (!quantityInput) {
        return;
    }


    let quantity =
        parseInt(
            quantityInput.value,
            10
        ) || 1;


    /*
     * Determine whether this is
     * the plus or minus button.
     */
    if (
        button.classList.contains(
            'plus-btn'
        )
    ) {

        quantity++;

    } else if (
        button.classList.contains(
            'minus-btn'
        )
    ) {

        quantity--;

    }


    /*
     * Quantity cannot go below 1.
     */
    quantity =
        Math.max(
            1,
            quantity
        );


    /*
     * Prevent multiple requests.
     */
    if (
        cartItem.classList.contains(
            'loading'
        )
    ) {
        return;
    }


    cartItem.classList.add(
        'loading'
    );


    /*
     * Prepare AJAX request.
     */
    const formData =
        new FormData();


    formData.append(
        'action',
        'oltouch_update_quantity'
    );


    formData.append(
        'cart_item_key',
        cartItemKey
    );


    formData.append(
        'quantity',
        quantity
    );


    /*
     * Send request.
     */
    fetch(
        oltouchCart.ajax_url,
        {
            method: 'POST',
            body: formData
        }
    )

    .then(function (response) {

        return response.json();

    })

    .then(function (response) {

        console.log(
            'Update quantity response:',
            response
        );


        if (!response.success) {

            alert(
                response.data?.message ||
                'Unable to update quantity.'
            );

            return;
        }


        /*
         * Get updated cart.
         */
        const cart =
            response.data.cart;


        /*
         * Re-render cart items.
         */
        updateCartItems(
            cart.items
        );


        /*
         * Update cart count.
         */
        updateCartCount(
            cart.cart_count
        );


        /*
         * Update cart total.
         */
        updateCartTotal(
            cart.cart_total
        );

    })

    .catch(function (error) {

        console.error(
            'Oltouch Update Quantity Error:',
            error
        );

        alert(
            'Something went wrong. Please try again.'
        );

    })

    .finally(function () {

        cartItem.classList.remove(
            'loading'
        );

    });

});


/*
 * Single product quantity controls.
 */
document.addEventListener('click', function (event) {

    const increaseButton =
        event.target.closest('.btn-increase');

    const decreaseButton =
        event.target.closest('.btn-decrease');


    /*
     * Ignore clicks that are not
     * single-product quantity buttons.
     */
    if (!increaseButton && !decreaseButton) {
        return;
    }


    const quantityBox =
        (increaseButton || decreaseButton)
            .closest('.wg-quantity');


    if (!quantityBox) {
        return;
    }


    const quantityInput =
        quantityBox.querySelector('.quantity-product');


    if (!quantityInput) {
        return;
    }


    let quantity =
        parseInt(quantityInput.value, 10) || 1;


    /*
     * Increase quantity.
     */
    if (increaseButton) {

        quantity++;

    }


    /*
     * Decrease quantity.
     */
    if (decreaseButton) {

        quantity--;

    }


    /*
     * Quantity cannot go below 1.
     */
    quantity =
        Math.max(1, quantity);


    quantityInput.value =
        quantity;

});


//Product page add to cart
/*
 * Product page Add To Cart
 */
document.addEventListener('click', function (event) {

    const button =
        event.target.closest(
            '.oltouch-product-add-to-cart'
        );

    if (!button) {
        return;
    }

    event.preventDefault();


    /*
     * Product information wrapper.
     */
    const productInfo =
        button.closest(
            '.tf-product-info-wrap'
        );

    if (!productInfo) {
        return;
    }


    /*
     * Product ID.
     */
    const productId =
        button.dataset.product_id;

    if (!productId) {
        return;
    }


    /*
     * Quantity.
     */
    const quantityInput =
        productInfo.querySelector(
            '.quantity-product'
        );

    const quantity =
        Math.max(
            1,
            parseInt(
                quantityInput?.value,
                10
            ) || 1
        );


    /*
     * Variation ID.
     *
     * Simple products will not
     * have one.
     */
    const variationId =
        productInfo.dataset.variationId || '';


    /*
     * Variation attributes.
     */
    const variationAttributes =
        productInfo.dataset.variationAttributes || '';


    /*
     * Prevent double clicking.
     */
    if (
        button.classList.contains(
            'loading'
        )
    ) {
        return;
    }

    button.classList.add(
        'loading'
    );


    /*
     * Prepare AJAX request.
     */
    const formData =
        new FormData();

    formData.append(
        'action',
        'oltouch_add_to_cart'
    );

    formData.append(
        'product_id',
        productId
    );

    formData.append(
        'quantity',
        quantity
    );


    /*
     * Add variation information
     * when available.
     */
    if (variationId) {

        formData.append(
            'variation_id',
            variationId
        );

    }


    if (variationAttributes) {

        formData.append(
            'variation',
            variationAttributes
        );

    }


    /*
     * Send AJAX request.
     */
    fetch(
        oltouchCart.ajax_url,
        {
            method: 'POST',
            body: formData
        }
    )

    .then(function (response) {

        return response.json();

    })

    .then(function (response) {

        console.log(
            'Product page Add To Cart:',
            response
        );


        if (!response.success) {

            alert(
                response.data?.message ||
                'Unable to add product to cart.'
            );

            return;
        }


        /*
         * Cart response.
         */
        const cart =
            response.data.cart;


        /*
         * Update cart items.
         */
        updateCartItems(
            cart.items
        );


        /*
         * Update cart count.
         */
        updateCartCount(
            cart.cart_count
        );


        /*
         * Update cart total.
         */
        updateCartTotal(
            cart.cart_total
        );


        /*
         * Open cart canvas.
         */
        const shoppingCart =
            document.getElementById(
                'shoppingCart'
            );


        if (
            shoppingCart &&
            typeof bootstrap !== 'undefined'
        ) {

            const offcanvas =
                bootstrap.Offcanvas
                    .getOrCreateInstance(
                        shoppingCart
                    );

            offcanvas.show();

        }

    })

    .catch(function (error) {

        console.error(
            'Oltouch Product Add To Cart Error:',
            error
        );

        alert(
            'Something went wrong. Please try again.'
        );

    })

    .finally(function () {

        button.classList.remove(
            'loading'
        );

    });

});


document.addEventListener(
    'DOMContentLoaded',
    function () {

        loadCart();

    }
);