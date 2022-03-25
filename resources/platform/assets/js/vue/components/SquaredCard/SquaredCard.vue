<script>
import { borderColor } from '../../../constants/brands'
export default {
    name: 'SquaredCard',
    props: [
        'type',
        'active',
        'backgroundUrl',
        'onSelect',
        'bgColor',
        'defaultBorderColor'
    ],
    emits: ['onSelect'],
    setup(props) {
        const getBorderColor = (type) => {
            if (['drumeo', 'guitareo', 'singeo', 'pianote'].includes(type)) {
                return borderColor[type]
            } else {
                return 'tw-border-[#7E9AB1]'
            }
        }
        return { borderColor, getBorderColor }
    }
}
</script>

<template>
    <button
        class="SquaredCard tw-rounded-lg"
        :style="{
            background: backgroundUrl ? `url(${backgroundUrl})` : bgColor,
            backgroundSize: 'cover',
            backgroundPosition: 'center'
        }"
        v-on:click="$emit('onSelect')"
    >
        <div
            :class="`SquaredCard SquaredCard__overlay--${type} ${
                active
                    ? `${getBorderColor(type)}`
                    : `${
                          defaultBorderColor
                              ? defaultBorderColor
                              : 'tw-border-transparent'
                      }`
            } hover:${
                borderColor[type]
            } tw-border-box tw-column tw-flex tw-h-full tw-w-full tw-items-center tw-justify-center tw-rounded-lg tw-border-[3px] tw-bg-cover`"
        >
            <slot />
        </div>
    </button>
</template>

<style type="text/css">
@import './squared-card.css';
</style>
