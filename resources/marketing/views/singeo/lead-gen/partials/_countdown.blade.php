<script type="text/javascript" src="/marketing/parce/singeo/jquery.countdown-2.js"></script>
<script>
    $(function(){
        $('.countdown-full').countdown('{{ $countdownDate }}')
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
        $('.countdown-small').countdown('{{ $countdownDate }}')
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
    })
</script>
