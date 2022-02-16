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
                backgroundImage=""
                topSubtitle="TOP SUBTITLE"
                bottomSubtitle="BOTTOM SUBTITLE"
                shortBio="shortbio"
            >
                <template #actionSlot> Action Slot </template></HeaderTemplate
            >
        </PageContainer>
    </div>
</template>
