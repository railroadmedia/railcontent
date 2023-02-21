<script setup>
    import { onBeforeMount, watch, ref, inject, computed, reactive } from 'vue';

    //-----------Props-----------//
    const props = defineProps({
        brand: {
            type: String,
            default: "drumeo"
        },
        itemQuantity: {
            type: Number,
            default: null,
            required: true,
        },
        limit: {
            type: Number,
            default: 10,
        }
    });

    const pageQuantity = computed(()=> {
        return Math.ceil(props.itemQuantity / props.limit);
    })

    //-----------Refs-----------//
    let page = ref(1);

    //-----------Emits-----------//
    const emit = defineEmits(['onPageChange']);

    //-----------Lifecycle Hooks-----------//
    onBeforeMount(()=> {
        console.log(props.itemQuantity , props.limit)
    })

</script>
<template>
    <div v-if="pageQuantity !== 1"
        class="tw-flex tw-items-center tw-justify-center dark:tw-text-white tw-mt-4"
    >
        <button class="tw-p-1" @click="backPage">prev</button>
        <button
            class="tw-p-1"
            v-for="pageNumber in pageQuantity"
            :key="pageNumber"
            @click="() => onPageChange(pageNumber)"
        >
            {{ pageNumber }}
        </button>
        <button class="tw-p-1" @click="nextPage">next</button>
    </div>
</template>