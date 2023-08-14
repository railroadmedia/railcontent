<section class="overflow-hidden" style="background:linear-gradient(241deg, #0C1524 38.84%, #062746 100%);">
    <div class="max-w-5xl mx-auto sm:flex items-center text-white px-4">
        <div class="flex-1 relative text-center sm:text-left">
            <div class="-ml-20 -mr-28 mt-10 mb-6 sm:hidden">
                <img class="w-full" src="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $mobileImg }}" alt="albums mobile" />
            </div>
            <h3 class="font-extrabold">{{ $header }}</h3>
            <p class="uppercase text-promo tracking-widest py-3">{!! $subHeader !!}</p>
            <ul class="fa-ul text-left pl-6 mx-auto inline-block">
                @foreach($benefits as $benefit)
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-{{ $theme }}" aria-hidden="true"></i> {{ $benefit }}</li>
                @endforeach
            </ul>
            <a class="w-full sm:w-72 smaller join bg-{{ $theme }} w-full mt-3 mb-10 block mx-auto sm:ml-0" href="/trial">
                start your free trial
            </a>
        </div>
        <div class="flex-1 md:pl-10 g:pl-14 hidden sm:block">
            <img class="-mt-10 -mb-10" src="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $img }}" alt="albums" />
        </div>
    </div>
</section>
