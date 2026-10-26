
document.addEventListener('click', async function (event) {
    const trigger = event.target.closest('.quick-view[data-product-id]');

    if (!trigger) {
        return;
    }

    event.preventDefault();

    const productId = trigger.dataset.productId;
    const content = document.querySelector('#quickViewContent');

    if (!productId || !content || typeof shopQuickView === 'undefined') {
        return;
    }

    content.innerHTML = `
        <div class="text-center py-5">
            <span
                class="spinner-border"
                role="status"
                aria-hidden="true"
            ></span>
            <p class="mt-3 mb-0">Loading product...</p>
        </div>
    `;

    const formData = new FormData();

    formData.append('action', 'shop_product_quick_view');
    formData.append('nonce', shopQuickView.nonce);
    formData.append('product_id', productId);

    try {
        const response = await fetch(shopQuickView.ajaxUrl, {
            method: 'POST',
            credentials: 'same-origin',
            body: formData
        });

        const result = await response.json();

        if (!response.ok || !result.success || !result.data.html) {
            throw new Error(
                result.data?.message || 'Unable to load this product.'
            );
        }

        content.innerHTML = result.data.html;
        // Initialize the newly inserted quick-view product.
        if (typeof window.initializeProductPrices === 'function') {
            window.initializeProductPrices(content);
        }

        if (typeof window.initializeDefaultVariations === 'function') {
            window.initializeDefaultVariations(content);
        }

        content.dispatchEvent(
            new CustomEvent('product:quick-view-loaded', {
                bubbles: true,
                detail: {
                    productId: productId
                }
            })
        );

    } catch (error) {
        console.error('Quick View error:', error);
        content.innerHTML = `
            <div class="alert alert-warning mb-0" role="alert">
                Unable to load this product. Please try again.
            </div>
        `;
    }
});
