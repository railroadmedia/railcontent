<a class="{{ !empty($hasDropdown)? 'has-drop-down' : '' }}"
        @if(!empty($linkUrl))
        href="{{ $linkUrl }}"
        @endif
        target="{{ !empty($externalLink)? '_blank' : '_parent' }}">
    <div class="nav-link {{ !empty($noClick)? 'no-click' : '' }}">
        @if(!empty($linkIcon))
            <i class="{{ $linkIcon }}"></i>
        @endif
        {!! $linkName !!}

        @if(!empty($hasDropdown))
            <div class="drop-down-arrow">
                <i class="fas fa-angle-down {{ !empty($promo)? 'red' : '' }}{{ !empty($defaultOpen)? 'rotate' : '' }}"></i>
            </div>
        @endif
    </div>
</a>