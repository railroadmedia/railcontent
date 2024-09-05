import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "@stores/user";
import { usePlatformStore } from "@stores/platform";
import { fetchAll } from 'musora-content-services';

export async function usePackOverviewBundlePageData(params = {}){
    const platformStore = usePlatformStore();
    const userStore = useUserStore();
    const { brand } = storeToRefs(userStore);

    try {
        const data = await fetchAll(brand.value, 'pack', {
            includedFields: ['railcontent_id,394326']
        });

        console.log(data)
        return data;
    }
    catch (err){
        console.log(err)
    }
    finally {
        platformStore.setLoadingState(false);
    }
}
