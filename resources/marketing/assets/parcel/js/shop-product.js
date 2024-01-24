$(window).on("load", function (){
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav',
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: true,
        centerMode: true,
        focusOnSelect: true,
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
        const isPromo = orderButton[0].getAttribute('data-promocode');
        orderButton.attr('href', orderButton.attr('href') + '&products[' + selectedOption.val() + ']=1' + (isPromo ? `&promo-code=${isPromo}` : '') + '&redirect=/shop');
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


    // Function to check if the scroll position is past a given distance from the top
    function isScrollPast(distanceFromTop) {
        return $(window).scrollTop() > distanceFromTop;
    }

    // Function to get the distance from the top of the parent element
    function getDistanceFromTop(elementToCalculate) {
        if ($(elementToCalculate).is(':visible')) {
            return $(elementToCalculate).parent().offset().top;
        }
        return false;
    }

    var slidingElm = $('#sticky-slide');
    var menuHeight = $('nav').height();
    var topFixedSidebarBuffer = 15;
    var bodyWidth = $(window).width();
    var originalDistanceFromTop = getDistanceFromTop(slidingElm);
    var $slidingElm = $(slidingElm);
    var $window = $(window);
    var $bottomFooter = $('.bottom-footer');

    $window.resize(function () {
        bodyWidth = $window.width();
        // Recalculate the distance from the top after resizing
        originalDistanceFromTop = getDistanceFromTop($slidingElm);
        // Set the width of the sliding element to match its parent's width
        $slidingElm.css('width', $slidingElm.parent().width());
        // Remove classes, trigger scroll event to update position
        $slidingElm.removeClass('fixed top-[70px]');
        $window.trigger('scroll');
    });

    $window.scroll(function () {
        // Check if the window width is less than 1024px
        if (bodyWidth < 1024) {
            return;
        }

        var footerOffsetTop = $bottomFooter.offset().top;

        // Check if the distance from the top is available
        if (originalDistanceFromTop === false) {
            return;
        }

        // Check if the scroll position is past the threshold
        var scrollPastThreshold = isScrollPast(originalDistanceFromTop - menuHeight - topFixedSidebarBuffer);

        // Add or remove classes when scrolled past the threshold
        if (scrollPastThreshold) {
            $slidingElm.addClass('fixed top-[70px]');

            var footerThreshold = footerOffsetTop - $slidingElm.height() - menuHeight - (topFixedSidebarBuffer * 2);

            if (isScrollPast(footerThreshold)) {
                $slidingElm.addClass('absolute top-auto bottom-0 mb-4');
            } else {
                $slidingElm.removeClass('absolute top-auto bottom-0 mb-4');
            }
        } else {
            $slidingElm.removeClass('fixed top-[70px]');
        }
    });

    // Set the initial width of the sliding element and trigger the scroll event
    $slidingElm.css('width', $slidingElm.parent().width());
    $window.trigger('scroll');
});
