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
    }
})
const emit = defineEmits(['onChangeSelection'])
const initialValues = props.options.reduce(
    (prev, curr) => ({ ...prev, [curr.value]: false }),
    {}
)
let selectedValues = ref(initialValues)

function handleSelection(value) {
    console.log(value)
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
        class="tw-flex tw-flex-row tw-items-center tw-justify-center"
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
