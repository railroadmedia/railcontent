$(document).ready(function () {
    $(document).foundation();
    AOS.init();


    $('.slick').slick({
        slidesToShow: 1
    });
    $('.slick-2').slick({
        draggable: false,
        slidesToShow: 5,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            }
        ]
    });

    $('.inside-scroll-element').slick({
        infinite: false,
        arrows: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }
        ]
    });

    $('.dropdown').on('click', function(){
        $(this).toggleClass('active');
        $(this).find('i').toggleClass('rotate-180');
    });

    // sticky topbar before orderSection
    var stickyBar = $('.promo-banner');
    $(window).scroll(function () {
        var stickTrigger = $('.sticky-trigger').offset().top;
        var unstickTrigger = $('.unstick-trigger').offset().top;
        if ($(this).scrollTop() > (unstickTrigger - 115)) {
            stickyBar.removeClass('fixed');
        }
        if ($(this).scrollTop() < stickTrigger - 115) {
            stickyBar.removeClass('fixed');
        }
        if ($(this).scrollTop() < unstickTrigger - 115 && $(this).scrollTop() > stickTrigger - 115) {
            stickyBar.addClass('fixed');
        }
    });

    $('.flip-div').click(function (e) {
        $(this).toggleClass('flipped');
    });

    // song point cycle
    var $coachPoint = $('.side-pic.coaches'),
        $coachPointToggle = $('.text-icon-wrap.coaches'),
        currentCoachPoint = 0,
        updateCoachIndex = function (currentCoachPoint) {
            $coachPoint.removeClass('active');
            $coachPointToggle.removeClass('active');

            $coachPoint.eq(currentCoachPoint).addClass('active');
            $coachPointToggle.eq(currentCoachPoint).addClass('active');
        },
        autoplayCoachPoints = setInterval(function () {
            if(currentCoachPoint < 2){
                currentCoachPoint++;
                updateCoachIndex(currentCoachPoint);
            }
            else {
                currentCoachPoint = 0;
                updateCoachIndex(currentCoachPoint);
            }
        }, 10000);

    $coachPoint.first().addClass('active');
    $coachPointToggle.first().addClass('active');
    $coachPointToggle.on('click', function () {
        updateCoachIndex($coachPointToggle.index($(this)));
        currentCoachPoint = $coachPointToggle.index($(this));
        clearInterval(autoplayCoachPoints);
    });

    //scrolls up subscriber count
    $('.count').each(function () {
        var thisCountElement = $(this);
        var options = {
            useEasing: true,
            useGrouping: true,
            separator: ',',
            decimal: '.',
            prefix: '',
            suffix: ''
        };
        var demo = new CountUp(
            thisCountElement.attr('id'), 0, thisCountElement.data('total-count'), 0, 2.5, options
        );
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window)
                .height() + 50 > (thisCountElement.offset().top)) {
                demo.start();
            }
        });
    });
    $(window).trigger('scroll');

    // show all buttons
    $('.testimonials-show-all').click(function () {
        $('.testimonials').addClass('show-all');
    });
    $('.levels-show-all').click(function () {
        $('.method-levels').addClass('show-all');
    });
    $('.courses-show-all').click(function () {
        $('.course-tiles').addClass('show-all');
    });
});