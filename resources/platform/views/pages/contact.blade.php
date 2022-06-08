@extends('partials.login-layout')

@section('meta')
    <title>Contact | Musora</title>
@endsection

@section('content')
    <div>hello world</div>


    <contact-email-form
        brand="drumeo"
        captchakey="6LcBSxYUAAAAANEVgiFM3kmHOjzbcrkspWBtQd9n "
        email-subject="Support Request From Drumeo.com"
        email-type="support-contact"
        email-endpoint="/laravel/public/mailora/public/send"
        email-logo="https://dmmior4id2ysr.cloudfront.net/logos/drumeo-logo.png"
        input-label="Report your issue here.."
        recipient="support@drumeo.com"
        success-message="Your email has been sent!"
    />



@endsection
