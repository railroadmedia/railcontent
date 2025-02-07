@php
    $hotjarIds = [
        'musora' => 5285799,
        'drumeo' => 5285805,
        'pianote' => 5285809,
    ];

    $hjid = $hotjarIds[$hjid] ?? null;
@endphp

<script>
    (function (c, s, q, u, a, r, e) {
        c.hj=c.hj||function(){(c.hj.q=c.hj.q||[]).push(arguments)};
        c._hjSettings = { hjid: a };
        r = s.getElementsByTagName('head')[0];
        e = s.createElement('script');
        e.async = true;
        e.src = q + c._hjSettings.hjid + u;
        r.appendChild(e);
    })(window, document, 'https://static.hj.contentsquare.net/c/csq-', '.js', {{ $hjid }});
</script>
