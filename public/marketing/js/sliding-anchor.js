$(document).ready(function () {
    $('.anchor-slide').on('click', function (event) {
        event.preventDefault();

        var anchor = $(this).attr('href').replace('/', '');

        $('html, body').stop().animate({
            scrollTop: $(anchor).offset().top
        }, 1000);
    });
});