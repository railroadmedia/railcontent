<script setup>
import Button from "../Button/Button.vue";
const emit = defineEmits(["onClose", "onOpenOnboarding"]);
</script>

<template>
  <div
    class="
      tw-flex
      tw-bg-[#002039B2]/70
      tw-border-[0.5px]
      tw-border-[#344858]
      tw-space-between
    "
  >
    <div>You haven’t set up your account for this instrument.</div>
    <Button @onButtonClick="() => emit('onOpenOnboarding')"
      >COMPLETE YOUR ACCOUNT
    </Button>
  </div>
</template>