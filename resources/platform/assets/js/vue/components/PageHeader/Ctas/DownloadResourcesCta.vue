<template>
    <PageHeaderDropdown faIconClass="fa fa-download" v-if="areResourcesDownloadable">
        <template v-slot:content>
            <ul class="tw-w-max">
                <li v-for="(resource, index) in resources" :key="resource.resource_id"
                    class="pa-1 tw-hover:bg-[#f2f2f2] tw-border-b tw-border-[#d1d1d1] last:tw-border-b-0">
                    <a :href="resource.resource_url"
                        class="tw-block tw-uppercase tw-font-bebas-neue tw-no-underline tw-text-[#00101D]" target="_blank"
                        download>
                        <i :class="['fas', getIconClass(resource.resource_url), 'tw-mr-1']" style="width:20px;"></i>
                        {{ resource.resource_name }}
                    </a>
                </li>
            </ul>
        </template>
    </PageHeaderDropdown>
</template>

<script setup>
import { ref, computed } from 'vue';
import PageHeaderDropdown from '../PageHeaderDropdown.vue';

const props = defineProps({
    resources: Object,
});

const areResourcesDownloadable = computed(() => props.resources && Object.keys(props.resources)?.length > 0);

const getIconClass = (filename) => {
    const extension = filename.split('.').pop();

    switch (extension) {
        case 'png':
            return 'fa-file-text';
        case 'pdf':
            return 'fa-file-pdf';
        case 'zip':
            return 'fa-file-archive';
        case 'mp3':
        case 'wav':
            return 'fa-file-audio';
        case 'mp4':
            return 'fa-file-video';
        default:
            return 'fa-cloud-download';
    }
};
</script>