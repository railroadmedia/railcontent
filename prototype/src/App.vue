<script>
import PageContainer from '@/components/PageContainer/PageContainer.vue'
import CoachHeader from './components/CoachHeader/CoachHeader.vue'
import CoachOfTheMonthHeader from './components/CoachHeader/CoachOfTheMonthHeader.vue'
export default {
    name: 'App',
    components: { PageContainer, CoachHeader, CoachOfTheMonthHeader }
}
</script>

<template>
    <div>
        <PageContainer>
            <CoachHeader
                backgroundImage="https://musora.imgix.net/https%3A%2F%2Fd1923uyy6spedc.cloudfront.net%2Fgreyson-playing-1643737463.jpg?auto=format&crop=faces%2Cedges&fit=crop&ixlib=php-1.2.1&s=0e22ebce257b6a48adda52d3ba4027bd"
                shortBio="Big Band is where it all started. You’ll learn the fundamentals of drumming’s most celebrated style from a modern-day prodigy."
                coachName="GREYSON NEKRUTMAN"
                coachFocus="BIG BAND DRUMMING ESSENTIALS"
                brand="drumeo"
            />
            <CoachOfTheMonthHeader
                backgroundImage="https://musora.imgix.net/https%3A%2F%2Fd1923uyy6spedc.cloudfront.net%2Fgreyson-playing-1643737463.jpg?auto=format&crop=faces%2Cedges&fit=crop&ixlib=php-1.2.1&s=0e22ebce257b6a48adda52d3ba4027bd"
                shortBio="Big Band is where it all started. You’ll learn the fundamentals of drumming’s most celebrated style from a modern-day prodigy."
                coachName="GREYSON NEKRUTMAN"
                brand="drumeo"
            />

            <div class="tw-h-[2000px]"></div>
        </PageContainer>
    </div>
</template>
