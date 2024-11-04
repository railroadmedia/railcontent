<div class="testimonial col-xs-12 text-left">
    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/testimonials/{{ strtolower(str_replace(' ', '-', $name)) }}.jpg" alt="{{$name}}">
    <div class="col-xs-12 text">
        <h3><strong>"{{ $heading }}"</strong></h3>
        <p>{!! $testimonial !!}<br><br>
        <strong class="text-red">{{ $name }}</strong><br>
        <span>{{ $location }}</span> </p>
    </div>
</div>
