<script>
import SidebarContainer from './SidebarContainer.vue'
import SidebarSection from './SidebarSection.vue'
import SidebarLink from './SidebarLink.vue'

export default {
  name: 'Sidebar',
  components: { SidebarContainer, SidebarSection, SidebarLink },
  props: ['brand', 'isSidebarCollapsed']
}
</script>

<template>
  <SidebarContainer :isSidebarCollapsed="isSidebarCollapsed" :brand="brand">
    <SidebarSection>
      <SidebarLink
        :brand="brand"
        title="Home"
        href="#"
        :isActive="true"
        showCollapsed
        ><i class="fas fa-home" />
      </SidebarLink>
      <SidebarLink :brand="brand" title="Packs" :showCollapsed="true"
        ><i class="fas fa-home" />
      </SidebarLink>
      <SidebarLink :brand="brand" title="Forums" :showCollapsed="true"
        ><i class="fas fa-comments" />
      </SidebarLink>
      <SidebarLink :brand="brand" title="Notifications" :showCollapsed="true"
        ><i class="fas fa-bell" />
      </SidebarLink>
      <SidebarLink :brand="brand" title="My List" :showCollapsed="true"
        ><i class="fas fa-envelope" />
      </SidebarLink>
    </SidebarSection>
    <SidebarSection>
      <SidebarLink :brand="brand" title="Option" :showCollapsed="true"
        ><i class="fas fa-envelope" />
      </SidebarLink>
      <SidebarLink :brand="brand" title="Coaches" :showCollapsed="true"
        ><i class="fas fa-whistle" />
      </SidebarLink>
      <SidebarLink :brand="brand" title="Songs" :showCollapsed="true"
        ><i class="fas fa-envelope" />
      </SidebarLink>
      <SidebarLink :brand="brand" title="Courses" :showCollapsed="true"
        ><i class="fas fa-envelope" />
      </SidebarLink>
      <SidebarLink :brand="brand" title="Quick Tips"
        ><i class="fas fa-envelope" />
      </SidebarLink>
      <SidebarLink :brand="brand" title="Shows"
        ><i class="fas fa-envelope" />
      </SidebarLink>
    </SidebarSection>
    <SidebarSection>
      <SidebarLink :brand="brand" title="Settings" :showCollapsed="true"
        ><i class="fas fa-cog" />
      </SidebarLink>
      <SidebarLink :brand="brand" title="Store" :showCollapsed="true"
        ><i class="fas fa-shopping-cart" />
      </SidebarLink>
    </SidebarSection>
  </SidebarContainer>
</template>
