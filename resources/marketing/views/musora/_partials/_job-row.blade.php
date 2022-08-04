<a
        @if(!empty($bamboo))
            href="https://musoramediainc.bamboohr.com/jobs/view.php?id={{ $bamboo }}"
        @elseif(!empty($careers))
            href="/careers"
        @else
            target="_blank" href="https://musoramediainc.bamboohr.com/jobs/view.php?id=58"
        @endif
    class="flex justify-between items-center w-full text-left px-3 md:px-6 py-3 md:py-4 job-row rounded-lg mb-2 transition-opacity duration-300 hover:opacity-80" style="background:linear-gradient(20deg, #014445, #1a1655, #490f1d);">
    <i class="fal fa-fw {{ $faIcon }} text-2xl md:text-4xl" style="background: -webkit-linear-gradient(20deg,#03c8ac, #0976db, #9a01ee, #f61a30);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i>

    <div class="pl-3 sm:pl-4 mr-auto">
        <h6><strong class="font-black">{{ $jobTitle }}</strong></h6>
        <p class="opacity-60">
            @if(!empty($partTime)) part-time, @elseif(!empty($freelance)) freelance, @else full-time, @endif @if(!empty($remote)) remote @elseif(!empty($remoteEither)) on-site/remote @else on-site @endif
        </p>
    </div>
    <i class="fal fa-fw fa-angle-right text-4xl ml-auto flex-shrink-0"></i>
</a>
