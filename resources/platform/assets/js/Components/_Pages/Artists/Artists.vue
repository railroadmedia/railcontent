<template>
    <div class="tw-w-full">
        <template v-if="!isLoading">
            <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8  tw-pb-8">
                <Breadcrumb :breadcrumbs="[{ title: 'Songs', url: 'songs'  },{ title: 'Artists' }]" />
                <PageHeader title="Artists" />
                <h1 class="tw-py-4 md:tw-py-8 tw-text-2xl tw-font-bold dark:tw-text-white">{{ numberOfArtists }} Artists</h1>
                <div class="tw-mx-auto tw-columns-xs">
                    <ul class="tw-list-disc tw-list-inside dark:tw-text-white tw-mb-1" v-for="(group, letter) in groupedArtists" :key="letter">
                        <h2 class="tw-font-bold tw-text-xl">{{ letter }}</h2>
                        <li v-for="artist in group" :key="artist.name" class="tw-m-2">
                            <a :href="getURL(artist)" class="tw-text-[#00101D] dark:tw-text-white hover:tw-underline">{{ artist.name }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </template>
        <artists-skeleton v-else ></artists-skeleton>
    </div>
</template>

<script setup>
    import { ref, computed, onBeforeMount } from 'vue';
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '@stores/user';
    import { usePlatformStore } from '@stores/platform';
    import PageHeader from '@collections/PageHeader/PageHeader.vue';
    import ArtistsSkeleton from './ArtistsSkeleton.vue';
    import { useArtistPageData } from '@hooks/pages/useArtistPageData';

    // Pinia Data
    const userStore = useUserStore();
    const platformStore = usePlatformStore();
    const { brand } = storeToRefs(userStore);
    const { isLoading, sanityConfig } = storeToRefs(platformStore)

    //Refs
    const data = ref(null);

    const alphabeticallyGroupedArtists = (artists) => {
        if (!artists) return;

        const grouped = artists.sort((a, b) => a.name.localeCompare(b.name)).reduce((acc, artist) => {
            const firstChar = artist.name.charAt(0).toUpperCase();
            const letter = firstChar.match(/[A-Z]/) ? firstChar : '#';
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

    const getURL = (artist) => {
        return encodeURI('artists/' + artist.name + '?included_fields[]=type,Song');
    }

    const groupedArtists = computed(() => alphabeticallyGroupedArtists(data.value));
    const numberOfArtists = computed(() => data.value?.length);

    onBeforeMount( async () => {
        const { data: artistData, error: artistError, isLoading: artistLoading } = await useArtistPageData(sanityConfig.value, brand.value);
        data.value = artistData.value;
        platformStore.setLoadingState(artistLoading.value);
    })
</script>
