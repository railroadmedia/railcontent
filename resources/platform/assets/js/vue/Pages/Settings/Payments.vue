<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="[]"/>
        <PageHeader />


    </div>
</template>
<script setup>
    import { computed, onBeforeMount } from "vue";
    import { storeToRefs } from "pinia/dist/pinia";
    import { useUserStore } from "../../../stores/user";
    import Breadcrumb from '../../components/Breadcrumb/Breadcrumb';
    import PageHeader from '../../components/PageHeader/PageHeader';

    //Pinia
    const userStore = useUserStore();
    const { brand } = storeToRefs(userStore);   

    //Props
    const props = defineProps({

    })

    //Computed

    //Lifecycle Hooks
    onBeforeMount( ()=> {

    })
</script>