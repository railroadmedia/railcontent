import { defineStore } from 'pinia';

export const usePlatformStore = defineStore({
    id: 'platform',
    state: () => ({
        tinymcePath: '', 
        isLoading: true,
        membershipUpgradeModal: {
            open: false,
            disableClose: false,
        }
    }),
    actions: {
        setTinymcePath (path) {
            this.tinymcePath = path;
        },
        setLoadingState (val) {
            this.isLoading = val;
        },
        openMembershipUpgradeModal() {
            this.membershipUpgradeModal.open = true;

            setTimeout(() => {
                const element = document.getElementById('modal-top');
                if(element && element.getBoundingClientRect().top < -50){
                    document.getElementById('modal-top').scrollIntoView({
                        behavior: 'smooth',
                    });
                }
            }, 300)
        },
        closeMembershipUpgradeModal() {
            this.membershipUpgradeModal.open = false;
        },
        disableCloseMembershipUpgradeModal() {
            this.membershipUpgradeModal.disableClose = true;
        }
    },
})
