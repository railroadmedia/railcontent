$(function () {
    $('.facebook-track-lead').on('submit.analytics', function (e) {
        if (typeof fbq === 'function') {
            var form = $(this);

            fbq('track', 'Lead');
        }
    });
});
