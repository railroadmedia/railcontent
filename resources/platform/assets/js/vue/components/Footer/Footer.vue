<script>
export default {
  name: 'Footer',
}
</script>

<template>
  <footer data-component="Footer" class="tw-py-6 dark:tw-bg-[#081825]/90">
    <div class="tw-mx-auto tw-container tw-px-8 sm:tw-px-4 tw-flex">
      <!-- Logo -->
      <a href="/">
        <img src="https://musora-ui.s3.amazonaws.com/logos/musora-white.svg" alt="Musora Logo" class="tw-w-24"/>
      </a>
      <!-- Footer Links -->
      <div class="tw-flex tw-px-4 tw-text-xs tw-text-blue-100 tw-justify-center tw-w-full tw-items-center">
        <span class="tw-mr-1">Musora Media Inc 2021</span>
        <ul class="tw-flex tw-items-center tw-text-xs">
          <li class="tw-mx-1"><a href="/" class="tw-text-xs hover:tw-underline">Terms</a></li>/
          <li class="tw-mx-1"><a href="/" class="tw-text-xs hover:tw-underline">Privacy</a></li>/
          <li class="tw-mx-1"><a href="/" class="tw-text-xs hover:tw-underline">Legacy Resources</a></li>/
          <li class="tw-mx-1"><a href="/" class="tw-text-xs hover:tw-underline">Support</a></li>/
          <li class="tw-mx-1"><a href="/" class="tw-text-xs hover:tw-underline">Logout</a></li>
        </ul>
      </div>
    </div>
  </footer>
</template>
