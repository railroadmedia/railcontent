$(document).ready(function ($) {
    var clipboard = new ClipboardJS('#copyClipboard');

    clipboard.on('success', function(e) {
        document.getElementById('copyClipboard').className += 'active';
    });

    function resizeIframes() {
        $('iframe').each(function() {
            var ratio = $(this).attr('height') / $(this).attr('width');
            $(this).css('height', $(this).width() * ratio);
        });
    }

    resizeIframes();

    $(window).resize(function() {
        if(!$('.white-box.Videos').find('p:nth-child(2)').hasClass('sticky-vid')) {
            resizeIframes();
        }
    });

    if ($('.white-box').hasClass('Videos')) {
        $('.post-ad-content').insertAfter($('.white-box > p:nth-child(3)')).removeClass('hide');
    } else {
        $('.post-ad-content').insertAfter($('.white-box > p:nth-child(1)')).removeClass('hide');
    }

    if ($('.white-box.Videos').find('iframe').length < 2) {

        var mainVideo = $('.white-box > p:nth-child(2) > iframe');
        setTimeout(function() {
            mainVideo.attr('src', mainVideo.data('src') + '?playsinline=1');
        }, 50);

        var iframePtag = $('.white-box.Videos').find('p:nth-child(2)');
        var fixedVideoPadding = $('.video-buffer');

        $('.close-sticky').on('click', function() {
            iframePtag.removeClass('active');
            fixedVideoPadding.removeClass('active');
        });

        if($('.white-box').height() > 1500) {
            $(window).blur(function () {
                if ($('iframe:focus')) {
                    $(iframePtag).addClass('active');
                }
            });

            // var hasFocus = false;
            //
            // $('iframe').on('focus', function () {
            //     console.log('ready');
            //     hasFocus = true;
            // });
            // $(window).blur(function () {
            //     if (hasFocus) {
            //         $(iframePtag).addClass('active');
            //     }
            // });

            $(window).scroll(function () {
                var tagAfterIframe = $('.white-box').find('p:nth-of-type(2)').offset().top;

                if ($(this).scrollTop() > (tagAfterIframe - 100) && iframePtag.hasClass('active')) {
                    iframePtag.addClass('sticky-vid');
                    fixedVideoPadding.addClass('active');
                }

                if ($(this).scrollTop() < tagAfterIframe - 100) {
                    iframePtag.removeClass('sticky-vid');
                    fixedVideoPadding.removeClass('active');
                }
            });
        }
    }

    const whiteBox = document.querySelector('.white-box');
    const thirdElement = whiteBox.children[2];
    const isVideoInElement = thirdElement.querySelector('iframe');
    if(isVideoInElement){
        const featuredImg = document.querySelector('.featured-image');
        featuredImg.classList.add('hide');
    }
});
