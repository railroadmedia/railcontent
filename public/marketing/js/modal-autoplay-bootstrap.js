$(document).ready(function () {
    //modal video swapping
    $('.autoplay-video').on('click', function () {
        var idOfOpenDiv = $(this).data('target');

        $(idOfOpenDiv).find('[data-lazy-load-url]').each(function () {
            var lazyLoadIframeElement = $(this);
            $(this).attr('src', lazyLoadIframeElement.data('lazy-load-url'));
        });
    });
    $('body').on('click', '.modal, .modal .stop-play', function (e) {
        if (e.target !== this) {
            return;
        }

        $('.reset-on-close').attr('src', 'about:blank');
    });
    $(document).keyup(function(e) {
        if (e.which === 27) {
            $('.reset-on-close').attr('src', 'about:blank');
        }
    });
});