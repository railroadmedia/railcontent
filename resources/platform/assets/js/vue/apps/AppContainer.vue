<template>
  <page-container v-if="vueRouter">
    <!-- <router-view ></router-view> -->
  </page-container>
  <!-- SSR -->
  <slot v-if="!vueRouter" :brand="brand" />
</template>
<script setup>
import { watch, provide, onBeforeMount } from 'vue';
import { useUserStore } from '../../stores/user';

const props = defineProps({
  vueRouter: {
    type: Boolean,
    default: true,
  },
  user: {
    type: Object
  },
  brand: {
    type: String,
    default: 'drumeo'
  },
  csrf_token: {
    type: String
  }
});

onBeforeMount(() => {
  provide('csrf_token', props.csrf_token);
});
const userStore = useUserStore();

watch(
  () => props.user,
  (user) => {
    userStore.setUser(user);
  },
  { immediate: true }
);
watch(
  () => props.brand,
  (brand) => {
    userStore.setCurrentBrand(brand);
  },
  { immediate: true }
);
</script>