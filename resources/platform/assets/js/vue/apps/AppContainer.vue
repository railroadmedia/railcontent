<script setup>
  import PageContainer from '../components/PageContainer/PageContainer.vue';
  import { onMounted, ref } from 'vue'
  const withRouter = ref(false)

  onMounted(() => {
    const initialVueData = document.getElementById('app').getAttribute('initial-vue-data');
    const parsedData = JSON.parse(initialVueData)
    withRouter.value = !!parsedData.withRouter;
  })

</script>
<template>
  <PageContainer>
    <router-view v-if="withRouter"></router-view>
    <slot />
  </PageContainer>
</template>
