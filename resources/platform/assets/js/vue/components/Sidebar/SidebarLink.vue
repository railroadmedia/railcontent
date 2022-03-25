<script>
import { textColor, borderColor } from '../../../constants/brands.js'

export default {
  name: 'SidebarLink',
  setup() {
    return {
      textColor,
      borderColor
    }
  },
  props: [
    'brand',
    'href',
    'onClick',
    'icon',
    'title',
    'isActive',
    'showCollapsed'
  ],
  emits: ['onClick']
}
</script>

<template>
  <div
    :class="`sidebar-link-container ${showCollapsed ? 'show-collapsed' : ''}`"
  >
    <a
      v-on:click="
        onClick ? $emit('onClick') : () => (window.location.href = href)
      "
      :class="`sidebar-link pl-3 no-decoration tw-border-box tw-relative tw-border-l-[4px] ${
        isActive
          ? `${textColor[brand]} ${borderColor[brand]}`
          : 'tw-border-transparent'
      }`"
    >
      <div
        :class="`sidebar-link-icon tw-inline-flex ${
          isActive ? textColor[brand] : 'tw-text-black dark:tw-text-gray-100'
        }`"
      >
        <slot />
      </div>
      <span
        :class="`sidebar-link-title ${
          isActive ? textColor[brand] : 'tw-text-black dark:tw-text-gray-100'
        }`"
      >
        {{ title }}
      </span>
    </a>
  </div>
</template>
