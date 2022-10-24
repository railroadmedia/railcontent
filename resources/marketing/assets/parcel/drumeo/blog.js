$(document).ready(function ($) {

    var position = $(window).scrollTop();


    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if(scroll > position) {
            $('.beat-navigation').removeClass('scrollUp');

        } else {
            $('.beat-navigation').addClass('scrollUp');
        }
        position = scroll;
    });

    // dropdowns for podcast/post ordering
    $('.sub-toggle').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).toggleClass('active');
        $(this).parent().find('.sub-list').toggleClass('active');
    });
    $(document).on('click', function(e) {
        if ($(e.target).is($('.sub-toggle')) === false) {
            $('.sub-toggle').removeClass('active');
            $('.sub-list').removeClass('active');
        }
    });
});