import { ref } from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "@stores/user";
import { fetchContentInProgress, fetchCompletedContent, fetchByRailContentIds, fetchAll } from 'musora-content-services';

const completedIds = ref([]);
const inProgressIds = ref([]);

export async function useLessonHistoryPageData(key, { page, limit, sort, searchTerm }) {
    const userStore = useUserStore();
    const { brand } = storeToRefs(userStore);

    const funcs =  {
        'inProgress': async() => {
            if(inProgressIds.value.length === 0){
                const ids =  await fetchContentInProgress('all', brand.value);
                console.log(ids);

                if(ids.started.length > 0){
                    inProgressIds.value = ids.started;
                }
            }

            if(inProgressIds.value.length > 0){
                const data = await fetchAll(brand.value, '', {
                    page,
                    limit,
                    sort,
                    searchTerm,
                    includedFields: [`railcontent_id in [${inProgressIds.value.join(',')}]`],
                });

                return data;
            }
        },
        'completed': async() => {
            if(completedIds.value.length === 0){
                const ids = await fetchCompletedContent('all', brand.value)
                completedIds.value = ids.completed;
            }

            if(completedIds.value.length > 0){
                const data = await fetchAll(brand.value, '', {
                    page,
                    limit,
                    sort,
                    searchTerm,
                    includedFields: [`railcontent_id in [${completedIds.value.join(',')}]`],
                });

                return data;
            }
        }
    }

    return await funcs[key];
}
