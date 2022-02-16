<script>
import PageContainer from '@/components/PageContainer/PageContainer.vue'
import HeaderTemplate from './components/CoachHeader/HeaderTemplate.vue'
export default {
    name: 'App',
    components: { PageContainer, HeaderTemplate }
}
</script>

<template>
    <div>
        <PageContainer
            ><HeaderTemplate
                brand="drumeo"
                backgroundImage="https://musora.imgix.net/https%3A%2F%2Fd1923uyy6spedc.cloudfront.net%2Fgreyson-playing-1643737463.jpg?auto=format&crop=faces%2Cedges&fit=crop&ixlib=php-1.2.1&s=0e22ebce257b6a48adda52d3ba4027bd"
                topSubtitle="TOP SUBTITLE"
                bottomSubtitle="BOTTOM SUBTITLE"
                shortBio="shortbio"
            >
                <template #actionSlot> Action Slot </template></HeaderTemplate
            >
        </PageContainer>
    </div>
</template>
