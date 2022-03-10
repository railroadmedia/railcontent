<script>
export default {
  name: 'SidebarContainer',
  props: ['brand', 'isSidebarCollapsed']
}
</script>

<template>
  <div
    id="sidebar"
    :class="isSidebarCollapsed ? `${brand} sidebar-collapsed` : brand"
  >
    <div
      class="sidebar-wrapper tw-bg-white tw-transition tw-duration-300 tw-ease-in-out dark:tw-bg-black"
      style="
         {
          margin: '0px';
        }
      "
    >
      <div class="sidebar-mask">
        <div class="sidebar-offset" style="{right: '0px', bottom: '0px'}">
          <div
            class="sidebar-content-wrapper"
            style="{height: '100%', overflow: 'hidden'}"
          >
            <div
              class="sidebar-content"
              style="
                 {
                  padding: '0px';
                }
              "
            >
              <div class="sidebar-header flex flex-row align-v-center">
                <div id="sidebar-close">
                  <i class="fal fa-times"></i>
                </div>
                <div class="sidebar-header-inner">
                  <img
                    alt=""
                    src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png"
                  />
                </div>
              </div>
              <slot />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style type="text/css">
@import './sidebar.css';
</style>
