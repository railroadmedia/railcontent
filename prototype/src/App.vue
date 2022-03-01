<script>
import PageContainer from '@/components/PageContainer/PageContainer.vue'
import Onboarding from '@/components/Onboarding/Onboarding.vue'
export default {
    name: 'App',
    components: { PageContainer, Onboarding }
}
</script>

<template>
    <div>
        <PageContainer><Onboarding /></PageContainer>
    </div>
</template>
