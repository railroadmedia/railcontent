<template>
  <div
    class="tw-grid tw-gap-3 tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 xl:tw-grid-cols-5 2xl:tw-grid-cols-7 3xl:tw-grid-cols-8 tw-mb-4"
  >
    <!-- Loop through Cards -->
    <coach-card
      v-for="(item, i) in content"
      :key="i"
      :item="item"
      :brand="brand"
      :content-type="item.type"
      @onShowNotification="onShowNotificationMessage"
    />
  </div>
</template>
<script>
import CoachCard from "./_CoachCard.vue";
import UserCatalogueEvents from "../../mixins/UserCatalogueEvents";

export default {
  name: "CoachesGridCatalogue",
  components: {
    "coach-card": CoachCard,
  },
  mixins: [UserCatalogueEvents],
  data() {
    return {
      toast: {
        icon: "",
        text: "",
        showErrorMessage: false,
      },
    };
  },
  methods: {
    onShowNotificationMessage({ icon, text, error }) {
      if (error) {
        window.shownotification({
          isError: true
        })
      } else {
        window.shownotification({
          icon,
          text
        });
      }
    },
  },
  props: {
    content: {
      type: Array,
      default: () => [],
    },
    brand: {
      type: String,
      default: () => "drumeo",
    },
  },
};
</script>
