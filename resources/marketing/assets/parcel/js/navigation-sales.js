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

    $(".ajax-form").submit(function(e) {
        e.preventDefault();
        console.log(e.originalEvent)

        // var pre = $(this).find(".pre-add"),
        //     pending = $(this).find(".pending"),
        //     success = $(this).find(".success"),
        //     fail = $(this).find(".fail"),
        //     submitButton = $(this).find(".submit"),
        //     disclaimer = $(this).parent().find(".disclaimer"),
        //     thankBanner = $(this).parent().find(".thank-you-box"),
        //     form = $(this),
        //     url = form.attr("action");
        //
        // pre.addClass("hide hidden");
        // success.addClass("hide hidden");
        // fail.addClass("hide hidden");
        // pending.removeClass("hide hidden");
        // submitButton.removeClass("error");
        //
        // $.ajax({
        //     type: "POST",
        //     url: url,
        //     data: form.serialize(),
        //     success: function() {
        //         form.addClass("hide hidden");
        //         disclaimer.addClass("hide hidden");
        //         thankBanner.addClass("active");
        //
        //         pending.addClass("hide hidden");
        //         success.removeClass("hide hidden");
        //     },
        //     error: function() {
        //         submitButton.addClass("error");
        //
        //         pending.addClass("hide hidden");
        //         fail.removeClass("hide hidden");
        //     }
        // });
        //
        // if(e.originalEvent != null) {
        //     var formId = $(this).find("input[name='inf_form_xid']").val();
        //
        //     dataLayer.push({
        //         "event": "gtm.formSubmit",
        //         "formId": formId,
        //         "formSuccess": true
        //     });
        // }
    });
});
