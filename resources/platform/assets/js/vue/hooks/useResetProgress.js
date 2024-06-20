import { ref } from 'vue';
import axios from "axios";

export function useResetProgress() {
    const loading = ref(false);

    const resetProgress = (contentId, iconClassRef, showConfirmation = true, arrayRef) => {
        const proceedWithReset = () => {
            iconClassRef.value = 'fas fa-spin fa-spinner';
            loading.value = true;

            if(arrayRef){
                arrayRef.value = arrayRef.value.filter((item) => item.id !== contentId);
            }

            axios.put(`/railcontent/reset`, {
                content_id: contentId,
            })
            .then(() => {
                window.shownotification({
                    icon: 'check',
                    text: 'Ready to start again? Your progress has been reset.'
                });

                iconClassRef.value = 'fas fa-redo-alt fa-flip-horizontal';

                 if(!arrayRef) {
                    setTimeout(() => {
                        location.reload();
                    },500);
                 }
            })
            .finally(() => {
                loading.value = false;
            });
        };

        if (showConfirmation) {
            window.showconfirmationmodal({
                title: 'Hold your horses… This will reset your progress, are you sure about this?',
                callbacks: {
                    submit: () => {
                        proceedWithReset();
                    },
                    cancel: () => {
                        console.log('Reset progress cancelled');
                    }
                }
            });
        } else {
            proceedWithReset();
        }
    };

    return { resetProgress, loading };
}
