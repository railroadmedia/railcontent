<script>
export default {
    name: 'InstrumentCardContent',
    props: ['instrumentText', 'logoUrl', 'logoAltText']
}
</script>

<template>
    <div
        class="tw-flex tw-h-full tw-w-full tw-flex-col tw-items-center tw-justify-center tw-text-white"
    >
        <div
            class="tw-text-[75px] tw-leading-[45px]"
            style="font-family: Bebas Neue"
        >
            {{ instrumentText }}
        </div>
        <div
            class="tw-mt-[10px] tw-flex tw-flex-row tw-items-center tw-justify-center"
            style="
                font-family: Open Sans;
                font-weight: 600;
                line-height: 9px;
                font-size: 10px;
            "
        >
            BY&nbsp;
            <img
                class="tw-h-[23px] tw-w-auto"
                :src="logoUrl"
                :alt="logoAltText"
            />
        </div>
    </div>
</template>
