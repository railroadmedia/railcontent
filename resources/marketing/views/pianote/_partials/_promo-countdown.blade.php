<script type="text/javascript" src="/assets/js/jquery.countdown-2.min.js"></script>
<script>
    $(document).ready(function () {
        // Countdown
        $('.tzcd-full-2').countdown('2022/10/14')
            .on('update.countdown', function (event) {
                var format = '%-M Minute%!M %-S Second%!S';
                if (event.offset.totalHours > 0) {
                    format = '%-H Hour%!H ' + format;
                }
                if (event.offset.totalDays > 0) {
                    format = '%-D Day%!D ' + format;
                }
                $(this).html(event.strftime(format));
            })
            .on('finish.countdown', function (event) {
                $(this).html('a limited time');
            });
        $('.tzcd-full').countdown('2022/10/14')
            .on('update.countdown', function (event) {
                var format = '%-M Minute%!M %-S Second%!S';
                if (event.offset.totalHours > 0) {
                    format = '%-H Hour%!H ' + format;
                }
                if (event.offset.totalDays > 0) {
                    format = '%-D Day%!D ' + format;
                }
                $(this).html(event.strftime(format));
            })
            .on('finish.countdown', function (event) {
                $(this).html('a limited time');
            });
        $('.tzcd-med').countdown('2022/10/14')
            .on('update.countdown', function (event) {
                var format = '%-M Minute%!M';
                if (event.offset.totalHours > 0) {
                    format = '%-H Hour%!H ' + format;
                }
                if (event.offset.totalDays > 0) {
                    format = '%-D Day%!D ' + format;
                }
                $(this).html(event.strftime(format));
            })
            .on('finish.countdown', function (event) {
                $(this).html('a limited time');
            });
        $('.tzcd-small').countdown('2022/10/14')
            .on('update.countdown', function (event) {
                var format = '%-MM %-SS';
                if (event.offset.totalHours > 0) {
                    format = '%-HH ' + format;
                }
                if (event.offset.totalDays > 0) {
                    format = '%-DD ' + format;
                }
                $(this).html(event.strftime(format));
            })
            .on('finish.countdown', function (event) {
                $(this).html('a limited time');
            });
        $('.tzcd-big').countdown('2022/10/14')
            .on('update.countdown', function (event) {
                var format = '' + '<div><h1>%M</h1> <p>min%!M</p></div> ' + '<div><h1>%S</h1> <p>sec%!S</p></div>';
                if (event.offset.totalHours > 0) {
                    format = '' + '<div><h1>%H</h1> <p>hr%!H</p></div> ' + format;
                }
                if (event.offset.totalDays > 0) {
                    format = '' + '<div><h1>%D</h1> <p>day%!D</p></div> ' + format;
                }
                $(this).html(event.strftime(format));
            })
            .on('finish.countdown', function (event) {
                $(this).html('<div><h1>LIMITED</h1> <p>TIME LEFT</p></div>');
            });
    });
</script>