document.addEventListener('DOMContentLoaded', () => {

    let mediaFrame;

    const uploadButton = document.getElementById('upload_product_video');
    const removeButton = document.getElementById('remove_product_video');
    const input = document.getElementById('product_video');
    const filename = document.getElementById('video_filename');

    if (!uploadButton) {
        return;
    }

    uploadButton.addEventListener('click', (e) => {

        e.preventDefault();

        if (mediaFrame) {
            mediaFrame.open();
            return;
        }

        mediaFrame = wp.media({
            title: 'Select Product Video',
            button: {
                text: 'Use Video'
            },
            library: {
                type: 'video'
            },
            multiple: false
        });

        mediaFrame.on('select', () => {

            const attachment = mediaFrame
                .state()
                .get('selection')
                .first()
                .toJSON();

            input.value = attachment.id;
            filename.textContent = attachment.filename;

        });

        mediaFrame.open();

    });

    removeButton.addEventListener('click', (e) => {

        e.preventDefault();

        input.value = '';
        filename.textContent = '';

    });

});




document.addEventListener('click', function (event) {
    const playButton = event.target.closest('.product-video-play');

    if (!playButton) {
        return;
    }

    const viewer = playButton.closest('.product-video-viewer');

    if (!viewer || viewer.querySelector('video')) {
        return;
    }

    const videoUrl = viewer.dataset.videoUrl;
    const posterUrl = viewer.dataset.poster;

    if (!videoUrl) {
        return;
    }

    const video = document.createElement('video');

    video.className = 'product-video-player';
    video.controls = true;
    video.playsInline = true;
    video.preload = 'none';

    if (posterUrl) {
        video.poster = posterUrl;
    }

    const source = document.createElement('source');

    source.src = videoUrl;
    source.type = 'video/mp4';

    video.appendChild(source);

    viewer.replaceChildren(video);

    const playback = video.play();

    if (playback && typeof playback.catch === 'function') {
        playback.catch(function () {
            /*
             * If playback is blocked, native video controls remain
             * available so the customer can press Play manually.
             */
            video.controls = true;
        });
    }
});

/*
 * Stop playback when the carousel changes slides.
 */
if (window.jQuery) {
    jQuery(document).on(
        'changed.owl.carousel',
        '.thumb-gallery-detail',
        function () {
            const gallery = this;

            gallery.querySelectorAll('video').forEach(function (video) {
                video.pause();
            });
        }
    );
}

