<script setup>
    import { onBeforeMount } from 'vue';

    //Props
    const props = defineProps({
        playlists: {
            type: Array,
            default: []
        },
    })
    //Reactive Data


    onBeforeMount(() => {
        fetch('/railcontent/playlists')
            .then((res) => res.json() )
            .then((json) => console.log(json.data) )
    })
</script>
<template>
    <section>
        <!-- Controls -->
        <div class="tw-flex tw-my-4">
            <!--Filters -->

            <!-- Search -->
            <div class="">
                <input type="search" class="" placeholder="Search">
            </div>

            <!-- List/Grid Toggle -->
            <div>
                <button>
                    <p class="tw-flex"></p>
                </button>
                <button>

                </button>
            </div>
        </div>

        <!-- Cards -->
        <div class="tw-grid ">
            <!-- Print Each Card -->
            
        </div>
    </section>
</template>