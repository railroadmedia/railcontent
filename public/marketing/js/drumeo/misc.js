$(document).ready(function ($) {
    var nameLength = $(".profile-name").text().length;
    var width = $(window).width();
    if (width < 640) {
        if (nameLength > 25) {
            $('.profile-name').css({'font-size': '16px'});
        }
        if ($(".social-icon").length > 0) {
            $(".social-icons-mobile").css("display", "block");
            $(".social-icons").css("display", "none");
        }
    }
    else {
        if (nameLength > 25) {
            $('.profile-name').css({'font-size': '24px'});
        }
    }
    if (width < 1000 && width > 640) {
        if ($(".social-icon").length < 4) {
            $(".social-icons-mobile").css("display", "none");
            $(".social-icons").css("display", "block");

        } else {
            if (width < 1000) {
                $(".social-icons-mobile").css("display", "block");
            }
        }
    }
    $(window).resize(function () {

        var width = $(window).width();
        if (width < 1000 && width > 640) {
            if ($(".social-icon").length < 4) {
                $(".social-icons-mobile").css("display", "none");
                $(".social-icons").css("display", "block");
            }
            else if ($(".social-icon").length === 4) {
                $(".social-icons-mobile").css("display", "block");
            }
        }
        else if (width > 1360) {
            $(".social-icons-mobile").css("display", "none");
        }
        else if (width < 640) {
            if ($(".social-icon").length > 0) {
                $(".social-icons-mobile").css("display", "block");
                $(".social-icons").css("display", "none");
            }
            if (nameLength > 25) {
                $('.profile-name').css({'font-size': '16px'});
            }
        }
        else {
            $(".social-icons-mobile").css("display", "none");
            if (nameLength > 25) {
                $('.profile-name').css({'font-size': '24px'});
            }
        }

        if ($(".social-icon").length === 0) {
            $(".social-icons-mobile").css("display", "none");
        }
    });

    if ($(".social-icon").length == 0) {
        $(".social-icons-mobile").css("display", "none");
    }

    $('#what').click(function () {
        $(this).hide();
        $('#studentFocusForm').hide();
        $('#whatIsThis').show();
        $('.success-error-messages').hide();
    });
    $('#backToForm').click(function () {
        $('#what').show();
        $('#studentFocusForm').show();
        $('#whatIsThis').hide();
        $('.success-error-messages').show();
    });
    $('.close-application').click(function () {
        $('#what').show();
        $('#studentFocusForm').show();
        $('#whatIsThis').hide();
    });

    $('.pack-resources-button').click(function (e) {
        $('.resources-dropdown').fadeToggle();
        e.stopPropagation();
    });
    $('body').click(function () {
        $('.pack-resources-button .resources-dropdown').fadeOut(150);
    });

    $('#area').click(function () {
        $(this).addClass('active');
        $('#name').removeClass('active');
        $('#areaOption').show();
        $('#nameOption').hide();
    });
    $('#name').click(function () {
        $(this).addClass('active');
        $('#area').removeClass('active');
        $('#areaOption').hide();
        $('#nameOption').show();
    });
    $('.close-message-button').click(function () {
        $('#application-success-message').fadeOut(300);
    });

    var windowHeight = $(window).height();
    var bodyHeight = $('body').height();

    if (windowHeight > bodyHeight) {
        $('.footer').css({'position': 'fixed', 'bottom': '0'});
    }
    else {
        $('.footer').removeAttr('style');
    }

    setInterval(function () {
        windowHeight = $(window).height();
        bodyHeight = $('body').height();

        if (windowHeight > bodyHeight) {
            $('.footer').css({'position': 'fixed', 'bottom': '0'});
        }
        else {
            $('.footer').removeAttr('style');
        }
    }, 100);

    $(window).resize(function () {
        windowHeight = $(window).height();
        bodyHeight = $('body').height();

        if (windowHeight > bodyHeight) {
            $('.footer').css({'position': 'fixed', 'bottom': '0'});
        }
        else {
            $('.footer').removeAttr('style');
        }
    });

    $('.description-toggle').click(function () {
        $(this).parent('.card-hover-div').toggleClass('active');
    });

    $('.guest p').click(function(){
        $(this).addClass('active');
        $('.guest p').not(this).removeClass('active');
    });

});

var popupWindow = null;
function positionedPopup(url, winName, w, h, t, l, scroll) {
    winName = typeof winName !== 'undefined' ? winName : 'mp3 Resource';
    w = typeof w !== 'undefined' ? w : 42;
    h = typeof h !== 'undefined' ? h : 42;
    t = typeof t !== 'undefined' ? t : 42;
    l = typeof l !== 'undefined' ? l : 42;
    settings = 'height=' + h + ',width=' + w + ',top=' + t + ',left=' + l + ',scrollbars=' + scroll + ',resizable'
    popupWindow = window.open(url, winName, settings)
}
