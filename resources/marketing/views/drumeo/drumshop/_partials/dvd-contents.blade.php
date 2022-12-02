<div class="tw-mb-4">
    @if(!empty($spread))
        <img class="tw-max-w-lg tw-mb-5 tw-w-full" src="{{ $spread }}">
    @endif
    <div>
        <p class="tw-font-bold tw-text-lg tw-uppercase tw-mb-6 md:tw-text-xl lg:tw-text-2xl">Contents </p>
    </div>
    <div>
        @foreach ($dvdList as $dvdListItem)
            <h5 class="tw-font-bold tw-mb-4">{{ $dvdListItem->dvdTitle  }}</h5>
            <p>{!! trans(nl2br($dvdListItem->dvdDescription)) !!}</p>
        @endforeach

        @if(!empty($workbookImage) && $workbookImage)
            <h5 class="tw-font-bold tw-mb-4">The Workbook</h5>
            <p>{!! nl2br(e( $workbookDescription ))  !!}</p>
        @endif

        <h5 class="tw-font-bold tw-mb-4">The Members Area</h5>
        <p>{!! nl2br(e( $membersAreaDescription ))  !!}</p>
    </div>
</div>