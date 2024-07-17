<template>
  <page-container v-if="vueRouter">
    <!-- <router-view ></router-view> -->
  </page-container>
  <!-- SSR -->
  <slot v-if="!vueRouter" :brand="brand" />
</template>
<script setup>
import { watch, provide, onBeforeMount } from 'vue';
import { useUserStore } from '../../Stores/user';
import { toKebabCase } from '../../utils.js'; 

const props = defineProps({
  user: Object,
  isAdmin: Boolean,
  csrf_token: String,
  vueRouter: {
    type: Boolean,
    default: true,
  },
  brand: {
    type: String,
    default: 'drumeo'
  },
  journeySection: {
    type: String,
    default: ''
  },
  userCompletedAccount: {
    type: Boolean,
    default: false,
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
watch(
  () => props.journeySection,
  (journeySection) => {
    const formattedJourneySection = () => {
      const sectionLowercased = journeySection.toLowerCase();
      if(sectionLowercased === 'podcast' || sectionLowercased === 'the-pianote-podcast') {
        return 'podcasts';
      } else {
        return toKebabCase(journeySection);
      }
    };
    userStore.setJourneySection(formattedJourneySection());
  },
  { immediate: true }
);
watch(
  () => props.csrf_token,
  (token) => {
    userStore.setToken(token);
  },
  { immediate: true }
);
watch(
  () => props.userCompletedAccount,
  (userCompletedAccount) => {
    userStore.setCompletedAccount(userCompletedAccount)
  },
  { immediate: true }
)
</script>