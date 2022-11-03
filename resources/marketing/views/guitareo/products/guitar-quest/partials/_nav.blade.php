<!--- Guitar Quest Nav -->
<nav class="bg-darkblue flex px-2 py-3 sm:px-3 sticky top-0 z-150 items-center"
    x-data="{ atElement: 'your_quest' }"
    @scroll.window="atElement = document.querySelector('#your_way').getBoundingClientRect().top <= 70 ? 'your_way' : (document.querySelector('#your_teacher').getBoundingClientRect().top <= 70 ? 'your_teacher': (document.querySelector('#your_skills').getBoundingClientRect().top <= 70 ? 'your_skills' : (document.querySelector('#your_map').getBoundingClientRect().top <= 70 ? 'your_map' : 'your_quest')))">
    <a class="block mr-3 sm:mr-6 md:mr-0 md:flex-shrink-0" href="/guitar-quest" title="Goes to Guitar Quest homepage">
        <img src="https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2Fguitar-quest-logo.png?auto=format&ixlib=php-1.2.1&w=1000&s=44e6146b6f2aed70b7a6adb1d18cb50f" width="170" alt="Guitar Quest Logo">
    </a>
    <ul class="flex items-center text-center uppercase m-0 px-3 list-none font-primary font-semibold hidden lg:inline-flex">
        <li class="px-3">
            <a @click.stop="atElement = 'your_quest'"
               href="#your_quest"
               class="text-white transition relative duration-200 linear text-goldenrod-hover"
               :class="{ 'active' : atElement==='your_quest' }"
            >
               Your Quest
            </a>
        </li>
        <li class="px-3">
            <a @click.stop="atElement = 'your_map'"
               href="#your_map"
               class="text-white transition relative duration-200 linear text-goldenrod-hover"
               :class="{ 'active' : atElement==='your_map' }"
            >
                Your Map
            </a>
        </li>
        <li class="px-3">
            <a @click.stop="atElement = 'your_skills'"
               href="#your_skills"
               class="text-white transition relative duration-200 linear text-goldenrod-hover"
               :class="{ 'active' : atElement==='your_skills' }"
            >
            Your Skills
            </a>
        </li>
        <li class="px-3">
            <a @click.stop="atElement = 'your_teacher'"
               href="#your_teacher"
               class="text-white transition relative duration-200 linear text-goldenrod-hover"
               :class="{ 'active' : atElement==='your_teacher' }"
            >
                Your Teacher
            </a>
        </li>
        <li class="px-3">
            <a @click.stop="atElement = 'your_way'"
               href="#your_way"
               class="text-white transition relative duration-200 linear text-goldenrod-hover"
               :class="{ 'active' : atElement==='your_way' }"
            >
                Your Way
            </a>
        </li>
    </ul>
    <div class="ml-auto items-center inline-flex flex-shrink-0 ">

            <a class="bg-goldenrod-gradient transition duration-300 linear px-6 md:px-8 py-1 inline-block uppercase text-black font-roboto-condensed-bold rounded-full" title="Go To Order Page" href="{{ $orderLink }}">Order Now</a>

    </div>
</nav>





