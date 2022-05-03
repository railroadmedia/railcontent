<script setup>
import { ref } from "vue";
const props = defineProps({
  coach: {
    type: Object,
    default: {
      id: "test",
      name: "Aaron Pearson",
      tagline: "YOUR GUIDE TO METAL",
    },
    key: {
      type: Number,
    },
  },
});

const isCoachFollowed = ref(false);

const followEndpoint = (id) => {
  console.log("followed", id);
  return Promise.resolve();
};

const unfollowEndpoint = (id) => {
  console.log("unfollowed", id);
  return Promise.resolve();
};

function onFollow(e) {
  e.preventDefault();
  if (isCoachFollowed.value) {
    unfollowEndpoint(props.coach.id).then(() => {
      console.log('then unfollow')
      isCoachFollowed.value = false;
    });
  } else {
    followEndpoint(props.coach.id).then(() => {
      console.log('then follow')
      isCoachFollowed.value = true;
    });
  }
}
</script>

<template>
  <div
    @click="onFollow"
    :class="
      `tw-relative
      tw-flex
      tw-bg-cover
      tw-bg-top
      tw-bg-gray-200
      tw-overflow-hidden
      tw-rounded-lg
      lg:tw-rounded-xl
      tw-no-underline tw-text-white tw-h-[343px] tw-min-w-[232px]
      single-coach
      ${isCoachFollowed ? 'single-coach--followed' : ''}
      `"
  >
    <img
      src="https://cdn.musora.com/image/fetch/c_fill,w_660,h_960,q_auto:good/https://d1923uyy6spedc.cloudfront.net/coaches-2022/drumeo/Ash-Pearson-HEAD.jpg"
      alt="Ash Pearson"
      class="tw-w-[232px]"
    />
    <div
      :class="`tw-absolute
        tw-right-[7px]
        tw-top-[10px]
        tw-btn-primary
        tw-btn-small
        tw-h-6
        tw-w-6
        tw-p-0
        tw-flex
        tw-items-center
        tw-justify-center
        tw-z-[200]
        single-coach__bell
        ${
          isCoachFollowed ? 'tw-bg-yellow-400 tw-opacity-100' : 'tw-bg-[#00101d] tw-opacity-40'
        }
        `"
    >
      <i class="fas fa-bell tw-text-base"></i
      ><span class="tw-sr-only">Subscribe to Coach</span>
    </div>
    <div
      class="
        tw-absolute
        tw-flex
        tw-h-[189px]
        tw-w-[232px]
        tw-bottom-0
        tw-left-0
        tw-transition
        single-coach__gradient
      "
    />
    <div
      :class="`
        tw-flex
        tw-flex-col
        tw-mt-auto
        tw-items-center
        tw-justify-center
        tw-text-center
        tw-absolute
        tw-h-full
        tw-border-2
        tw-border-transparent
        tw-rounded-lg
        lg:tw-rounded-xl
        hover:tw-border-yellow-400
        tw-box-border tw-w-[232px]
        ${isCoachFollowed ? 'tw-border-yellow-400' : ''}
        `
      "
    >
      <h3
        class="
          tw-uppercase
          tw-font-bebas-neue
          tw-fluid-text-2xl-base
          tw-break-all
          tw-leading-tight
          md:tw-leading-none
          tw-mt-auto
          tw-mb-4
          tw-text-center
          tw-text-[44px]
          tw-font-normal
          tw-text-white
        "
      >
        <span>Ash</span><br /><span>Pearson</span>
      </h3>
      <p
        class="
          tw-text-yellow-400
          tw-font-open-sans
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
  </div>
</template>

<style scoped>
.single-coach__gradient {
  background: linear-gradient(180deg, rgba(1, 5, 15, 0) 0%, #01050f 100%);
}

.single-coach:hover .single-coach__gradient, .single-coach--followed .single-coach__gradient {
  background: linear-gradient(
      182.08deg,
      rgba(1, 5, 15, 0) 1.7%,
      rgba(250, 163, 0, 0.58) 98.25%
    ),
    linear-gradient(180deg, rgba(1, 5, 15, 0) 0%, #01050f 100%);
}

.one-word-per-line {
  word-spacing: 232px;
}

.single-coach:hover .single-coach__bell {
  opacity: 1;
}

.single-coach:hover {
  cursor: pointer;
}
</style>