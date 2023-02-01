<script setup>
const props = defineProps({
    classOverride: {
        type: String,
        default: ''
    },
    headTitles: {
        type: Array,
        default: ['Name', 'Date', 'Time', '']
    },
    rows: {
        type: Array,
        default: [
            [
                {
                    thumb: 'https://placehold.jp/48x48.png',
                    content: 'White Bangers'
                },
                {
                    content: 'May 2, 2020'
                },
                {
                    content: '44:05'
                },
                {
                    showActionSlot: true,
                    actionPayload: '12345'
                }
            ],
            [
                {
                    thumb: 'https://placehold.jp/48x48.png',
                    content: 'Rock and Metal Inspirations'
                },
                {
                    content: 'May 2, 2020'
                },
                {
                    content: '44:05'
                },
                {
                    showActionSlot: true,
                    actionPayload: '12345'
                }
            ],
        ]
    }
});
const emit = defineEmits(['onActionClick']);
</script>

<template>
    <div class="tw-w-full tw-relative tw-overflow-x-auto tw-shadow-md" :class="classOverride">
        <table class="tw-w-full tw-text-left tw-text-white dark:tw-text-white">
            <thead class=" tw-text-[16px] tw-text-white tw-bg-[#031d32] dark:tw-text-white tw-font-bold tw-rounded-t tw-overflow-hidden">
                <tr>
                    <th v-for="title in headTitles" scope="col" class="tw-px-6 tw-py-3">
                        {{ title }}
                    </th>
                </tr>
            </thead>
            <tbody class="tw-text-[14px]">
                <tr v-for="([firstCol, ...cols], index) in rows" :class="`${index%2 === 0 ? 'tw-bg-[#071826]' : 'tw-bg-[#00101D]'}`">
                    <th scope="row" class="tw-px-6 tw-py-4 tw-font-medium tw-whitespace-nowrap dark:text-white">
                        <div class="tw-flex tw-flex-row tw-w-full tw-h-full tw-items-center">
                            <img v-if="firstCol.thumb" :src="firstCol.thumb" class="tw-w-[48px] tw-h-[48px] tw-m-[4px]" /><span class="tw-ml-[10px]">{{ firstCol.content }}</span>
                        </div>
                    </th>
                    <td v-for="col in cols" class="tw-px-6 tw-py-4">
                        <span v-if="!col.showActionSlot && col.content">{{ col.content }}</span>
                        <button v-if="col.showActionSlot" @click="() => emit('onActionClick', col.actionPayload)">
                            <slot name="actionContent"></slot>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
