<script>
export default {
    props: {
        id: {
            type: String,
            default: 'text-input'
        },
        brand: {
            type: String,
            default: 'drumeo'
        },
        type: {
            type: String,
            default: 'video'
        },
        title: {
            type: String,
            default: 'Section'
        },
        data: {
            type: Array,
            default: [],
        },
        isVisible: {
            type: Boolean,
            default: true
        }
    },
}
</script>

<template>
    <section class="tw-text-[#00101D] dark:tw-text-white">
        <div class="tw-my-8">
            <h2 class="tw-text-2xl lg:tw-text-3xl">{{ title }}</h2>

            <template v-if="type === 'video'">
                <p>Print Video Cards</p>
            </template>

            <template v-if="type === 'coach'">
                <p>Print Coach Cards</p>
            </template>

            <template v-if="type === 'forum'">
                <p>Print Forum Cards</p>
            </template>
        </div>    
    </section>
</template>