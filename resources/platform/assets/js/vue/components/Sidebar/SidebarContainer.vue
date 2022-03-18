<script>
export default {
  name: 'SidebarContainer',
  props: ['brand', 'isSidebarCollapsed']
}
</script>
<template>
  <aside
    id="sidebar"
    class="tw-h-[calc(100vh-58px)] tw-transition-all tw-relative"
    :class="[isSidebarCollapsed ? 'tw-w-[68px]' : 'tw-w-64']"
  >
    <div class="tw-absolute tw-h-full tw-w-full tw-top-0 tw-left-0 tw-z-[99] tw-overflow-y-auto tw-transition-color tw-bg-[#F9FBFB] dark:tw-bg-[#081825]">
      <div class="sidebar-mask">
        <div class="sidebar-offset tw-right-0 tw-bottom-0">

          <div class="sidebar-content-wrapper tw-h-full tw-overflow-hidden">
            <div class="sidebar-content">
              <div class="sidebar-header flex flex-row align-v-center">
                <div id="sidebar-close">
                  <i class="fal fa-times"></i>
                </div>
                <div class="sidebar-header-inner">
                  <img alt="" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png"/>
                </div>
              </div>

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
