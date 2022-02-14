<script>
import HamburguerButton from './HamburguerButton.vue'
import BrandSelector from './BrandSelector.vue'
import UserIcon from './UserIcon.vue'
export default {
  name: 'Navbar',
  components: { HamburguerButton, BrandSelector, UserIcon },
  props: {
    brand: String
  },
  emits: ['onCollapseSidebar', 'onBrandSelect', 'onColorModeToggle']
}
</script>

<template>
  <div>
    <div class="tw-h-[58px]" />
    <div
      class="tw-z-100 tw-fixed tw-top-0 tw-flex tw-h-[58px] tw-w-full tw-justify-between tw-bg-white tw-px-[12px] dark:tw-bg-[#081825]/90"
    >
      <div class="tw-row tw-flex">
        <HamburguerButton @onclick="$emit('onCollapseSidebar')" />
        <BrandSelector
          @onBrandSelect="$emit('onBrandSelect', $event)"
          :brand="brand"
        />
      </div>
      <div class="tw-self-end">
        <UserIcon
          @onColorModeToggle="$emit('onColorModeToggle')"
          userName="John Doe"
          userPhoto="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png"
        />
      </div>
    </div>
  </div>
</template>
