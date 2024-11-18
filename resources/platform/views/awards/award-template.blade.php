<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
        .container {
            padding: 0 90px;
            text-align: center;
            width: 650px;
            margin: 0 auto;
            border: 1px solid black;
            position: relative;
        }

        .userName {
            font-family: '', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <div style="position: relative;">
            <img style="position: absolute; z-index: 0; width: 100%; top: 60px; left: 0;" src="data:image/png;base64,{{ base64_encode(file_get_contents('https://musora-web-platform.s3.us-east-1.amazonaws.com/challenges/certificate_logo.png')) }}" />

            <div style="z-index: 10; position: relative;">
                <h1 style="margin-bottom: 15px; font-size: 57px; font-weight: bold; margin-top: 48px;">CERTIFICATE</h1>
                <h2 style="font-size: 28px; margin-bottom: 14px;">OF COMPLETION</h2>
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents('https://musora-web-platform.s3.us-east-1.amazonaws.com/challenges/test_label.png')) }}" />
                <div style="margin-top: 15px;">
                    <h3 style="display: inline; border-bottom: 1px solid #212121; font-size: 50px; padding: 0 50px;" class="userName">User Name</h3>
                </div>
                <div style="margin-top: 15px;">
                    <i style="font-weight:bold; font-size: 12px;">Congratulations—you've earned a Gold Certificate!</i>
                </div>
                <p style="font-size: 12px; margin-top: 30px; margin-bottom: 20px; line-height: 2;">
                    You practiced for a total of <b>{{ $minutes_practiced }} minutes</b> and achieved a <b>{{ $streak }}-day streak</b> during {{ $challenge_title }}, which earned you a gold certificate. Through this Challenge, you've sharpened your drumming skills, improved your timing, and built a solid practice routine.
                </p>
                <table style="width: 100%; margin-bottom: 30px;">
                    <tr>
                        <td style="text-align: center; width: 33%;">
                            <i style="font-size: 14px;">{{ $date_completed }}</i>
                            <div style="text-align: center; font-size: 10px; border-top: 1px solid #CBCBCD; margin-top: 10px; padding-top: 10px; font-weight: bold;">DATE</div>
                        </td>
                        <td style="text-align: center; width: 33%;">
                            <img style="display: inline;" src="data:image/png;base64,{{ base64_encode(file_get_contents('https://musora-web-platform.s3.us-east-1.amazonaws.com/challenges/test_badge.png')) }}" />
                        </td>
                        <td style="text-align: center; width: 33%;">
                            {{ $instructor_name }}
                            <div style="text-align: center; font-size: 10px; border-top: 1px solid #CBCBCD; margin-top: 10px; padding-top: 10px; font-weight: bold;">INSTRUCTOR</div>
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <img height="20px" src="data:image/png;base64,{{ base64_encode(file_get_contents('https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png')) }}" />
            </div>
            <div style="margin-top: 5px;">
                <img height="8px" src="data:image/png;base64,{{ base64_encode(file_get_contents('https://musora-web-platform.s3.us-east-1.amazonaws.com/challenges/on_musora.png')) }}" />
            </div>
        </div>
    </div>
</body>
</html>