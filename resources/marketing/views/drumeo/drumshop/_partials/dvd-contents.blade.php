<div class="mb-4">
    @if(!empty($spread))
        <img class="max-w-lg mb-5 w-full" src="{{ $spread }}">
    @endif
    <div>
        <p class="font-bold text-lg uppercase mb-6 md:text-xl lg:text-2xl">Contents </p>
    </div>
    <div>
        @foreach ($dvdList as $dvdListItem)
            <h5 class="font-bold mb-4">{{ $dvdListItem->dvdTitle  }}</h5>
            <p>{!! trans(nl2br($dvdListItem->dvdDescription)) !!}</p>
        @endforeach

        @if(!empty($workbookImage) && $workbookImage)
            <h5 class="font-bold mb-4">The Workbook</h5>
            <p>{!! nl2br(e( $workbookDescription ))  !!}</p>
        @endif

        <h5 class="font-bold mb-4">The Members Area</h5>
        <p>{!! nl2br(e( $membersAreaDescription ))  !!}</p>
    </div>
</div>
