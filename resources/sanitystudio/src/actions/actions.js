import { useDocumentOperation } from 'sanity';
import { randomKey } from '@sanity/util/content';

export function CreateImprovedAction(originalPublishAction, token, context) {
    const BetterAction = (props) => {
        const originalResult = originalPublishAction(props);
        const { patch, publish } = useDocumentOperation(props.id, props.type);
        const sanityConfig = window.sanityConfig.find(item => item.name === 'publishing-workspace');
        const { projectId, dataset, token: sanityToken, appUrl } = sanityConfig;
        const apiVersion = 'v2022-03-07';
        const perspective = 'raw';
        const baseUrl = `https://${projectId}.api.sanity.io/${apiVersion}/data/query/${dataset}`;
        const headers = {
            'Authorization': `Bearer ${sanityToken}`,
            'Content-Type': 'application/json',
        };

        // Generic document fetch function
        const fetchDocument = async (query) => {
            try {
                const encodedQuery = encodeURIComponent(query);
                const response = await fetch(`${baseUrl}?perspective=${perspective}&query=${encodedQuery}`, { headers });

                if (!response.ok) {
                    throw new Error('Failed to fetch document');
                }
                const result = await response.json();
                return result.result;
            } catch (error) {
                console.error('Error fetching document:', error);
                return null;
            }
        };

        const mapRailcontentToId = (childrenArray, childId) => {
            const matchedChild = childrenArray.find(child => child.railcontent_id === childId);
            return matchedChild ? matchedChild._id : null;
        };

        const mutate = async (mutations) => {
            try {
                const response = await fetch(
                    `https://${projectId}.api.sanity.io/v2021-06-07/data/mutate/${dataset}`,
                    {
                        headers,
                        body: JSON.stringify(mutations),
                        method: 'POST',
                    }
                );
                const json = await response.json();
                if (!response.ok) {
                    throw new Error('Mutation failed');
                }
                return json;
            } catch (error) {
                console.error('Error in mutation request:', error);
                throw error;
            }
        };

        const patchChildDocument = async (childId, updates, childrenArray) => {
            const documentId = mapRailcontentToId(childrenArray, childId);
            if (!documentId) {
                console.error(`No matching document found for railcontent_id: ${childId}`);
                return;
            }

            try {
                const mutations = {
                    mutations: [{ patch: { id: documentId, set: updates } }],
                };
                const response = await mutate(mutations);
                if (response?.results) {
                    console.log(`Successfully updated child document with _id: ${documentId}`);
                } else {
                    console.error(`Failed to update child document with _id: ${documentId}`);
                }
            } catch (error) {
                console.error(`Failed to update child document ${childId}:`, error);
            }
        };

        return {
            ...originalResult,
            onHandle: async () => {
                let draftCopy = { ...props.draft };
                let childrenArray = [];

                if (draftCopy.child) {
                    draftCopy.child_count = draftCopy.child.length;
                    patch.execute([{ set: { child_count: draftCopy.child.length } }]);

                    // Fetch child documents in parallel
                    childrenArray = await Promise.all(
                        draftCopy.child.map(child => fetchDocument(`*[_id == "${child._ref}"]{ "slug": slug.current, _type, _id, railcontent_id }[0]`))
                    );
                    draftCopy.childrenArray = childrenArray;
                }

                // Process parent document if applicable
                if (draftCopy.parent_type) {
                    const parentDocument = await fetchDocument(`*["${props.id}" in child[]._ref]{ "slug": slug.current, _type, _id, railcontent_id, "parent": ... }[0]`);
                    if (parentDocument) {
                        const parentsArray = [];
                        let currentParent = parentDocument.parent;
                        while (currentParent) {
                            parentsArray.push({
                                slug: currentParent.slug,
                                type: currentParent._type,
                                id: currentParent.railcontent_id,
                                _key: randomKey(),
                            });
                            currentParent = currentParent.parent || null;
                        }
                        patch.execute([{ set: { parent_content_data: parentsArray } }]);
                    }
                }

                // Fetch data from external service
                try {
                    const externalUrl = `${appUrl}/admin/last-content`;
                    const response = await fetch(externalUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token,
                        },
                        body: JSON.stringify(draftCopy),
                    });

                    if (!response.ok) {
                        throw new Error('Failed to fetch external data');
                    }

                    const data = await response.json();
                    patch.execute([{ set: { railcontent_id: data.id, web_url_path: data.web_url_path, assignment: data.assignment } }]);

                    if (data.childrens) {
                        for (const child of data.childrens) {
                            const parentData = JSON.parse(child.parent_content_data)[0];
                            const updates = {
                                parent_content_data: [{
                                    slug: parentData.slug,
                                    type: parentData.type,
                                    id: parentData.id,
                                    _key: randomKey(),
                                }],
                            };
                            await patchChildDocument(child.id, updates, childrenArray);
                        }
                    }
                } catch (error) {
                    console.error('Error fetching external data:', error);
                }

                originalResult.onHandle();
            },
        };
    };
    return BetterAction;
}
