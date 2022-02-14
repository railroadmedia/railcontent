<script>
import { ref } from 'vue'
import Navbar from '@/components/Navbar/Navbar.vue'
import Sidebar from '@/components/Sidebar/Sidebar.vue'
export default {
  name: 'PageContainer',
  components: { Navbar, Sidebar },
  setup(props, context) {
    const isSidebarCollapsed = ref(false)
    const isDarkModeSelected = ref(true)
    const brand = ref('drumeo')

    const onCollapseSidebar = (val) => {
      console.log(val)
      if (typeof val === 'boolean') {
        isSidebarCollapsed.value = val
      } else {
        isSidebarCollapsed.value = !isSidebarCollapsed.value
      }
    }

    const onColorModeToggle = (val) => {
      if (typeof val === 'boolean') {
        isDarkModeSelected.value = val
      } else {
        isDarkModeSelected.value = !isDarkModeSelected.value
      }
    }

    const onBrandSelect = (val) => {
      if (typeof val === 'string') {
        brand.value = val
      }
    }

    return {
      isSidebarCollapsed,
      isDarkModeSelected,
      brand,
      onCollapseSidebar,
      onColorModeToggle,
      onBrandSelect
    }
  }
}
</script>

<template>
  <main :class="isDarkModeSelected ? 'tw-dark' : 'tw-block'">
    <Navbar
      :brand="brand"
      @onBrandSelect="onBrandSelect"
      @onCollapseSidebar="onCollapseSidebar"
      @onColorModeToggle="onColorModeToggle"
    />
    <div
      class="tw-flex tw-flex-row"
      :style="{
        height: 'calc(100vh - 58px)'
      }"
    >
      <Sidebar :brand="brand" :isSidebarCollapsed="isSidebarCollapsed" />
      <div
        class="content-container tw-flex tw-grow tw-flex-col"
        :style="{
          minHeight: 'calc(100vh - 58px)'
        }"
      >
        <div class="main-content tw-h-full tw-w-full">
          <slot />
        </div>
        <div
          class="tw-w-full tw-self-end tw-bg-black tw-text-center tw-text-white"
        >
          FOOTER TEXT
        </div>
      </div>
    </div>
  </main>
</template>
