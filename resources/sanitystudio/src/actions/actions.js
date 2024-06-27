import {useDocumentOperation} from 'sanity'

export function CreateImprovedAction(originalPublishAction, token) {
    const BetterAction = (props) => {
        const originalResult = originalPublishAction(props)
        // eslint-disable-next-line
        const {patch, publish} = useDocumentOperation(props.id, props.type)
        const sanityConfig = window.sanityConfig.find(item => item.name == 'publishing-workspace');
        const url = sanityConfig.appUrl + `/admin/last-content`;

        return {
            ...originalResult,
            onHandle: () => {
                // Sync railcontent with new content and sync railcontent_id and web_url_path
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
                        console.log('Custom action    primesc response .....', data.id, data.web_url_path)
                        patch.execute([{set: {railcontent_id: data.id}}])
                        patch.execute([{set: { web_url_path: data.web_url_path }}])
                    })
                    .catch(error => {
                        console.error('Error fetching data from Soundslice API:', error);
                    });
                // then delegate to original handler
                originalResult.onHandle()
            },
        }
    }
    return BetterAction
}
