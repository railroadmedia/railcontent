<div class='tw-w-full'>
    <breadcrumb
        :breadcrumbs="{{ json_encode($pages) }}"
        @if(isset($breadcrumbClassOverride) && $breadcrumbClassOverride !== '')
            :class-override="{{ json_encode($breadcrumbClassOverride) }}"
        @endif
    />
</div>