<script>
const colors = {
    drumeo: {
        solidBg: '#00101d',
        bgRgb: 'rgba(0, 16, 29, 0)',
        subtitle: '#7E9AB1'
    },
    guitareo: {
        solidBg: '#101817',
        bgRgb: 'rgba(0, 16, 29, 0)',
        subtitle: '#717179'
    },
    singeo: {
        solidBg: '#18131C',
        bgRgb: 'rgba(0, 16, 29, 0)',
        subtitle: '#717179'
    },
    pianote: {
        solidBg: '#201617',
        bgRgb: 'rgba(0, 16, 29, 0)',
        subtitle: '#717179'
    }
}

export default {
    name: 'HeaderTemplate',
    props: [
        'brand',
        'backgroundImage',
        'topSubtitle',
        'bottomSubtitle',
        'shortBio',
        'actionSlot',
        'titleSlot'
    ],
    setup(props, context) {
        return {
            colors,
            brandColors: colors[props.brand],
            hasTitleSlot: !!context.slots.titleSlot,
            hasActionSlot: !!context.slots.actionSlot
        }
    }
}
</script>

<template>
    <section
        class="xs:tw-grid-cols-1 tw-grid tw-gap-0 sm:tw-grid-cols-1 md:tw-grid-cols-1 lg:tw-grid-cols-2"
    >
        <div
            class="tw-bg-top lg:tw-hidden"
            :style="{
                backgroundColor: colors[brand]['solidBg'],
                backgroundImage: `url(${backgroundImage})`,
                color: '#fff',
                backgroundSize: 'cover',
                minHeight: '25vh',
                backgroundPosition: '50%'
            }"
        >
            <div
                :style="{
                    width: '100%',
                    height: '100%',
                    background: `linear-gradient(180deg,${colors[brand].bgRgb} 50%,${colors[brand]['solidBg']})`
                }"
            ></div>
        </div>
        <div
            class="tw-text-white"
            :style="{ backgroundColor: brandColors['solidBg'] }"
        >
            <div
                class="tw--mt-24 tw-py-12 tw-pl-6 tw-text-center md:tw-mt-0 md:tw-py-12 md:tw-px-14 lg:tw-py-16 lg:tw-text-left"
            >
                <h2
                    v-if="topSubtitle"
                    class="tw-mb-2 tw-font-semibold tw-font-bold tw-uppercase"
                    :style="{
                        color: brandColors['subtitle'],
                        fontSize: '14px',
                        lineHeight: '24px'
                    }"
                >
                    {{ topSubtitle }}
                </h2>

                <h1
                    v-if="hasTitleSlot"
                    class="tw-mb-3 tw-font-normal tw-uppercase"
                    :style="{
                        fontSize: '40px',
                        lineHeight: '36px'
                    }"
                >
                    <slot name="titleSlot"></slot>
                </h1>
                <h2
                    v-if="bottomSubtitle"
                    class="tw-mb-2 tw-font-semibold tw-font-bold tw-uppercase"
                    :style="{
                        color: brandColors['subtitle'],
                        fontSize: '14px',
                        lineHeight: '24px'
                    }"
                >
                    {{ bottomSubtitle }}
                </h2>
                <h3
                    v-if="shortBio"
                    class="tw-mb-6 tw-font-normal"
                    style="font-size: 14px; line-height: 24px"
                >
                    {{ shortBio }}
                </h3>
                <div
                    v-if="hasActionSlot"
                    class="tw-flex tw-flex-col tw-flex-wrap tw-items-center lg:tw-flex-row xl:tw-flex-nowrap xl:tw-items-start"
                >
                    <slot name="actionSlot"></slot>
                </div>
            </div>
        </div>
        <div
            class="tw-hidden tw-bg-top lg:tw-flex"
            :style="{
                backgroundColor: colors[brand]['solidBg'],
                backgroundImage: `url(${backgroundImage})`,
                color: '#fff',
                backgroundSize: 'cover',
                backgroundPosition: '50%'
            }"
        >
            <div
                :style="{
                    width: '100%',
                    height: '100%',
                    background: `linear-gradient(268deg,${colors[brand].bgRgb} 50%,${colors[brand]['solidBg']})`
                }"
            ></div>
        </div>
    </section>
</template>
