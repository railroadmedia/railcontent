<script>
import HeaderTemplate from './HeaderTemplate.vue'
const subscribeToCoach = () => {}
const unsubscribeToCoach = () => {}

export default {
    name: 'CoachHeader',
    components: { HeaderTemplate },
    props: [
        'brand',
        'backgroundImage',
        'vimeoVideo',
        'coachFocus',
        'forumUrl',
        'isUserSubscribed',
        'coachName',
        'shortBio'
    ],
    setup(props, context) {
        const [name, lastName] = props.coachName.split(' ')

        return {
            subscribeToCoach,
            unsubscribeToCoach,
            name,
            lastName
        }
    }
}
</script>

<template>
    <HeaderTemplate
        brand="drumeo"
        backgroundImage="https://musora.imgix.net/https%3A%2F%2Fd1923uyy6spedc.cloudfront.net%2Fgreyson-playing-1643737463.jpg?auto=format&crop=faces%2Cedges&fit=crop&ixlib=php-1.2.1&s=0e22ebce257b6a48adda52d3ba4027bd"
        :bottomSubtitle="coachFocus"
        :shortBio="shortBio"
    >
        <template v-if="name && lastName" #titleSlot
            ><span class="tw-break-normal"
                >{{ name }} <strong>{{ lastName }}</strong></span
            ></template
        >
        <template #actionSlot>
            <div
                id="subscribeButton"
                :class="isUserSubscribed ? 'tw-hidden' : ''"
            >
                <button
                    v-on:click="subscribeToCoach(coachId, subscribeUrl)"
                    :class="`tw-btn tw-btn-primary tw-static tw-transition lg:tw-mr-4 tw-bg-${brand} hover:tw-bg-${brand}-600 tw-px-auto tw-mb-4 tw-box-border tw-w-[200px]`"
                >
                    <span>
                        <i aria-hidden="true" class="fa fa-bell tw-px-0.5"></i>
                        Subscribe</span
                    >
                </button>
            </div>
            <div
                id="unsubscribeButton"
                :class="isUserSubscribed ? '' : 'tw-hidden'"
            >
                <button
                    v-on:click="unsubscribeToCoach(coachId, unsubscribeUrl)"
                    :class="`tw-btn tw-btn-primary tw-transition lg:tw-mr-4 tw-bg-${brand} hover:tw-bg-${brand}-600 tw-px-auto tw-static tw-mb-4 tw-box-border tw-w-[200px]`"
                >
                    <span>
                        <i aria-hidden="true" class="fa fa-check tw-px-1"></i>
                        <span>Subscribed</span>
                    </span>
                </button>
            </div>
            <div v-if="forumUrl !== null" class="lg:tw-mr-4">
                <a
                    :href="forumUrl"
                    :class="`tw-btn tw-btn-primary tw-transition tw-bg-${brand} hover:tw-bg-${brand}-600 tw-px-auto tw-static tw-mb-4 tw-box-border tw-w-[200px]`"
                    style="width: 200px"
                >
                    <span>
                        <i
                            aria-hidden="true"
                            class="fa fa-question-circle tw-px-1"
                        ></i>
                        <span>Ask a question</span></span
                    >
                </a>
            </div>
            <div v-if="vimeoVideo !== null" class="lg:tw-mr-4">
                <button
                    onclick="onModalButtonClick()"
                    data-open-modal="coach-trailer-modal"
                    class="tw-px-auto tw-btn-secondary tw-static tw-mb-4 tw-box-border tw-transition hover:tw-bg-white hover:tw-bg-opacity-10"
                    style="width: 200px"
                >
                    <span>
                        <i aria-hidden="true" class="fa fa-play tw-px-1"></i>
                        <span>Play Trailer</span></span
                    >
                </button>
            </div>
        </template>
    </HeaderTemplate>
</template>
