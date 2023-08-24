$(document).ready(function (){
    var menuOverlay = $(".menu-overlay");
    var sideBar = $(".nav-side-bar");
    var nav = $(".menu-toggle");

    nav.click(function () {
        sideBar.toggleClass("active");
        menuOverlay.toggleClass("active");
        $(this).toggleClass("active");
    });

    $(".edge-wrap .features").click(function (e) {
        e.stopPropagation();
        $(".instruments-dd").addClass("hidden");
        $(".features-dd").toggleClass("hidden");
    });
    $(".edge-wrap .instruments").click(function (e) {
        e.stopPropagation();
        $(".features-dd").addClass("hidden");
        $(".instruments-dd").toggleClass("hidden");
    });

    $(window).click(function() {
        $(".instruments-dd").addClass("hidden");
        $(".features-dd").addClass("hidden");
    });

    menuOverlay.click(function (e) {
        e.stopPropagation();
        $(this).removeClass("active");
        sideBar.removeClass("active");
        nav.removeClass("active");
    });

    $(".has-drop-down").click(function (e) {
        e.stopPropagation();
        e.preventDefault();
        var arrowIcon = $(this).find(".drop-down-arrow");
        var lessonLinks = $(this).next(".dropdown");
        lessonLinks.toggleClass("active");
        arrowIcon.toggleClass("active");
    });

    // cookie bar
    var popUp = false;
    (function getPopUpCookie() {
        var date = new Date();
        date.setSeconds(date.getSeconds() + 60);
        document.cookie = "cookiesEnabled=true; expires=" + date.toUTCString() + "; path=/";
        var cookiesEnabled = document.cookie.indexOf("cookiesEnabled=") !== -1;
        var hasCookie = document.cookie.indexOf("cookieAccept=true");
        if (hasCookie < 0 && cookiesEnabled === true && window.location.hostname.endsWith('drumeo.com')) {
            setTimeout(function () {
                $(".cookie-notice").removeClass("hide");
            }, 3000);
        }
    }());

    function setPopUpCookie() {
        if (!popUp) {
            document.cookie = "cookieAccept=true; expires=" + new Date(2147483647 * 1000).toUTCString() + "; path=/; domain=drumeo.com;";
            popUp = true;
        }
    }

    $("#accept-cookies").click(function () {
        $(".cookie-notice").addClass("hide");
        setPopUpCookie();
    });

    $('.anchor-slide').bind('click', function (event) {
        event.preventDefault();
        var anchor = $(this).attr('href').replace('/', '');

        $('html, body').animate({
            scrollTop: $(anchor).offset().top
        }, 1000);
    });
});
