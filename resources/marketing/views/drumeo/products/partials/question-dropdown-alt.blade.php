<div
    class="dropdown text-center rounded-xl cursor-pointer mb-3 select-none text-black border-2 border-[#EFF3F5]"
    :class="open && 'active'"
    x-data="{ open: false }"
    x-on:click="
        open = !open;
        if(open){
            $refs.dropdown1.classList.remove('hidden');
            $refs.dropdown2.classList.remove('hidden');
        } else {
            $refs.dropdown1.classList.add('hidden');
            $refs.dropdown2.classList.add('hidden');
        }
    "
>
    <div class="flex">
        <div class="py-4 sm:py-6 pr-4 sm:pr-5 pl-8 sm:pl-12 text-left flex-grow relative">
            <h6 class="leading-tight sm:leading-loose font-bold relative" :class="open && 'mb-2'">
                <span class="text-white rounded-full py-1 px-2 md:px-2.5 text-xs md:text-sm absolute -left-11 md:-left-16 -top-0.5 md:top-0.5" :class="open ? 'bg-drumeo' : 'bg-[#838C98]'">1</span>
                {!! $title !!}
            </h6>
            <p
                x-ref="dropdown1"
                class="transition-all duration-300 text-xs sm:text-sm hidden leading-relaxed sm:leading-relaxed"
                :class="open ? '' : ''"
            >
                {!! nl2br( $description) !!}
                <br>
                <span class="block mt-4 text-[#838C98]">10 lessons / 10 assignments</span>
            </p>
        </div>
        <div class="ml-auto text-drumeo pt-3 sm:pt-6 pr-4 sm:pr-5 @if(!empty($customArrow)) {{ $customArrow }} @endif">
            <i class="fas fa-plus transform transition-all duration-300 text-lg md:text-2xl lg:text-3xl" :class="open && 'rotate-45'"></i>
        </div>
    </div>
    <div x-ref="dropdown2" class="transition-all duration-300 text-xs sm:text-sm text-left bg-[#F5F8FC] hidden" :class="open ? 'py-4 sm:py-6 pl-4 sm:pl-5 pr-8 sm:pr-12' : ''">
        <div class="bg-white p-4 rounded-xl flex flex-col md:flex-row">
            <img class="rounded-xl md:h-32 mb-6 md:mb-0" src="https://drumeo-assets.s3.amazonaws.com/sales/2023/method/Gear+Title.png" alt="gear title" />
            <div class="md:pl-6">
                <h5 class="font-extrabold">Gear</h5>
                <p class="my-2">In this course, you’ll learn about all the different parts of your drum-set. You’ll learn the name of each piece of drum equipment, the function and purpose of each piece, and how to set everything up properly and efficiently.</p>
                <p class="text-[#838C98]">10 lessons</p>
            </div>
        </div>
    </div>
</div>
