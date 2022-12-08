<li class="scalable-card" data-price="{{ $price }}" data-popularity="{{ $popularity }}"
        {{ !empty($stockingStuffer) ? 'data-stocking-stuffer=yes' : '' }}
        {{ !empty($rockDrummer) ? 'data-rock-drummer=yes' : '' }}
        {{ !empty($jazzDrummer) ? 'data-jazz-drummer=yes' : '' }}
        {{ !empty($GiggingDrummer) ? 'data-gigging=yes' : '' }}>
    <a href="{{ $itemURL }}" target="_blank">
        <div class="card-inside">
            <section class="gift-guide">
                <div class="top-image">
                    <div class="image-wrap" style="background-image:url({{ $thumbnail }});"></div>
                    <div class="titles">
                        <h4 class="two-line-wrap">{{ $title }}</h4>
                    </div>
                    <div class="open-lesson">
                        <i class="fas fa-arrow-right hover-icon"></i>
                    </div>
                </div>
                <div class="bottom-section">
                    <h6>{!!  $bottomText  !!}</h6>
                </div>
            </section>
            <div class="color-button {{ !empty($onDrumeo) ? 'on-drumeo' : '' }}">
                <h5>{{ !empty($onDrumeo) ? 'Drumeo' : 'Amazon' }}: ${{ $price }} <i class="fas {{ !empty($onDrumeo) ? 'fa-angle-right' : 'fa-external-link' }}"></i></h5>

            </div>
        </div>
    </a>
</li>

