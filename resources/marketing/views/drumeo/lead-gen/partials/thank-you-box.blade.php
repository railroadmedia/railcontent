<div class="thank-you-box">
    <p><strong><i class="fas fa-check"></i> Success!</strong></p>
    <h2>@if(!empty($headline)) {{ $headline }} @else Check your email @endif</h2>
    <p><em>@if(!empty($body)) {!! $body !!} @else You should receive an email from team@drumeo.com within 10 minutes.
            If you don’t, then check your spam folder or re-enter your email address again. @endif
        </em>
    </p>
    @if(empty($noSocial))
        <div class="social-media">
            <a href="https://www.youtube.com/freedrumlessons/" target="_blank" class="youtube"><i
                        class="fab fa-youtube"></i></a> <a href="https://facebook.com/drumeo/" target="_blank"
                    class="facebook"><i class="fab fa-facebook-f"></i></a> <a href="https://instagram.com/drumeoofficial/"
                    target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
        </div>
    @endif
</div>