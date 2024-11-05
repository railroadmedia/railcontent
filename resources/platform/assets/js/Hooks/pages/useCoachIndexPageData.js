import { fetchAll } from 'musora-content-services';
import { useUserStore } from "@stores/user";

export async function getActiveCoaches() {
    const userStore = useUserStore();

    try {
        const result = await fetchAll(userStore.brand, 'instructor', {
            includedFields: ['is_active'],
            customFields: ['focus_text', 'is_house_coach'],
            limit: 12,
        });
        if (result) {
            return result.entity;
        }
    } catch (err) {

    }
}
