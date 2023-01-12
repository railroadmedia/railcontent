$(window).on("load", function (){
    // Setup Slick slider
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: '.slider-nav',
        arrows: false,
        fade: true,
    });
    $('.slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        arrows: false,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 4,
                }
            }
        ],
    });

    if($('#videoPlayer').length) {
        $('.slider-for').on('afterChange', function (event, slick, currentSlide, nextSlide) {
            var iframe = $('#videoPlayer')
            var src = $('#videoSrc').get(0).innerText
            if(iframe.attr('src')){
                iframe.attr('src', '')
            }
            if(currentSlide === 0){
                iframe.attr('src', src)
            }
        });
    }


    //customize section pack picker
    var originalLink = '/ecommerce/add-to-cart?';

    $('select').prop('selectedIndex', 0);
    $(".pack-pick").change(function () {
        var orderButton = $(this).parent().find(".selected-pack");
        var selectedOption = $(this).find("option:selected");
        $(this).removeClass('error');
        orderButton.addClass('active');
        orderButton.attr('href', originalLink);
        orderButton.attr('href', orderButton.attr('href') + '&products[' + selectedOption.val() + ']=1' + '&redirect=/shop');
        orderButton.attr('data-product-json', selectedOption.attr('data-product-json'));
    });

    $(".selected-pack").on('click', function (ev) {
        if (!$(this).hasClass('active')) {
            ev.preventDefault();
            ev.stopPropagation();
            var selecter = $(this).parent().find(".pack-pick");
            selecter.addClass('error');
        }
    });

    // sliding scrollbar function
    function isScrollPast(distanceFromTop) {
        return $(window).scrollTop() > distanceFromTop;
    }

    function getDistanceFromTop(elementToCalculate) {
        if ($(elementToCalculate).is(':visible')) {
            return $(elementToCalculate).parent().offset().top;
        }

        return false;
    }

    var bodyWidth = $(window).width();
    var slidingElm = $('.sliding-function .side-slide');
    var menuHeight = $('.top-bar').height();
    var topFixedSidebarBuffer = 15;

    $(window).resize(function () {
        bodyWidth = $(window).width();
        $(slidingElm).removeClass('fixedSlider');
    });

    var originalDistanceFromTop = getDistanceFromTop(slidingElm);
    $(window).scroll(function () {
        if (bodyWidth > 1023) {
            var footerOffsetTop = $('.bottom-footer').offset().top;

            if (originalDistanceFromTop === false) {
                return;
            }

            if (isScrollPast(originalDistanceFromTop - menuHeight - topFixedSidebarBuffer)) {
                if (!$(slidingElm).hasClass('fixedSlider')) {
                    $(slidingElm).addClass('fixedSlider');
                }

                if (isScrollPast(footerOffsetTop - slidingElm.height() - menuHeight - (topFixedSidebarBuffer * 2))) {
                    slidingElm.css('top', (footerOffsetTop - slidingElm.height() - $(window).scrollTop() - (topFixedSidebarBuffer)));
                } else {
                    slidingElm.css('top', '');
                }
            } else {
                if ($(slidingElm).hasClass('fixedSlider')) {
                    $(slidingElm).removeClass('fixedSlider');
                }
            }
        }
    });
    $(slidingElm).css('width', $(slidingElm).parent().width());
    $(window).resize(function () {
        if (typeof slidingElm !== 'undefined') {
            originalDistanceFromTop = getDistanceFromTop(slidingElm);
            $(slidingElm).css('width', $(slidingElm).parent().width());
            $(window).trigger('scroll');
        }
    });
});
