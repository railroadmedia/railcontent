<button
    class="apply hover:opacity-80 transition-opacity w-full"
    :class="loading ? 'bg-[#B2D4F4] text-black' : !isValid ? 'bg-[#B91C1C] text-white' : submitted ? 'bg-[#15803D] text-white' : '{{ $buttonColor }}'"
    type="submit"
>
    <span x-show="!loading && isValid && !submitted">{!! $buttonText !!}</span>
    <span x-show="loading"><i class="fa-solid fa-spinner mr-1"></i> Loading</span>
    <span x-show="!isValid"><i class="fa-solid fa-rotate-left mr-1"></i> Retry submission</span>
    <span x-show="submitted"><i class="fa-solid fa-check mr-1"></i>Successfully Submitted</span>
</button>
