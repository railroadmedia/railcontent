import React, { useEffect, useState } from 'react';
import { useClient, useFormValue } from 'sanity';

const ResolveParentReference = React.forwardRef((props, ref) => {
    const { renderDefault, elementProps } = props;
    const sanityClient = useClient({ apiVersion: '2023-01-01' });
    const docId = useFormValue(["_id"]);
    const type = useFormValue(["_type"]);

    const [isPatched, setIsPatched] = useState(false);

    // Clean the ID
    let clean_id = docId?.replace(/^drafts\./, '');

    // Fetch documents and update parent field asynchronously
    const fetchDocumentsAndUpdateParent = async () => {
        if (type === "semester-pack-lesson" && !isPatched) {
            const params = { type: 'semester-pack', id: clean_id };
            const query = `*[_type == $type && ($id in child[]._ref)]`;

            try {
                const documents = await sanityClient.fetch(query, params);

                if (documents.length > 0) {
                    console.log('Resolve parent reference documents:', documents);

                    // Assuming that the documents array has at least one item, update the parent
                    await sanityClient
                        .patch(docId)
                        .set({ parent: { _type: 'reference', _ref: documents[0]._id } }) // Using the first document's _id
                        .commit()
                        .then(response => {
                            console.log('Update successful:', response);
                            setIsPatched(true); // Prevent future patches for this document
                        })
                        .catch(error => {
                            console.error('Sanity API error:', error);
                        });
                }
            } catch (error) {
                console.error('Error fetching documents:', error);
            }
        }
    };

    // useEffect to trigger the fetch on component mount or when docId/type changes
    useEffect(() => {
        if (docId && type) { // Only fetch if both docId and type are available
            fetchDocumentsAndUpdateParent();
        }
    }, [docId, type]);

    return renderDefault({ ...props, elementProps: { ...elementProps } });
});

export default ResolveParentReference;
