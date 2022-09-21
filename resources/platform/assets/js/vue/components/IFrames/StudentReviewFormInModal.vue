<script setup>
    const props = defineProps({
        brand: {
            type: String,
            default: 'drumeo'
        }
    });
</script>

<template>
    <div id="applicationModalVue" class="modal displayed active">
        <div class="tw-text-[#00101D] tw-flex tw-flex-col tw-bg-white tw-rounded-[10px] tw-shadow tw-p-[30px]">
            <div class="tw-flex tw-flex-row tw-mb-[30px]">
                <h1 class="subheading">Student Review Application</h1>
            </div>

            <div class="flex flex-column tw-w-full">
                    <student-review-form
                        v-if="brand === 'drumeo'"
                        url="https://docs.google.com/forms/d/e/1FAIpQLSdRzf0Wg4meObJi0ovKlUDgbBDYDpJP7MCguIDmPFDybchViQ/viewform?embedded=true"
                        height="1600"
                    >
                    </student-review-form>

                    <student-review-form
                        v-if="brand === 'pianote'"
                        url="https://docs.google.com/forms/d/e/1FAIpQLSe4Soy7CDxk9Aw9_kuJvK9f3FyojMfLkuqezIsvKNUFQPD51w/viewform?embedded=true"
                        height="1400"
                    >
                    </student-review-form>

                    <student-review-form
                        v-if="brand === 'guitareo'"
                        url="https://docs.google.com/forms/d/e/1FAIpQLSfqS5HTrmln2sd7QaNt9Er31fY2becXt4n6isN57HbGwVPHFg/viewform?embedded=true"
                        height="1400"
                    >
                    </student-review-form>

                    <student-review-form
                        v-if="brand === 'singeo'"
                        url="https://docs.google.com/forms/d/e/1FAIpQLSeWyMtqVuQjMdA7rrZMK2jCkAIaPLeycTr0zXUE6LEaD6OmyQ/viewform?embedded=true"
                        height="1400"
                    >
                    </student-review-form>
            </div>
        </div>
    </div>
</template>
