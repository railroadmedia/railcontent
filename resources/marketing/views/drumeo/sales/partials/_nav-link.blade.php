<a class="{{ !empty($hasDropdown)? 'has-drop-down' : '' }}"
   @if(!empty($linkUrl))
   href="{{ $linkUrl }}"
   @endif
   target="{{ !empty($externalLink)? '_blank' : '_parent' }}" rel="{{ !empty($externalLink)? 'noopener' : '' }}"
   aria-label="{{ $linkName }}">
    <div class="nav-link">
        @if(!empty($linkIcon))
            <i class="{{ $linkIcon }} text-{{ $brand }}" role="img" aria-label="{{ $linkName }} Icon"></i>
        @endif
        {!! $linkName !!}

        @if(!empty($hasDropdown))
            <div class="drop-down-arrow {{ !empty($defaultOpen)? 'active' : '' }}"  aria-haspopup="true" aria-expanded="false" role="button">
                <span class="bg-{{ $brand }}"></span>
                <span class="bg-{{ $brand }}"></span>
            </div>
        @endif
    </div>
</a>
