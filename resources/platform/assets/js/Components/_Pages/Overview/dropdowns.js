export const dropdowns = {
    challenges: {
        unlock : (title) => {
            return [
                {
                    props: {
                        text: 'Unlock',
                        modalType: 'unlock',
                    },
                    type: 'UnlockChallengeCta'
                },
                {
                    props: {
                        text: `Leave ${title}`,
                        modalType: 'leave',
                    },
                    type: 'LeaveChallengeCta'
                },
            ]
        },
        unlocked: (title, url) => {
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
