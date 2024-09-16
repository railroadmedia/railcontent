import { computed, ref } from "vue";
import axios from "axios";

export default function useCarouselEvents (originalData, slicedData, page, cardNum){
    const original = ref(originalData || []);

    const showPagination = computed(() => {
        return original.value.length > cardNum.value && window.innerWidth > 1024;
    });

    const isFirstPage = computed(() => page.value === 1);
    const isLastPage = computed(() => {
        const totalPages = Math.ceil(original.value.length / cardNum.value);
        return page.value === totalPages;
    });

    const setOriginal = (data) => {
        original.value = data;
        getPageData();
    }

    const getPageData = () => {
        if(original.value && Array.isArray(original.value) && original.value.length > 0){
            slicedData.value = original.value.slice(cardNum.value * (page.value - 1), cardNum.value * page.value);
            if(slicedData.value.length === 0){
                page.value -= 1;
                slicedData.value = original.value.slice(cardNum.value * (page.value - 1), cardNum.value * page.value);
            }
        }
    }

    const nextPage = () => {
        page.value++;
        getPageData();
    }

    const prevPage = () => {
        page.value--;
        getPageData();
    }

    const resetProgress = (contentId) => {
        window.showconfirmationmodal({
            title: 'Hold your horses… This will reset your progress, are you sure about this?',
            callbacks: {
                submit: () => {
                    original.value = original.value.filter((item) => item.id !== contentId);
                    getPageData();

                    axios.put(`/railcontent/reset`, {
                        content_id: contentId,
                    })
                },
            }
        });
    }

    return {
        showPagination,
        isFirstPage,
        isLastPage,
        setOriginal,
        getPageData,
        nextPage,
        prevPage,
        resetProgress,
    }
}
