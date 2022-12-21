<div class="testimonial-pitch">
    <div class="row">
        <div class="columns">
            <h3>{!! $descriptiveText !!}</h3>
            <a class="join outline" href="@yield('details-link')">See Details &raquo;</a>
            &nbsp;
            @if(!empty($soldOut))
                <a class="join sold-out">Closed</a>
            @else
                <a class="join" href="@yield('order-link')">Get Started &raquo;</a>
            @endif
        </div>
    </div>
</div>