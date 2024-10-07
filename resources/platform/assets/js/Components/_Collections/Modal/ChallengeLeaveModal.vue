<template>
    <InfoModal :selfContained="true" class-override="tw-max-w-[593px] tw-w-full dark:tw-text-white" title="Are you sure you want o leave 30-Day Drummer?">
        <p class="tw-mb-5">Leaving 30-Day drummer will delete your progress.</p>
        <div class="tw-flex tw-justify-end">
            <MuButton>Leave Challenge</MuButton>
        </div>
    </InfoModal>
</template>
<script setup>
import InfoModal from '@collections/Modal/InfoModal';
import MuButton from '@units/Button/MuButton';
</script>
