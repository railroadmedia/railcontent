import {useDocumentOperation} from 'sanity'

export function CreateImprovedAction(originalPublishAction, token, context) {
    const BetterAction = (props) => {
        const { document, getClient } = context;
        const originalResult = originalPublishAction(props)
        // eslint-disable-next-line
        const {patch, publish} = useDocumentOperation(props.id, props.type)
        const sanityConfig = window.sanityConfig.find(item => item.name == 'publishing-workspace');
        const url = sanityConfig.appUrl + `/admin/last-content`;
        const client = getClient({ apiVersion: '2022-12-07' });
        console.log('roxana publish action before check::::');
        return {
            ...originalResult,
            onHandle: async () => {
                // Sync railcontent with new content and sync railcontent_id and web_url_path
                if (props.parent) {
                    const params = {
                        id: props.parent._ref,
                    };
                    // Construct the query based on the presence of the brand field
                    let query = `*[_id == $id]`;
//                     if (document.parent) {
//                         params.parent = document.parent._ref;
//                         query = `*[_type == $type && parent._ref == $parent && slug.current == $slug && !(_id in [$id, $draft_id])]`;
//                     } else if (document.brand) {
//                         params.brand = document.brand;
//                         query = `*[_type == $type && brand == $brand && slug.current == $slug && !(_id in [$id, $draft_id])]`;
//                     }
                    const documents = await client.fetch(query, params);
                    console.log('roxana publish action::::', props, documents);
                }
                fetch(url, {
                    method:  'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept':       'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body:    JSON.stringify(props.draft)
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Custom action   response .....', data)
                        patch.execute([{set: {railcontent_id: data.id}}])
                        patch.execute([{set: {web_url_path: data.web_url_path}}])
                    })
                    .catch(error => {
                        console.error('Error fetching data in publish action ::', error);
                    });
                // then delegate to original handler
                originalResult.onHandle()
            },
        }
    }
    return BetterAction
}
