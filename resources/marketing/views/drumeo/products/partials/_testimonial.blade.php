<div class="testimonial-box clearfix">
    <div class="avatar"><img class="hidden sm:inline-block" src="{{ $avatarURL }}"> @if(!empty($credit)) <span class="credit">{!! $credit !!}</span> @endif </div>
    <div class="quote-wrap">
        <h3><em>"{!! $testimonialHighlight !!}"</em></h3>
        <p>{!! $fullTestimonial !!}</p>
        <img class="inline-block sm:hidden" src="{{ $avatarURL }}">
        <p class="name-location"><strong>{{ $name }}</strong><br class="inline sm:hidden"><span class="hidden sm:inline"> - </span><span>{{ $location }}</span></p>
    </div>
</div>



