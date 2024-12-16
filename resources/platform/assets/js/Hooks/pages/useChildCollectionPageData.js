import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import { fetchGenreLessons, fetchArtistLessons } from 'musora-content-services';

export const getCollectionType = () => {
    const pathname = window.location.pathname;
    if(pathname.includes('genres')){
        return 'genre';
    } else if(pathname.includes('artists')){
        return 'artist'
    }
}

export const useChildCollectionPageData = async (collectionType = '', queryType = '', { page, limit, sort, searchTerm }) => {
    const userStore = useUserStore();
    const { brand } = storeToRefs(userStore);

    const type = getCollectionType();

    if(type === 'genre'){
        const data = await fetchGenreLessons(brand.value, collectionType, queryType, { page, limit, sort, searchTerm });

        return {
            entity: data.entity[0].lessons,
            total: data.entity[0].lessons_count,
            data: data.entity[0]
        };
    } else if(type === 'artist'){
        const data = await fetchArtistLessons(brand.value, collectionType, queryType, { page, limit, sort, searchTerm });

        return {
            entity: data.entity[0].lessons,
            total: data.entity[0].lessons_count,
            data: data.entity[0]
        };
    }
}
