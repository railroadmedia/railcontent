export const musoraStructure = async (S, context) => {
//     const { getClient } = context;
//     const client = getClient({ apiVersion: '2022-12-07' });

    try {
        //TODO: replace hardcoded categories with a GROQ
        const uniqueCategories = [
            'backstage-secret', 'sonor', 'tama', 'drum-fest-international-2022', 'diy-drum-experiment', 'in-rhythm', 'spotlight', 'the-history-of-electronic-drums',
            'student-collaboration', 'behind-the-scenes', 'rhythms-from-another-planet', 'study-the-greats', 'exploring-beats', 'paiste-cymbals',
            'on-the-road', 'live', 'podcast', 'performance', 'rhythmic-adventures-of-captain-carson', 'solo', 'gear-guide', 'challenges','question-and-answer',
            'archive', 'boot-camp'
        ];
        const extra = ['challenge-part', 'course-part','semester-pack-lesson', 'media.tag', 'assist.instruction.context'];
        //'topic', 'essential', 'creativity', 'lifestyle', 'theory',
        const hiddenCategories = uniqueCategories.concat(extra);

        // Get document type list items
        const docTypeItems = S.documentTypeListItems()
            .filter(listItem => !hiddenCategories.includes(listItem.getId()));
        const showsTypeItems = S.documentTypeListItems()
            .filter(listItem => uniqueCategories.includes(listItem.getId()));

        console.log('roxana showsTypeItems',showsTypeItems);
        // Find the index of the 'artist' item
        const artistIndex = docTypeItems.findIndex(item => item.getId() === 'artist');

        // Prepare items array
        let items = docTypeItems;

        // Add divider if 'artist' item exists
        if (artistIndex !== -1) {
            // Add Shows list item
            items.splice(artistIndex, 0,
                S.listItem()
                    .title('Shows')
                    .child(() =>
                        S.list()
                            .title('Shows')
                            .id('shows')
                            .items(
                                showsTypeItems.map(item =>
                                    S.listItem()
                                        .title(item.getTitle())
                                        .child(
                                            S.documentList()
                                                .title(item.getTitle())
                                                .filter("_type == $category")
                                                .params({ category: item.getId() })
                                        )
                                )
                            )
                    )
            );

            items.splice((artistIndex+1), 0, S.divider());
        }

        return S.list()
            .title('Content')
            .items(items);
    } catch (error) {
        console.error('Error fetching categories:', error);
        return S.list()
            .title('Content')
            .items([
                ...S.documentTypeListItems()
            ]);
    }
};
