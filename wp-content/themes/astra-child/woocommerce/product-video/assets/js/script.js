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