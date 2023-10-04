<template>
    <InfoModal title="Report An Issue" modalId="report-modal" classOverride="tw-bg-white dark:tw-bg-[#081825] tw-max-w-[475px] tw-border-[1px] tw-border-[#223F57] tw-p-[30px]" :selfContained="true" @onClose="emit('onCloseModal')">
       <div>
           <textarea v-model="content" class="tw-w-full tw-rounded tw-border tw-border-[#D1D5DB] dark:tw-border-[#445F74] dark:tw-bg-[#000C17] tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-placeholder-[#3F3F46] dark:tw-placeholder-[#9EC0DC] tw-text-sm tw-mb-7" rows="6" placeholder="Please describe the issues you're facing with this lesson..." />
           <div class="tw-flex tw-justify-between">
               <button class="tw-order-1 sm:tw-order-none tw-btn-primary tw-text-center tw-justify-center tw-items-center tw-text-[#00101D] dark:tw-text-white tw-border-2 tw-border-[#000C17] dark:tw-border-white tw-bg-white dark:tw-bg-[#00101D] hover:tw-bg-[#00101D] hover:tw-text-white dark:hover:tw-bg-white dark:hover:tw-text-[#00101D]" @click="emit('onCloseModal')">CANCEL</button>
               <button class="tw-mb-2 sm:tw-mb-0 sm:tw-ml-4 tw-btn-primary tw-text-white dark:tw-text-[#00101D] tw-bg-[#00101D] dark:tw-bg-white hover:tw-bg-[#3F3F46] dark:hover:tw-bg-[#223F57] dark:hover:tw-text-white tw-text-center tw-flex tw-justify-center tw-items-center" @click="handleSubmit" :disabled="content == ''">Submit</button>
           </div>
       </div>
    </InfoModal>
</template>

<script setup>
    import {ref} from "vue";
    import axios from 'axios';
    import InfoModal from './InfoModal';

    const props = defineProps({
        brand: {
            type: String,
            default: '',
        },
        recipient: {
            type: String,
            default: '',
        },
        logo: {
            type: String,
            default: '',
        },
        userName: {
            type: String,
            default: '',
        },
        userEmail: {
            type: String,
            default: '',
        },
    });

    const emit = defineEmits(['onCloseModal']);

    const content = ref('');

    const handleSubmit = async() => {
        if(content.value){
            try{
                const formData = new FormData();
                formData.append('type', 'layouts/inline/alert');
                formData.append('subject',`Lesson Error Report by: ${props.userName} (${props.userEmail})`);
                formData.append('lines[]', content.value);
                formData.append('brand', props.brand);
                formData.append('logo', props.logo);
                formData.append('recipient', props.recipient);
                formData.append('alert', `Lesson Error Report by: ${props.userName} (${props.userEmail})`);

                const submit = await axios.post('/mailora/secure/send', formData, {headers: {'Content-Type': 'multipart/form-data'} });

                emit('onCloseModal');
                window.shownotification({
                    icon: 'check',
                    text: `Your issue has been reported. A mentor will review your issue soon.`
                })
            }
            catch(e){
                window.shownotification({
                    icon: 'error',
                    text: 'Woops! Something wrong happened, please try again later.'
                })
            }

        }

    }
</script>

