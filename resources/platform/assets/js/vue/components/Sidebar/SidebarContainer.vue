<script>

export default {
  name: 'SidebarContainer',
  props: ['brand', 'isSidebarCollapsed', 'isSidebarHidden'],
}
</script>
<template>
  <aside
    id="sidebar"
    class="tw-h-[calc(100vh-58px)] tw-mt-[58px] tw-transition-all tw-shrink-0 tw-absolute md:tw-relative tw-z-[99] tw-w-64 md:tw-left-0 tw-shadow-[0_0_5px_rgb(0,0,0,.13)]"
    style="clip-path: inset(0 -200px 0 0);"
    :class="[
      isSidebarCollapsed && !isSidebarHidden ? 'md:tw-w-[68px] ' : '',
      isSidebarHidden ? 'tw--left-64 ' : 'tw-left-0',
    ]"
  >
    <div class="tw-h-full tw-w-full tw-top-0 tw-left-0 tw-transition-color tw-bg-[#F9FBFB] dark:tw-bg-[#081825]">
        <div class="tw-flex tw-flex-col tw-right-0 tw-bottom-0 tw-h-full tw-no-scrollbar tw-pb-10" data-simplebar>

          <slot />

        </div>
      </div>
  </aside>
</template>

<style type="text/css">
@import './sidebar.css';
</style>
