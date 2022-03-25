<script setup>
import { defineProps } from 'vue'
const props = defineProps({
    coach: {
        type: Object,
        default: {}
    }
})
</script>

<template>
  <a
    href="https://staging.drumeo.com/laravel/public/members/coaches/ash-pearson"
    class="
      tw-relative
      tw-flex
      tw-bg-cover
      tw-bg-top
      tw-bg-gray-200
      tw-overflow-hidden
      tw-rounded-lg
      lg:tw-rounded-xl
      tw-no-underline
      tw-text-white
      tw-h-[343px]
      tw-min-w-[232px]
    "
    ><img
      src="https://cdn.musora.com/image/fetch/c_fill,w_660,h_960,q_auto:good/https://d1923uyy6spedc.cloudfront.net/coaches-2022/drumeo/Ash-Pearson-HEAD.jpg"
      alt="Ash Pearson"
      class="tw-w-[232px]"
    />
    <div
      class="
        tw-flex
        tw-flex-col
        tw-mt-auto
        tw-items-center
        tw-justify-center
        tw-text-center
        tw-absolute
        tw-bottom-0
        tw-left-0
        tw-w-[232px]
      "
      style="
        background: linear-gradient(rgba(1, 5, 15, 0) 0%, rgb(1, 5, 15) 100%);
      "
    >
      <h3
        class="
          tw-uppercase
          tw-font-roboto-condensed
          tw-fluid-text-2xl-base
          tw-break-all
          tw-leading-tight
          md:tw-leading-none
          tw-mt-auto tw-mb-4 tw-text-center
        "
      >
        <span>Ash</span><br /><span>Pearson</span>
      </h3>
      <p
        class="
          tw-text-yellow-400
          tw-fluid-text-sm-xs
          tw-h-8
          tw-leading-snug
          tw-mb-8
          tw-uppercase
        "
      >
        Your Guide To Metal
      </p>
      <!---->
    </div>
    <div
      class="
        tw-absolute
        tw-flex
        tw-h-full
        tw-w-[232px]
        tw-top-0
        tw-left-0
        tw-bg-black
        tw-transition
        tw-bg-opacity-30
        tw-opacity-0
        hover:tw-opacity-100
      "
    >
      <button
        class="
          tw-btn-primary
          tw-btn-small
          tw-h-6
          tw-w-6
          tw-p-0
          tw-ml-auto
          tw-mt-1
          tw-mr-1
          tw-bg-drumeo
        "
      >
        <i class="fas fa-bell tw-text-base"></i
        ><span class="tw-sr-only">Subscribe to Coach</span>
      </button>
    </div></a
  >
</template>