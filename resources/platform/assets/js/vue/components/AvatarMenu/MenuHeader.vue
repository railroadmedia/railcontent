<script>
const goToHref = (href) => {
  if (href) {
    window.location.href = href
  }
}

export default {
  name: 'MenuHeader',
  setup(props, context) {
    return {
      onButtonClick: context.attrs['onOptionClick']
        ? () => context.emit('optionClick')
        : () => goToHref(props.href)
    }
  },
  props: ['href', 'optionClick', 'userPhoto', 'name', 'accountUrl'],
  emits: ['onOptionClick']
}
</script>

<template>
  <div
    class="tw-flex tw-h-full tw-w-full tw-px-[16px] tw-pb-[12px] tw-leading-[18px] tw-text-[#00101D] dark:tw-text-white"
    v-on:click="onButtonClick"
  >
    <div v-on:click="onButtonClick" class="tw-relative tw-h-[53px] tw-w-[53px] tw-rounded-full tw-bg-cover"
      style="background-image: url(https://musora.imgix.net/https%3A%2F%2Fs3.amazonaws.com%2Fpianote%2Fdefaults%2Favatar.png?blur=2&fit=crop&h=50&ixlib=php-1.2.1&q=50&w=50&s=0a284a726ec34f3bca2bb253a0dfc869)">
        <img v-if="userPhoto.length" :src="userPhoto" class="tw-h-[53px] tw-w-[53px] tw-rounded-full"/>
    </div>
      
    <div class="tw-flex tw-grow tw-flex-col tw-justify-center tw-pl-[10px]">
      <div class="tw-text-[14px] tw-font-bold tw-mb-1">{{ name }}</div>
      <a :href="[ accountUrl.length ? accountUrl : '/profile']" 
         class="tw-text-[12px] tw-text-[#00101D] dark:tw-text-white hover:tw-underline"
      >
        View Profile
      </a>
    </div>
  </div>
</template>
