<a class="{{ !empty($hasDropdown)? 'has-drop-down' : '' }}{{ !empty($customClass)? $customClass : '' }}" href="{{ $linkUrl }}" target="{{ !empty($externalLink)? '_blank' : '_parent' }}">
    <div class="nav-link">
        <i class="{{ $linkIcon }}"></i>
        {!! $linkName !!}

        @if(!empty($hasDropdown))
            <div class="drop-down-arrow">
                <i class="fas fa-angle-down {{ !empty($defaultOpen)? 'rotate' : '' }}"></i>
            </div>
        @endif
    </div>
</a>