import { fetchAll } from 'musora-content-services';
import { useUserStore } from "@stores/user";
import { getContentId } from '@hooks/utils';

export async function useCoachShowPageData() {
    const userStore = useUserStore();

    try {
        const result = await fetchAll(userStore.brand, 'instructor', {
            useDefaultFields: false,
            includedFields: [`railcontent_id,${getContentId()}`],
            customFields: [
                '"id": railcontent_id',
                'name',
                'focus_text',
                'focus',
                'bands',
                'endorsements',
                '"long_bio":long_bio[0].children[0].text',
                '"short_bio":short_bio[0].children[0].text',
                '"head_shot_picture_url":thumbnail_url.asset->url',
                '"coach_top_banner_image":coach_top_banner_image.asset->url',
            ],
        });

        if (result) {
            return {
                data: result.entity[0],
                breadcrumbData: getBreadcrumbs(result.entity[0].name),
            };
        }
    } catch (err) {

    }
}

const getBreadcrumbs = (name) => {
    const userStore = useUserStore();

    return [
        {
            title: 'Coaches',
            url: `/${userStore.brand}/coaches`,
        },
        {
            title: name,
        }
    ];
}
