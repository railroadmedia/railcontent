<script setup>
import { ref } from 'vue'
import Pill from './Pill.vue'
const props = defineProps({
    options: {
        type: Array,
        default: []
    },
    classOverride: {
        type: String,
        default: ''
    },
    initialSelection: {
        type: Object,
        default: {}
    }
})
const emit = defineEmits(['onChangeSelection'])
const initialValues = props.options.reduce(
    (prev, curr) => ({ ...prev, [curr.value]: false }),
    {}
)
let selectedValues = ref({ ...initialValues, ...props.initialSelection })

function handleSelection(value) {
    const newSelectedValues = {
        ...selectedValues.value,
        [value]: !selectedValues.value[value]
    }
    selectedValues.value = newSelectedValues
    emit('onChangeSelection', newSelectedValues)
}
</script>

<template>
    <div
        class="tw-flex tw-flex-row tw-items-center tw-justify-center tw-w-full tw-px-[12px] md:tw-w-[620px] lg:tw-w-[750px] tw-flex-wrap"
        :class="classOverride"
    >
        <Pill
            v-for="option in options"
            v-bind:key="`${option.value}-pill`"
            :text="option.text"
            :value="option.value"
            :active="!!selectedValues[option.value]"
            @onSelect="handleSelection"
        />
    </div>
</template>
