<script>
export default {
  name: 'SidebarContainer',
  props: ['brand', 'isSidebarCollapsed']
}
</script>

<template>
  <aside
    id="sidebar"
    class="tw-h-[calc(100vh-58px)]"
    :class="{isSidebarCollapsed:'sidebar-collapsed'}"
  >
    <div class="sidebar-wrapper tw-bg-[#F9FBFB] tw-transition dark:tw-bg-[#081825]">
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
