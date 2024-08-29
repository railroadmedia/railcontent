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
        const extra = ['challenge-part','foundation','learning-path','learning-path-level','learning-path-course','learning-path-lesson','course-part','unit','unit-part','semester-pack-lesson','song-tutorial-children','pack-bundle-lesson','pack-bundle', 'media.tag', 'assist.instruction.context'];
        //'topic', 'essential', 'creativity', 'lifestyle', 'theory',
        const hiddenCategories = uniqueCategories.concat(extra);

        // Get document type list items
        const docTypeItems = S.documentTypeListItems()
            .filter(listItem => !hiddenCategories.includes(listItem.getId()));
        const showsTypeItems = S.documentTypeListItems()
            .filter(listItem => uniqueCategories.includes(listItem.getId()));

        // Find the index of the 'artist' item
        const artistIndex = docTypeItems.findIndex(item => item.getId() === 'artist');

        // Prepare items array
        let items = docTypeItems;

        // Add divider if 'artist' item exists
        if (artistIndex !== -1) {
            // Add Shows list item
            items.splice(artistIndex, 0,
                S.listItem()
                    .title("Methods")
                    .id("method")
                    .child(
                        S.documentList()
                            .title('Methods')
                            .filter('_type == "learning-path" && railcontent_id in $railcontentId')
                            .params({ railcontentId:  [241247, 276693, 333652, 308514]})
                    ),
                S.listItem()
                    .title("Foundation 2019")
                    .id("foundation")
                    .child(
                        S.document()
                            .title('Foundation')
                            .documentId("foundation")
                            .schemaType("foundation")
                    ),
                S.listItem()
                    .title("Old Learning Paths")
                    .id("learning-path")
                    .child(
                        S.documentList()
                            .title('Old Learning Paths')
                            .filter('_type == "learning-path" && !(railcontent_id in $railcontentId)')
                            .params({ railcontentId:  [241247, 276693, 333652, 308514]})
                    ),
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

            items.splice((artistIndex+4), 0, S.divider());
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
