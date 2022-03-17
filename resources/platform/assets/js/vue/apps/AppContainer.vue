<template>
    <page-container v-if="vueRouter">
      <router-view ></router-view>
    </page-container>
    <slot v-if="!vueRouter" />
</template>
<script>
  export default {
    props: {
      vueRouter: Boolean,
      brand: String
    },
    setup(props) {
      console.log(`Has Vue Router: ${props.vueRouter}`)
    }
  }
</script>
