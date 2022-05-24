<template>
    <page-container 
      v-if="vueRouter"
    >
      <!-- <router-view ></router-view> -->
    </page-container>
    <!-- SSR -->
    <slot v-if="!vueRouter" :brand="brand"/>
</template>
<script>
  export default {
    props: {
      vueRouter: {
        type: Boolean,
        default: true,
      },
      brand: String
    },
  }
</script>
