<template>
    <PageHeaderDropdown v-bind="$attrs" faIconClass="fa fa-download" :text="downloadResourcesText" v-if="areResourcesDownloadable">
        <template v-slot:content>
            <ul class="tw-w-max">
                <li v-for="(resource, index) in resources" :key="resource.resource_id"
                    class="pa-1 tw-bg-[#000C17] hover:tw-bg-white ">
                    <a :href="resource.resource_url"
                        class="tw-block tw-uppercase tw-font-bebas-neue tw-no-underline tw-text-white dark:tw-text-white hover:tw-text-[#000C17] hover:dark:tw-text-[#000C17]" target="_blank"
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
import { ref, computed, useAttrs } from 'vue';
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

const attrs = useAttrs()

const downloadResourcesText = attrs.inDropdown ? 'Download Resources' : null;

</script>