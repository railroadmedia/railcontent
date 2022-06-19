<div class="drumshop-accordion">
    @if(!empty($overview))
        <h4 class="font-bold text-lg uppercase mb-6 md:text-xl lg:text-2xl mt-0">Overview</h4>
        <p><x-markdown>{!! nl2br($overview) !!}</x-markdown></p>
        @if(!empty($overviewList))
            <ul>
                @foreach($overviewList as $listItem)
                    <li>{{ $listItem }}</li>
                @endforeach
            </ul>
        @endif
    @endif
    @if(!empty($interactive))
        <br>
        @if(!empty($smartBeat))
            <p>
                <img class="interactive-logo mr-2 w-full max-w-[210px] md:max-w-[290px]" src="https://s3.amazonaws.com/drumeo-packs/interactive-edition-logo.png"> - All sheet music features Drumeo SmartBeat Sheet Music for playing or pausing the notation, speeding up or slowing down the exercises, and creating loops to improve your learning experience. You’ll also get online access to Drumeo features like progress tracking, video commenting, and community forums where you can connect with students and teachers from around the world.
            </p>
        @else
            <p>
                <img class="interactive-logo mr-2 w-full max-w-[210px] md:max-w-[290px]" src="https://s3.amazonaws.com/drumeo-packs/interactive-edition-logo.png"> - You’ll also get online access to Drumeo features like progress tracking, video commenting, and community forums where you can connect with students and teachers from around the world.
            </p>
        @endif
    @endif
</div>
