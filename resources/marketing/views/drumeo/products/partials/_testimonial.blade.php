<div class="testimonial-box clearfix">
    <div class="avatar"><img class="hidden sm:inline-block" src="{{ $avatarURL }}" alt="{{ $name }}"> @if(!empty($credit)) <span class="credit">{!! $credit !!}</span> @endif </div>
    <div class="quote-wrap">
        <h3><em>"{!! $testimonialHighlight !!}"</em></h3>
        <p>{!! $fullTestimonial !!}</p>
        <img class="inline-block sm:hidden transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{ $avatarURL }}" alt="{{ $name }}" loading="lazy" onload="this.classList.remove('opacity-0')">
        <p class="name-location"><strong>{{ $name }}</strong><br class="inline sm:hidden"><span class="hidden sm:inline"> - </span><span>{{ $location }}</span></p>
    </div>
</div>



