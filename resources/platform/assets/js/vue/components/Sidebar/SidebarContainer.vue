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
    style="clip-path: inset(0 -20px 0 0);"
    :class="[
      isSidebarCollapsed && !isSidebarHidden ? 'md:tw-w-[68px] ' : '',
      isSidebarHidden ? 'tw--left-64 ' : 'tw-left-0',
    ]"
  >
    <div class="tw-h-full tw-w-full tw-top-0 tw-left-0 tw-transition-color tw-bg-[#F9FBFB] dark:tw-bg-[#081825]">
      <div class="sidebar-mask">
        <div class="sidebar-offset tw-right-0 tw-bottom-0">

          <div class="tw-no-scrollbar tw-overflow-y-scroll sidebar-content-wrapper tw-h-full  tw-pb-4">
            <div class="sidebar-content">

              <slot />

            </div>
          </div>
        </div>
      </div>
    </div>
  </aside>
</template>

<style type="text/css">
@import './sidebar.css';
</style>
