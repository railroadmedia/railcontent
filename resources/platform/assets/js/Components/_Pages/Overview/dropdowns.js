export const dropdowns = {
    challenges: {
        unlock : [
            {
                props: {
                    text: 'Unlock',
                    modalType: 'unlock',
                },
                type: 'UnlockChallengeCta'
            }
        ],
        unlocked: (url) => {
            return [
                {
                    props: {
                        text: 'Enroll Now',
                        url,
                    },
                    type: 'PageHeaderCta'
                }
            ]
        }
    }
}
