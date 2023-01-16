<script setup>
    const props = defineProps({
        disabled: {
            type: Boolean, 
            default: false,
        },
        checked: {
            type: Boolean,
            default: false,
        },
        hiddenInput: {
            type: Boolean,
            default: false,
        },
        brand: {
            type: String,
            default: "drumeo",
        },
        selectedBrand: String,
        name: String,
        id: String,
        inputLabel: String,
    })
</script>
<template>
    <fieldset class="tw-flex tw-flex-row tw-items-center">

        <!-- Toggle Wrapper -->
        <div class="tw-inline-flex tw-relative tw-w-[48px] mr-1 tw-rounded-full tw-ring-offset-2 focus-within:tw-ring-1">
            <!-- Hidden Input -->
            <input v-if="hiddenElement" 
                    type="hidden" 
                    class="hidden-input" 
                    :name="name" 
                    :value="[checked ? 1 : 0]"
            >
            <!-- Checkbox Input -->
            <input tabindex="0" 
                    type="checkbox" 
                    :name="name" 
                    :id="id" 
                    class="tw-peer tw-absolute tw-h-0 tw-w-0 tw-top-[10px] tw-left-[10px]"
                    :checked="checked"
                    :disabled="disabled"
            >
            <label tabindex="-1" 
                    :for="id" 
                    class="tw-cursor-pointer tw-inline-flex tw-w-full tw-h-[24px] tw-p-[2px] tw-transition-colors tw-transform-gpu tw-duration-75 tw-shadow tw-rounded-full tw-bg-gray-400 dark:tw-bg-[#445F74] peer-disabled:tw-opacity-70 peer-disabled:tw-pointer-events-none" 
                    :class="`peer-checked:tw-bg-${ !empty(selectedBrand) ? selectedBrand : brand }`">
            </label>
            <!-- Handle -->
            <label tabindex="-1" 
                    :for="id" 
                    class="tw-cursor-pointer tw-w-[20px] tw-h-[20px] tw-bg-white tw-rounded-full tw-transition-all transform-gpu tw-duration-75 tw-absolute tw-top-[2px] tw-right-[calc(100%-22px)] peer-checked:tw-right-[2px] peer-disabled:tw-opacity-70 peer-disabled:tw-pointer-events-none">
            </label>
        </div>
        <!-- Toggle Text -->
        <label tabindex="-1" 
                :for="id" 
                class="tw-cursor-pointer tw-text-[#00101D] dark:tw-text-white tw-text-sm">
            {{ inputLabel }}
        </label>

    </fieldset>
</template>