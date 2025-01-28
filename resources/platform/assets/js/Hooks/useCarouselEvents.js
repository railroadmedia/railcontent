import { computed, ref } from "vue"
import { contentStatusReset } from "musora-content-services";
import { useUserStore } from "@stores/user";

export default function useCarouselEvents (originalData, updatedData, page, cardNum, sectionTitle, autoScroll = false, isMiniView = false) {
    const userStore = useUserStore();

    const original = ref([]);
    const isScrolling = ref(false);
    const startIndex = ref(0); // Index of the first visible item
    const scrollInterval = ref(null);

    const showPagination = computed(() => {
        if(isMiniView){
            return updatedData.value.length > 1;
        }
        return initialData.value?.length > cardNum.value && window.innerWidth > 1024;
    });

    const isFirstPage = computed(() => page.value === 1);
    const isLastPage = computed(() => {
        if(isMiniView){
            return page.value === updatedData.value.length;
        }
        const totalPages = Math.ceil(updatedData.value.length / cardNum.value);
        const morePage = (updatedData.value.length - startIndex.value - 1) / cardNum.value;
        return page.value === totalPages && morePage <= 1;
    });

    const initialData = computed(() => {
        if(original.value.length > 0) {
            return original.value;
        }

        return originalData.value;
    })

    const reFetchData = async (data) => {
        original.value = data;
        updatedData.value = data;
    }

    const nextPage = () => {
        if(isScrolling.value) return;

        startIndex.value = startIndex.value + cardNum.value;

        page.value++;

        scrollHorizontally('left');

        if(autoScroll){
            clearAutoScroll();
            activateAutoScroll();
        }
    }

    const prevPage = () => {
        if(isScrolling.value) return;

        page.value--;

        startIndex.value = startIndex.value - cardNum.value;
        if(startIndex.value < 0){
            startIndex.value = 0;
        }

        if(page.value === 1){
            startIndex.value = 0;
        }

        scrollHorizontally('right');

        if(autoScroll){
            clearAutoScroll();
            activateAutoScroll();
        }
    }

    const removeItem = (contentId) => {
        if(isMiniView){
            const arr = [];

            updatedData.value.forEach((group) => {
                const filtered = group.filter((item) => item.id !== contentId);
                if(filtered.length > 0) arr.push(filtered);
            })

            if(page !== 1 && updatedData.value.length !== arr.length){
                page.value--;
            }

            updatedData.value = arr;
        } else {
            const index = updatedData.value.findIndex((item) => item.id === contentId);

            const filtered = updatedData.value.filter((item) => item.id !== contentId);
            original.value = filtered;
            updatedData.value = filtered;

            startIndex.value = index - 1;
            toStartIndex();
            console.log('page', index, page.value, updatedData.value)
        }
    }

    const resetPagination = () => {
        page.value = 1;
        startIndex.value = 0;
        toStartIndex();
    }

    const activateAutoScroll = () => {
        if(autoScroll){
            scrollInterval.value = setInterval(() => {
                if(isLastPage.value){
                    page.value = 1;
                    startIndex.value = 0;

                    const container = document.getElementsByClassName(`${sectionTitle.value}-container`)[0];
                    container.scrollTo({ left: 0, behavior: 'smooth' });
                    isScrolling.value = true;

                    setTimeout(() => {
                        isScrolling.value = false;
                    }, 600);
                } else {
                    nextPage();
                }
            }, 8000)
        }
    }

    const clearAutoScroll = () => {
        clearInterval(scrollInterval.value);
    }

    const handleScrollEnd = () => {
        const container = document.getElementsByClassName(`${sectionTitle.value}-container`)[0];
        let initialPosition = container.scrollLeft;

        const watchScroll = () => {
            const currentPosition = container.scrollLeft;

            if(currentPosition === initialPosition){
                if(container){
                    let card = container.getElementsByClassName('catalogue-card')[0];
                    if(window.innerWidth < 1280) card = container.getElementsByClassName('catalogue-card')[1];
                    const cardWidth = card.offsetWidth;
                    const firstCardIndex = Math.floor(currentPosition / cardWidth);
                    const visibleWidth = currentPosition % cardWidth;
                    const visiblePercentage = visibleWidth / cardWidth;

                    if(visiblePercentage < 0.6){
                        startIndex.value = firstCardIndex;
                    } else {
                        startIndex.value = firstCardIndex + 1;
                    }

                    toStartIndex();
                }
            } else {
                initialPosition = currentPosition;
                setTimeout(watchScroll, 100)
            }
        }

        setTimeout(watchScroll, 10);
    }

    const scrollHorizontally = (direction) => {
        const container = document.getElementsByClassName(`${sectionTitle.value}-container`)[0];
        const distance = direction === 'left' ? container.offsetWidth : -container.offsetWidth;
        container.scrollBy({ left: distance, behavior: "smooth" });
        isScrolling.value = true;

        setTimeout(() => {
            isScrolling.value = false;
        }, 600);
    }

    const reformatData = (data) => {
        const totalPage = Math.ceil(data.length / cardNum.value);
        const arr = [];

        for(let i = 1; i <= totalPage; i++){
            arr.push(data.slice(cardNum.value * (i - 1), cardNum.value * i));
        }

        return arr;
    }

    const toStartIndex = () => {
        if(!isMiniView && initialData.value){
            let short = (initialData.value.length / cardNum.value) > 1;
            if(short){
                short = cardNum.value - initialData.value.length % cardNum.value;
            } else {
                short = 0
            }

            if(short !== cardNum.value && window.innerWidth >= 1024){
                const itemsToAdd = Array.from({ length: short }, () => ({ type: 'fill' }));
                updatedData.value = [...initialData.value, ...itemsToAdd];

            } else if(initialData.value.length !== updatedData.value.length || initialData.value[0].title !== updatedData.value[0].title){
                updatedData.value = [...initialData.value];
            }

            console.log('udpate page:', startIndex.value, cardNum.value)
            page.value = Math.ceil(startIndex.value / cardNum.value) + 1;
        }

        const container = document.getElementsByClassName(`${sectionTitle.value}-container`)[0];
        if(container){
            let card = container.getElementsByClassName('catalogue-card')[0];
            if(window.innerWidth < 1280) card = container.getElementsByClassName('catalogue-card')[1];
            if(card){
                const cardWidth = card.offsetWidth;
                container.scrollLeft = startIndex.value * cardWidth;
            }
        }
    }

    const resetProgress = (contentId) => {
        window.showconfirmationmodal({
            title: 'Hold your horses… This will reset your progress, are you sure about this?',
            callbacks: {
                submit: () => {
                    removeItem(contentId);

                    //Reset Progress
                    contentStatusReset(contentId)
                    .then(() => {
                        window.shownotification({
                            icon: 'check',
                            text: 'Your progress has been reset.'
                        });
                    });

                },
            }
        });
    }

    return {
        showPagination,
        isFirstPage,
        isLastPage,
        nextPage,
        prevPage,
        resetProgress,
        resetPagination,
        removeItem,
        reFetchData,
        toStartIndex,
        activateAutoScroll,
        clearAutoScroll,
        handleScrollEnd,
        reformatData,
    }
}
