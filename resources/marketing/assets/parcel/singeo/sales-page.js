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
    var $songPoint = $('.side-pic.songs'),
        $songPointToggle = $('.text-icon-wrap.songs'),
        currentSongPoint = 0,
        updateIndex = function (currentSongPoint) {
            $songPoint.removeClass('active');
            $songPointToggle.removeClass('active');

            $songPoint.eq(currentSongPoint).addClass('active');
            $songPointToggle.eq(currentSongPoint).addClass('active');
        },
        autoplaySongPoints = setInterval(function () {
            if(currentSongPoint < 2){
                currentSongPoint++;
                updateIndex(currentSongPoint);
            }
            else {
                currentSongPoint = 0;
                updateIndex(currentSongPoint);
            }
        }, 10000);

    $songPoint.first().addClass('active');
    $songPointToggle.first().addClass('active');
    $songPointToggle.on('click', function () {
        updateIndex($songPointToggle.index($(this)));
        currentSongPoint = $songPointToggle.index($(this));
        clearInterval(autoplaySongPoints);
    });

    //testimony show all button
    $('.testimonials-show-all').click(function () {
        $('.testimonials').addClass('show-all');
    });
});