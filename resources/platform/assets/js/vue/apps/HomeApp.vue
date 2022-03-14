<script>
  import PageContainer from '../components/PageContainer/PageContainer.vue';
  export default {
    components: {
        PageContainer,
    }
  }
</script>
<template>
    <div>
        <PageContainer>
            <router-view></router-view>
        </PageContainer>
    </div>
</template>
