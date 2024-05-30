import { ref } from 'vue';
import { useUserStore } from "../../stores/user";
import ContentService from '../vuesora/assets/js/services/content';

export function useResetProgress() {
    const loading = ref(false);
    const userStore = useUserStore();

    const resetProgress = (contentId, iconClassRef, showConfirmation = true, arrayRef) => {
        const proceedWithReset = () => {
            iconClassRef.value = 'fas fa-spin fa-spinner';
            loading.value = true;

            if(arrayRef){
                arrayRef.value = arrayRef.value.filter((item) => item.id !== contentId);
            }

            ContentService.resetContentProgress(contentId)
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
            Toasts.confirm({
                title: 'Hold your horses… This will reset your progress, are you sure about this?',
                submitButton: {
                    text: `<span class="bg-${userStore.brand} text-white short">I want to start over</span>`,
                    callback: proceedWithReset,
                },
                cancelButton: {
                    text: '<span class="bg-grey-3 inverted text-grey-3 short">Get me out of here</span>',
                },
            });
        } else {
            proceedWithReset();
        }
    };

    return { resetProgress, loading };
}
