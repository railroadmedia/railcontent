<script>
import PageContainer from '@/components/PageContainer/PageContainer.vue'
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
import { BeakerIcon } from '@heroicons/vue/solid'

export default {
    name: 'App',
    components: {
        PageContainer,
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
        </PageContainer>
    </div>
</template>
