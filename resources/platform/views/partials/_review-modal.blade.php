<div id="applicationModal" class="modal">
    <div class="tw-text-[#00101D] tw-flex tw-flex-col tw-bg-white tw-rounded-[10px] tw-shadow tw-p-[30px]">

        <div class="tw-flex tw-flex-row tw-mb-[30px]">
            <h1 class="subheading">Student Review Application</h1>
        </div>

        <div class="flex flex-column tw-w-full">
            @if($brand === "drumeo")
                <iframe class="tw-w-full" src="https://docs.google.com/forms/d/e/1FAIpQLSdRzf0Wg4meObJi0ovKlUDgbBDYDpJP7MCguIDmPFDybchViQ/viewform?embedded=true" height="2177" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
            @elseif($brand === "pianote")
                <iframe class="tw-w-full" src="https://docs.google.com/forms/d/e/1FAIpQLSe4Soy7CDxk9Aw9_kuJvK9f3FyojMfLkuqezIsvKNUFQPD51w/viewform?embedded=true" height="1400" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
            @elseif($brand === "guitareo")
                <iframe class="tw-w-full" src="https://docs.google.com/forms/d/e/1FAIpQLSfqS5HTrmln2sd7QaNt9Er31fY2becXt4n6isN57HbGwVPHFg/viewform?usp=sf_link" height="1400" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
            @elseif($brand === "singeo")
                <iframe class="tw-w-full" src="https://docs.google.com/forms/d/e/1FAIpQLSeWyMtqVuQjMdA7rrZMK2jCkAIaPLeycTr0zXUE6LEaD6OmyQ/viewform?usp=sf_link" height="1400" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
            @endif
        </div>
    </div>
</div>
