import { defineStore } from 'pinia';

export const usePlatformStore = defineStore({
    id: 'platform',
    state: () => ({
        tinymcePath: '', 
        isLoading: true,
        membershipUpgradeModal: {
            open: false,
            disableClose: false,
        },
        sanityConfig: {
            token:'skhignhoJViFp4dhFlyE72d7ShYmU9WdDkqJPqLI5jHi0h3FR6haWUnzGus37cpB6woqh4pkMt7qNzEFyPAzZTjOXTranUUF9YFBYBEHQkZREqydD2wVdCiCx96TRJBKCou6FwrO6lr7cA2qDHsxDJG6aHDAWKrbAxy9Humj92NObVzNOeyQ',
            projectId:'4032r8py',
            dataset:'staging', 
            version:'2021-06-07',
            debug: true,
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
