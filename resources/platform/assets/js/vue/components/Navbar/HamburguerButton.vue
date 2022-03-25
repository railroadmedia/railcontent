<script>
export default {
  name: 'HamburguerButton',
  props: {
    onclick: String,
    isSidebarHidden: Boolean,
    isSidebarCollapsed: Boolean,
  },
  emits: ['onclick']
}
</script>

<template>
  <button class="tw-btn-primary tw-btn-small tw-btn-circle tw-bg-transparent hover:tw-bg-[#3f3f46]/10 dark:hover:tw-bg-[#445F74]/20 tw-p-0 tw-mb-0 tw-mr-3" v-on:click="$emit('onclick')">
    <span class="tw-sr-only">Open main menu</span>
    <div class="tw-block tw-w-5 tw-absolute tw-left-1/2 tw-top-1/2 tw-transform tw--translate-x-1/2 tw--translate-y-1/2">
        <span aria-hidden="true" 
              class="tw-block tw-absolute tw-h-0.5 tw-w-5 tw-bg-current tw-transform tw-transition tw-duration-300 ease-in-out" 
              :class="[ !isSidebarHidden && !isSidebarCollapsed ? 'tw-rotate-45 md:tw-rotate-0 md:tw--translate-y-1.5' : 'tw--translate-y-1.5' ]">
        </span>
        <span aria-hidden="true" 
              class="tw-block tw-absolute tw-h-0.5 tw-w-5 tw-bg-current tw-transform tw-transition tw-duration-300 ease-in-out" 
              :class="[ !isSidebarHidden && !isSidebarCollapsed ? 'tw-opacity-0 md:tw-opacity-100' : '' ]">
        </span>
        <span aria-hidden="true" 
              class="tw-block tw-absolute tw-h-0.5 tw-w-5 tw-bg-current tw-transform tw-transition tw-duration-300 ease-in-out" 
              :class="[ !isSidebarHidden && !isSidebarCollapsed ? 'tw--rotate-45 md:tw-rotate-0 md:tw-translate-y-1.5' : 'tw-translate-y-1.5' ]">
        </span>
    </div>
  </button>
</template>
