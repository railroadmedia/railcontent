<template>
    <PageHeaderCta :text="text" :faIconClass="faIconClass" :data-open-modal="modalId" showAllAlways />
    <div :id="modalId" class="modal vimeo-embedded-player">
        <div class="flex flex-column corners-10">
            <div class="video-wrap">
                <div class="widescreen">
                    <div class="flex flex-column video-player user-active">
                        <iframe
                            style="max-width: 100%; width: 100%; height: 100%; position: absolute; top: 0; left: 0;z-index: 1;"
                            :src="iframeSrc" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import PageHeaderCta from '../PageHeaderCta.vue';

const props = defineProps({
    text: String,
    faIconClass: String,
    iframeSrc: String,
});

const modalId = ref('');

onMounted(() => {
    modalId.value = `videoModalCta-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
});
</script>