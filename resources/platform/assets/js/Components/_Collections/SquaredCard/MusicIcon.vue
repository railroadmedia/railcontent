<script setup>
const props = defineProps({
    level: {
        type: String,
    },
	class: {
		type: String,
		default: ''
	}
})
</script>

<template>
	<svg :class="class" v-if="level === 'new'" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
		<rect y="20" width="5" height="10" rx="1" fill="#627F97"/>
		<rect x="8.33331" y="13.3333" width="5" height="16.6667" rx="1" fill="#627F97"/>
		<rect x="16.6667" y="6.66667" width="5" height="23.3333" rx="1" fill="#627F97"/>
		<rect x="25" width="5" height="30" rx="1" fill="#627F97"/>
	</svg>
	<svg :class="class" v-if="level === 'beginner'" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
		<rect y="20" width="5" height="10" rx="1" fill="#0B76DB"/>
		<rect x="8.33334" y="13.3333" width="5" height="16.6667" rx="1" fill="#627F97"/>
		<rect x="16.6667" y="6.66667" width="5" height="23.3333" rx="1" fill="#627F97"/>
		<rect x="25" width="5" height="30" rx="1" fill="#627F97"/>
	</svg>
	<svg :class="class" v-if="level === 'intermediate'" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
		<rect y="20" width="5" height="10" rx="1" fill="#EAB308"/>
		<rect x="8.33334" y="13.3333" width="5" height="16.6667" rx="1" fill="#EAB308"/>
		<rect x="16.6667" y="6.66667" width="5" height="23.3333" rx="1" fill="#627F97"/>
		<rect x="25" width="5" height="30" rx="1" fill="#627F97"/>
	</svg>
	<svg :class="class" v-if="level === 'advanced'" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
		<rect y="20" width="5" height="10" rx="1" fill="#F06314"/>
		<rect x="8.33333" y="13.3333" width="5" height="16.6667" rx="1" fill="#F06314"/>
		<rect x="16.6667" y="6.66667" width="5" height="23.3333" rx="1" fill="#F06314"/>
		<rect x="25" width="5" height="30" rx="1" fill="#627F97"/>
	</svg>
	<svg :class="class" v-if="level === 'expert'" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
		<rect y="20" width="5" height="10" rx="1" fill="#B91C1C"/>
		<rect x="8.33333" y="13.3333" width="5" height="16.6667" rx="1" fill="#B91C1C"/>
		<rect x="16.6667" y="6.66667" width="5" height="23.3333" rx="1" fill="#B91C1C"/>
		<rect x="25" width="5" height="30" rx="1" fill="#B91C1C"/>
	</svg>
</template>
