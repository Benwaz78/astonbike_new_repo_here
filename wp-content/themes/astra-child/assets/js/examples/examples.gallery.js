
/*
Name: Elements - Image Gallery
Based on: Okler / Porto Theme
Supports: Initial page load and AJAX-loaded Quick View content
*/

(($) => {
    'use strict';

    function initThumbGallery(wrapper) {
        const $wrapper = $(wrapper);

        // Prevent the same gallery from being initialized twice.
        if ($wrapper.data('thumb-gallery-initialized')) {
            return;
        }

        const $detail = $wrapper.find('.thumb-gallery-detail');
        const $thumbs = $wrapper.find('.thumb-gallery-thumbs');

        if (!$detail.length || !$.fn.owlCarousel) {
            return;
        }

        $wrapper.data('thumb-gallery-initialized', true);

        let flag = false;
        const duration = 300;

        $detail
            .owlCarousel({
                items: 1,
                margin: 10,
                nav: true,
                dots: false,
                loop: false,
                autoHeight: true,
                navText: [],
                rtl: $('html').attr('dir') === 'rtl'
            })
            .on('changed.owl.carousel', ({ item }) => {
                if (!flag && item && $thumbs.length) {
                    flag = true;

                    $thumbs.trigger(
                        'to.owl.carousel',
                        [item.index - 1, duration, true]
                    );

                    $thumbs.find('.owl-item').removeClass('selected');
                    $thumbs.find('.owl-item')
                        .eq(item.index)
                        .addClass('selected');

                    flag = false;
                }
            });

        // Some products have only one image and no thumbnail carousel.
        if (!$thumbs.length) {
            return;
        }

        $thumbs
            .owlCarousel({
                margin: 15,
                items: $wrapper.data('thumbs-items') || 4,
                nav: false,
                center: $wrapper.data('thumbs-center') ? true : false,
                dots: false,
                rtl: $('html').attr('dir') === 'rtl'
            })
            .on('click', '.owl-item', function () {
                $detail.trigger(
                    'to.owl.carousel',
                    [$(this).index(), duration, true]
                );
            })
            .on('changed.owl.carousel', ({ item }) => {
                if (!flag && item) {
                    flag = true;

                    $detail.trigger(
                        'to.owl.carousel',
                        [item.index, duration, true]
                    );

                    flag = false;
                }
            });

        $thumbs.find('.owl-item').eq(0).addClass('selected');
    }

    // Existing Porto theme initialization for galleries on page load.
    theme.fn.intObs('.thumb-gallery-wrapper', function () {
        initThumbGallery(this);
    }, {});

    // Initialize galleries inserted into Quick View via AJAX.
    document.addEventListener('product:quick-view-loaded', function (event) {
        const content = event.target;

        if (!content) {
            return;
        }

        $(content)
            .find('.thumb-gallery-wrapper')
            .addBack('.thumb-gallery-wrapper')
            .each(function () {
                initThumbGallery(this);
            });
    });

})(jQuery);
