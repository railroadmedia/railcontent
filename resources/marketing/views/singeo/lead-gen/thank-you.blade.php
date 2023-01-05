<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css"/>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '781339702238540');
        fbq('track', 'PageView');
        fbq('track', 'Lead');
    </script>
    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=781339702238540&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
    <style>
        body {
            padding:30px;
            text-align:center;
            overflow: hidden;
        }

        p {
            font:400 15px/1.4em "Open Sans", sans-serif;
            margin:0 auto;
        }

        @media (min-width:40em) {
            p {
                font-size:19px;
            }
        }

        @media (min-width:64em) {
            p {
                font-size:23px;
            }
        }

        h2 {
            font:700 30px/1em "Roboto Condensed", sans-serif;
            margin:15px auto;
            text-transform:uppercase;
            color:#9a00ee;
        }

        @media (min-width:40em) {
            h2 {
                font-size:40px;
                margin:20px auto;
            }
        }

        @media (min-width:64em) {
            h2 {
                font-size:50px;
            }
        }

        p em {
            line-height:1.4em;
            max-width:550px;
            display:inline-block;
            font-size:12px;
        }

        @media (min-width:40em) {
            p em {
                font-size:14px;
            }
        }

        .social-links a {
            background:#000;
            color:#fff;
            border-radius:50%;
            display:inline-block;
            text-align:center;
            margin:20px 10px 0;
            width:50px;
            height:50px;
            line-height:50px;
            font-size:26px;
        }

        @media (min-width:40em) {
            .social-links a {
                width:70px;
                height:70px;
                line-height:70px;
                font-size:35px;
                margin:25px 10px 0;
            }
        }

        @media (min-width:64em) {
            .social-links a {
                width:90px;
                height:90px;
                line-height:90px;
                font-size:45px;
            }
        }
    </style>
</head>
<body>
<p><strong>Success!</strong></p>
<h2>Check your email</h2>
<p><em>You should receive an email from team@singeo.com within 10 minutes.
        <br class="show-for-medium"> If you don’t, then check your spam folder or re-enter your email address again.</em>
</p>
<div class="social-links">
    <a href="https://www.youtube.com/c/singeoofficial" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
    <a href="https://www.facebook.com/singeoofficial/" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
    <a href="https://www.instagram.com/singeoofficial/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
</div>
</body>
</html>
