<div id="applicationModal" class="modal">
    <div class="tw-text-[#00101D] tw-flex tw-flex-col tw-rounded-[10px] tw-shadow tw-p-[30px] tw-relative" style="background: white !important;">

        <div class="tw-flex tw-flex-row tw-mb-[30px]">
            <h1 class="subheading">Student Review Application</h1>
        </div>

        <div class="flex flex-column tw-w-full">
            @if($brand === "drumeo")
                {{-- Drumeo Review Form --}}
                <student-review-form
                    url="https://docs.google.com/forms/d/e/1FAIpQLSdRzf0Wg4meObJi0ovKlUDgbBDYDpJP7MCguIDmPFDybchViQ/viewform?embedded=true"
                    height="600"
                >
                </student-review-form>
            @elseif($brand === "pianote")
                {{-- Pianote Review Form --}}
                <student-review-form
                    url="https://docs.google.com/forms/d/e/1FAIpQLSe4Soy7CDxk9Aw9_kuJvK9f3FyojMfLkuqezIsvKNUFQPD51w/viewform?embedded=true"
                    height="600"
                >
                </student-review-form>
            @elseif($brand === "guitareo")
                {{-- Guitareo Review Form --}}
                <student-review-form
                    url="https://docs.google.com/forms/d/e/1FAIpQLSfqS5HTrmln2sd7QaNt9Er31fY2becXt4n6isN57HbGwVPHFg/viewform?embedded=true"
                    height="600"
                >
                </student-review-form>
            @elseif($brand === "singeo")
                {{-- Singeo Review Form --}}
                <student-review-form
                    url="https://docs.google.com/forms/d/e/1FAIpQLSeWyMtqVuQjMdA7rrZMK2jCkAIaPLeycTr0zXUE6LEaD6OmyQ/viewform?embedded=true"
                    height="600"
                >
                </student-review-form>
            @endif
        </div>
    </div>
</div>
