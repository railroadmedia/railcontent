import { useDocumentOperation } from 'sanity';
import { randomKey } from '@sanity/util/content';

export function CreateImprovedAction(originalPublishAction, token, context) {
    const BetterAction = (props) => {
        const originalResult = originalPublishAction(props);
        const { patch, publish } = useDocumentOperation(props.id, props.type);
        const sanityConfig = window.sanityConfig.find(item => item.name === 'publishing-workspace');
        const url = sanityConfig.appUrl + `/admin/last-content`;
        const api = 'v2022-03-07';
        const perspective = 'raw';
        const headers = {
            'Authorization': `Bearer ${sanityConfig.token}`,
            'Content-Type': 'application/json'
        };

        // This function fetches the parent document by ID
        const fetchParentDocument = async (parentId) => {
            try {
                const query = `*["${parentId}" in child[]._ref]{
                    "slug":slug.current,
                    _type,
                    _id,
                    railcontent_id,
                    "parent":{
                        railcontent_id,
                        "slug":slug.current,
                        _type,
                        _id,
                        "parent": *[^._id in child[]._ref]{
                            railcontent_id, "slug":slug.current, _type, _id,
                            "parent": *[^._id in child[]._ref]{
                                railcontent_id, "slug":slug.current, _type, _id
                            }[0]
                        }[0]
                    }
                }[0]`;
                const encodedQuery = encodeURIComponent(query);
                const url2 = `https://${sanityConfig.projectId}.api.sanity.io/${api}/data/query/${sanityConfig.dataset}?perspective=${perspective}&query=${encodedQuery}`;
                const response = await fetch(url2, { headers });

                if (!response.ok) {
                    throw new Error('Failed to fetch parent document');
                }

                const result = await response.json();
                return result.result;
            } catch (error) {
                console.error('Error fetching parent document:', error);
                return null;
            }
        };

        return {
            ...originalResult,
            onHandle: async () => {
                let draftCopy = { ...props.draft };

                // Update child_count if necessary
                if ("child" in draftCopy && draftCopy.child.length !== draftCopy.child_count) {
                    draftCopy.child_count = draftCopy.child.length;
                    patch.execute([{ set: { child_count: draftCopy.child.length } }]);
                }

                // Process parent content if parent_type exists in the draft
                if ("parent_type" in draftCopy) {
                    try {
                        const parentDocument = await fetchParentDocument(props.id);
                        console.log('Fetched parent document:', parentDocument);

                        if (parentDocument) {
                            const parentsArray = [];

                            // Traverse up the parent chain and collect parents
                            let currentParent = parentDocument.parent;
                            while (currentParent) {
                                parentsArray.push({
                                    slug: currentParent.slug,
                                    type: currentParent._type,
                                    id: currentParent.railcontent_id,
                                    _key: randomKey(),
                                });

                                // Move to the next parent in the chain (if exists)
                                currentParent = currentParent.parent || null;
                            }

                            // Patch the draft with the collected parent array
                            patch.execute([{ set: { parent_content_data: parentsArray } }]);
                        }
                    } catch (error) {
                        console.error('Error processing parent document:', error);
                    }
                }

                // Fetch data from the external service
                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify(draftCopy)
                    });

                    if (!response.ok) {
                        throw new Error('Failed to fetch external data');
                    }

                    const data = await response.json();
                    console.log('Custom action response:', data);

                    // Patch the draft with the fetched data
                    patch.execute([{ set: { railcontent_id: data.id } }]);
                    patch.execute([{ set: { web_url_path: data.web_url_path } }]);
                    patch.execute([{ set: { assignment: data.assignment } }]);
                } catch (error) {
                    console.error('Error fetching external data:', error);
                }

                // Delegate to the original handler
                originalResult.onHandle();
            },
        };
    };
    return BetterAction;
}
