import { useDocumentOperation } from 'sanity';

export function CreateImprovedAction(originalPublishAction, token, context) {
    const BetterAction = (props) => {
        const originalResult = originalPublishAction(props);
        // eslint-disable-next-line
        const { patch, publish } = useDocumentOperation(props.id, props.type);
        const sanityConfig = window.sanityConfig.find(item => item.name == 'publishing-workspace');
        const url = sanityConfig.appUrl + `/admin/last-content`;

        return {
            ...originalResult,
            onHandle: async () => {
                if ("child" in props.draft && props.draft.child.length !== props.draft.child_count) {
                    // Update child_count
                    props.draft.child_count = props.draft.child.length;
                    patch.execute([{ set: { child_count: props.draft.child.length } }]);
                }

                // Set parent reference for each child
//                 if (props.draft.child && Array.isArray(props.draft.child)) {
//                     let clean_id = props.id.replace(/^drafts\./, '')
//                     for (const child of props.draft.child) {
//                         console.log('roxana child::::', child,' parent::::', clean_id);
//                         patch.execute([{ set: { parent: { _type: 'reference', _ref: clean_id } } }], child._id)
//                             .then(response => {
//                                 console.log('Parent reference set for child:', child._id, response);
//                             })
//                             .catch(error => {
//                                 console.error('Error setting parent reference for child:', child._id, error);
//                             });
//                     }
//                 }

                // Fetch data from the external service
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify(props.draft)
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Custom action response:', data);
                        patch.execute([{ set: { railcontent_id: data.id } }]);
                        patch.execute([{ set: { web_url_path: data.web_url_path } }]);
                    })
                    .catch(error => {
                        console.error('Error fetching data in publish action:', error);
                    });

                // Delegate to the original handler
                originalResult.onHandle();
            },
        };
    };
    return BetterAction;
}
