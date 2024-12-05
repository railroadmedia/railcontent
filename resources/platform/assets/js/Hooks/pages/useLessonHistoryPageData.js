import { ref } from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "@stores/user";
import { getAllStarted, getAllCompleted, fetchAll } from 'musora-content-services';

const completedIds = ref([]);
const inProgressIds = ref([]);
const data = ref(null)

export async function useLessonHistoryPageData(key, { page, limit, sort, searchTerm }) {
    const userStore = useUserStore();
    const { brand } = storeToRefs(userStore);

    if(key === 'inProgress') {
        //Get inProgress Ids from MCS
        getAllStarted().then( ids => {
            inProgressIds.value = ids;
        }).catch( error => {
            console.log(error)
        })
        //Take those Ids and get Lesson Data
        const startedLessonsData = await fetchAll(brand.value, '', {
            page,
            limit,
            sort,
            searchTerm,
            includedFields: [`railcontent_id in [${inProgressIds.value.join(',')}]`],
        });
        
        data.value = startedLessonsData;
    } else {
        //Get inProgress Ids from MCS
        getAllCompleted().then( ids => {
            completedIds.value = ids;
        }).catch( error => {
            console.log(error)
        })
        //Take those Ids and get Lesson Data
        const completedLessonsData = await fetchAll(brand.value, '', {
            page,
            limit,
            sort,
            searchTerm,
            includedFields: [`railcontent_id in [${completedIds.value.join(',')}]`],
        });
        
        data.value = completedLessonsData;
    }
    
    console.log('data', data.value)
    return data.value;
}
