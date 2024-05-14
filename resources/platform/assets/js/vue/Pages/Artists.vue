<template>
    <PageHeader title="Artists" />
    <div class="tw-p-4 md:tw-p-8">
        <h1 class="tw-pb-4 md:tw-pb-8 tw-text-2xl tw-font-bold dark:tw-text-white">{{ numberOfArtists }} Artists</h1>
        <div class="tw-mx-auto tw-columns-xs">
            <ul class="tw-list-disc tw-list-inside dark:tw-text-white tw-mb-1" v-for="(group, letter) in groupedArtists" :key="letter">
                <h2 class="tw-font-bold tw-text-xl">{{ letter }}</h2>
                <li v-for="artist in group" :key="artist.url" class="tw-m-2">
                    <a :href="artist.url" class="tw-text-[#00101D] dark:tw-text-white hover:tw-underline">{{ artist.name }}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import PageHeader from '../components/PageHeader/PageHeader.vue';

const props = defineProps({
    artists: Array
});

const alphabeticallyGroupedArtists = (artists) => {
    const grouped = artists.reduce((acc, artist) => {
        const letter = artist.name[0].match(/\d/) ? '#' : artist.name[0].toUpperCase();
        if (!acc[letter]) {
            acc[letter] = [];
        }
        acc[letter].push(artist);
        return acc;
    }, {});

    Object.keys(grouped).forEach(letter => {
        grouped[letter].sort((a, b) => a.name.localeCompare(b.name));
    });

    return grouped;
};

const groupedArtists = computed(() => alphabeticallyGroupedArtists(props.artists));
const numberOfArtists = computed(() => props.artists.length);
</script>