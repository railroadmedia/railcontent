<script>
import PageContainer from '@/components/PageContainer/PageContainer.vue'
import CoachHeader from './components/CoachHeader/CoachHeader.vue'
import CoachOfTheMonthHeader from './components/CoachHeader/CoachOfTheMonthHeader.vue'
import { BeakerIcon } from '@heroicons/vue/solid'
import {
    Drumeo,
    Drums,
    DrumsAlt,
    Edge,
    Guitar,
    GuitarAlt,
    Guitareo,
    Lifetime,
    Microphone,
    Piano,
    Pianote,
    Singeo,
    Sticks,
    Wave
} from '@/components/MusoraIcons'

export default {
    name: 'App',
    components: {
        PageContainer,
        CoachHeader,
        CoachOfTheMonthHeader,
        BeakerIcon,
        Drumeo,
        Drums,
        DrumsAlt,
        Edge,
        Guitar,
        GuitarAlt,
        Guitareo,
        Lifetime,
        Microphone,
        Piano,
        Pianote,
        Singeo,
        Sticks,
        Wave
    }
}
</script>

<template>
    <div>
        <PageContainer>
            <CoachHeader
                backgroundImage="https://musora.imgix.net/https%3A%2F%2Fd1923uyy6spedc.cloudfront.net%2Fgreyson-playing-1643737463.jpg?auto=format&crop=faces%2Cedges&fit=crop&ixlib=php-1.2.1&s=0e22ebce257b6a48adda52d3ba4027bd"
                shortBio="Big Band is where it all started. You’ll learn the fundamentals of drumming’s most celebrated style from a modern-day prodigy."
                coachName="GREYSON NEKRUTMAN"
                coachFocus="BIG BAND DRUMMING ESSENTIALS"
                brand="drumeo"
            />
            <CoachOfTheMonthHeader
                backgroundImage="https://musora.imgix.net/https%3A%2F%2Fd1923uyy6spedc.cloudfront.net%2Fgreyson-playing-1643737463.jpg?auto=format&crop=faces%2Cedges&fit=crop&ixlib=php-1.2.1&s=0e22ebce257b6a48adda52d3ba4027bd"
                shortBio="Big Band is where it all started. You’ll learn the fundamentals of drumming’s most celebrated style from a modern-day prodigy."
                coachName="GREYSON NEKRUTMAN"
                brand="drumeo"
            />

            Example Hero Icon
            <br />
            <BeakerIcon
                class="tw-mr-4 tw-inline tw-h-5 tw-w-5 tw-text-blue-500"
            />
            <BeakerIcon
                class="tw-mr-4 tw-inline tw-h-5 tw-w-5 tw-text-blue-500"
            />
            <br />
            <br />
            Example Custom MusoraIcons
            <br />
            <Drumeo class="tw-mr-4 tw-inline tw-h-5 tw-w-5 tw-text-blue-500" />
            <Drums class="tw-mr-4 tw-inline tw-h-5 tw-w-5 tw-text-blue-500" />
            <DrumsAlt
                class="tw-mr-4 tw-inline tw-h-5 tw-w-5 tw-text-blue-500"
            />
            <Edge class="tw-mr-4 tw-inline tw-h-5 tw-w-5 tw-text-blue-500" />
            <Guitar class="tw-mr-4 tw-inline tw-h-5 tw-w-5 tw-text-blue-500" />
            <GuitarAlt
                class="tw-mr-4 tw-inline tw-h-5 tw-w-5 tw-text-blue-500"
            />
            <Guitareo
                class="tw-mr-4 tw-inline tw-h-5 tw-w-5 tw-text-blue-500"
            />
            <Lifetime
                class="tw-mr-4 tw-inline tw-h-5 tw-w-5 tw-text-blue-500"
            />
            <Microphone
                class="tw-mr-4 tw-inline tw-h-5 tw-w-5 tw-text-blue-500"
            />
            <Piano class="tw-mr-4 tw-inline tw-h-5 tw-w-5 tw-text-blue-500" />
            <Pianote class="tw-mr-4 tw-inline tw-h-5 tw-w-5 tw-text-blue-500" />
            <Singeo class="tw-mr-4 tw-inline tw-h-5 tw-w-5 tw-text-blue-500" />
            <Sticks class="tw-mr-4 tw-inline tw-h-5 tw-w-5 tw-text-blue-500" />
            <Wave class="tw-mr-4 tw-inline tw-h-5 tw-w-5 tw-text-blue-500" />

            <div class="tw-h-[500px]"></div>
        </PageContainer>
    </div>
</template>
