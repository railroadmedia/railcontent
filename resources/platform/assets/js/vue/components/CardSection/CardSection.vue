<script>
export default {
    data() {
        return {
            cardData: [],
        }
    },
    props: {
        id: {
            type: String,
            default: 'text-input'
        },
        brand: {
            type: String,
            default: 'drumeo'
        },
        type: {
            type: String,
            default: 'video'
        },
        title: {
            type: String,
            default: 'Section'
        },
        data: {
            type: Array,
            default: [],
        },
        isVisible: {
            type: Boolean,
            default: false
        }
    },
    watch: {
        // whenever brand changes, this function will run
        brand(newBrand, oldBrand) {
            this.getCardData(newBrand);
        }
    },
    methods: {
        getCardData: function(brand) {
            const baseURI = `https://dev.musora.com/railcontent/content?brand=drumeo&limit=20&statuses[]=publishe[…]es[]=coach-stream&page=1&required_fields[]=show_in_new_feed,1`;
            this.axios
                .get(baseURI, {
                    mode: 'no-cors',
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                        'Content-Type': 'application/json',
                    },
                    withCredentials: true,
                    credentials: 'same-origin',
                })
                .then((response) => {
                    this.cardData = response.data;
                })
        },
    },
    beforeMount() {
        //Get Initial Card Data
        this.getCardData(this.brand);
    }             
}
</script>

<template>
    <section v-if="this.cardData.length > 0" class="tw-my-8 tw-text-[#00101D] dark:tw-text-white">

        <!-- Section Title -->
        <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
            <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">{{ title }}</h2>
            <a href="https://www.drumeo.com/laravel/public/members/profile" 
                aria-label="See My Dashboard" 
                class="tw-p-3 tw-pb-2 tw-rounded-full tw-tracking-wide tw-text-base tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white  dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
            >
                See All
            </a>
        </div> 
        
        <div class="tw-flex">

            <template v-if="type === 'video'">
                <i>Print Video Cards</i>
                <div v-for="(card, i) in cardData" :key="i" >Card</div>
            </template>

            <template v-if="type === 'coach'">
                <i>Print Coach Cards</i>
                <div v-for="(card, i) in cardData" :key="i" >Card</div>
            </template>

            <template v-if="type === 'forum'">
                <i>Print Forum Cards</i>
                <div v-for="(card, i) in cardData" :key="i" >Card</div>
            </template>

            <template v-if="type === 'playlist'">
                <i>Print Playlist Cards</i>
                <div v-for="(card, i) in cardData" :key="i" >Card</div>
            </template>
            
        </div>
  
    </section>
</template>