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
            <BeakerIcon class="tw-h-5 tw-w-5 tw-text-blue-500" />
            <br />
            <Drumeo class="tw-h-5 tw-w-5 tw-text-blue-500" />
            <br />
            <Drums class="tw-h-5 tw-w-5 tw-text-blue-500" />
            <br />
            <DrumsAlt class="tw-h-5 tw-w-5 tw-text-blue-500" />
            <br />
            <Edge class="tw-h-5 tw-w-5 tw-text-blue-500" />
            <br />
            <Guitar class="tw-h-5 tw-w-5 tw-text-blue-500" />
            <br />
            <GuitarAlt class="tw-h-5 tw-w-5 tw-text-blue-500" />
            <br />
            <Guitareo class="tw-h-5 tw-w-5 tw-text-blue-500" />
            <br />
            <Lifetime class="tw-h-5 tw-w-5 tw-text-blue-500" />
            <br />
            <Microphone class="tw-h-5 tw-w-5 tw-text-blue-500" />
            <br />
            <Piano class="tw-h-5 tw-w-5 tw-text-blue-500" />
            <br />
            <Pianote class="tw-h-5 tw-w-5 tw-text-blue-500" />
            <br />
            <Singeo class="tw-h-5 tw-w-5 tw-text-blue-500" />
            <br />
            <Sticks class="tw-h-5 tw-w-5 tw-text-blue-500" />
            <br />
            <Wave class="tw-h-5 tw-w-5 tw-text-blue-500" />
        </PageContainer>
    </div>
</template>
