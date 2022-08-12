<script setup>
import { ref } from 'vue';
import GearCard from './GearCard.vue';

const gearCarouselMap = [
    {   brand: 'pianote',
        imgKey: 'piano_gear_photo',
        cardTitle: 'Piano Gear',
        attributes: [
            { label: 'Playing Since', key: 'piano_playing_since_year' },
            { label: 'Piano', key: 'piano_gear_piano_brands' },
            { label: 'Keyboard', key: 'piano_gear_keyboard_brands' },
        ]
    }, {
        brand: 'singeo',
        imgKey: 'singing_gear_photo',
        cardTitle: 'Singing Gear',
        attributes: [
            { label: 'Singing Since', key: 'singing_since_year' },
            { label: 'Mic', key: 'singing_gear_mic_brands' },
        ]
    }, {
        brand: 'guitareo',
        imgKey: 'guitar_gear_photo',
        cardTitle: 'Guitar Gear',
        attributes: [
            { label: 'Played Guitar Since', key: 'guitar_playing_since_year' },
            { label: 'Guitars', key: 'guitar_gear_guitar_brands' },
            { label: 'Amps', key: 'guitar_gear_amp_brands' },
            { label: 'Pedals', key: 'guitar_gear_pedal_brands' },
            { label: 'Strings', key: 'guitar_gear_string_brands' },
        ]
    },
    {
        brand: 'drumeo',
        imgKey: 'drums_gear_photo',
        cardTitle: 'Drum Gear',
        attributes: [
            { label: 'Drumming Since', key: 'drums_playing_since_year' },
            { label: 'Drums', key: 'drums_gear_set_brands' },
            { label: 'Cymbals', key: 'drums_gear_cymbal_brands' },
            { label: 'Hardware', key: 'drums_gear_hardware_brands' },
            { label: 'Sticks', key: 'drums_gear_stick_brands' },
        ]
    }
];

const props = defineProps({
    gearInfo: {
        type: Object,
        default: {}
    }
});

const buildCarouselData = (info) => {
    return gearCarouselMap.map(({ imgKey, attributes, ...rest }) => {
        return ({
            img_src: info[imgKey],
            attributes: attributes.map(({ label, key }) => ({
                label, value: info[key]
            })),
            ...rest,
        });
    });
};

const carouselData = ref(buildCarouselData(props.gearInfo));

const currentSlide = ref(0);

const handleNext = () => {
    if (currentSlide.value === carouselData.value.length - 1) {
        currentSlide.value = 0;
    } else {
        currentSlide.value = currentSlide.value + 1;
    }
};

const handlePrev = () => {
    if (currentSlide.value === 0) {
        currentSlide.value = carouselData.value.length - 1;
    } else {
        currentSlide.value = currentSlide.value - 1;
    }
};
</script>

<template>
    <div class="tw-flex tw-overflow-hidden tw-w-full tw-max-w-[665px]">
        <GearCard
          v-for="{ img_src, attributes, brand, cardTitle }, index in carouselData"
          :key="`${brand}${cardTitle}`"
          :attributes="attributes"
          :img_src="img_src"
          :title="cardTitle"
          :brand="brand"
          :isCurrentSlide="currentSlide === index"
          @onNextSlide="handleNext"
          @onPrevSlide="handlePrev"
        />
    </div>
</template>
