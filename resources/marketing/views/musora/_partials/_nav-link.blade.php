<a class="{{ !empty($hasDropdown)? 'has-drop-down' : '' }}" href="{{ $linkUrl }}" target="{{ !empty($externalLink)? '_blank' : '_parent' }}">
    <div class="nav-link">
        <i class="text-gradient {{ $linkIcon }}"></i>
        {!! $linkName !!}

        @if(!empty($hasDropdown))
            <div class="drop-down-arrow">
                <i class="text-gradient fa fa-angle-down {{ !empty($defaultOpen)? 'rotate' : '' }}"></i>
            </div>
        @endif
    </div>
</a>