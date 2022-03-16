<template>
  <main>
    
    <page-container v-if="vueRouter">
      <router-view ></router-view>
    </page-container>
    
    <slot v-if="!vueRouter" />
  </main>
</template>
<script>
  export default {
    props: {
      vueRouter: Boolean,
    },
    setup(props) {
      console.log(`Has Vue Router: ${props.vueRouter}`)
    }
  }
</script>
