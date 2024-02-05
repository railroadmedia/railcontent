import { ref } from 'vue';
import { useUserStore } from "../../stores/user";
import ContentService from '../vuesora/assets/js/services/content';
import Toasts from '../vuesora/assets/js/classes/toasts';

export function useResetProgress() {
    const loading = ref(false);
    const userStore = useUserStore();

    const resetProgress = (contentId, iconClassRef, showConfirmation = true) => {
        const proceedWithReset = () => {
            iconClassRef.value = 'fas fa-spin fa-spinner';
            loading.value = true;

            ContentService.resetContentProgress(contentId)
                .then(() => {
                    Toasts.push({
                        icon: 'happy',
                        title: 'READY TO START AGAIN?',
                        themeColor: userStore.brand,
                        message: 'Your progress has been reset.',
                    });
                    iconClassRef.value = 'fas fa-redo-alt fa-flip-horizontal';
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
