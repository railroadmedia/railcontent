import React, { useEffect } from 'react';
import { useClient, useFormValue } from 'sanity';

const ResolveParentReference = React.forwardRef((props, input,context, ref) => {
    const url = new URL(window.location.href);
    const courseId = url.pathname.split('/')[5].split(';')[1]; // Adjust based on your URL structure
console.log('roxana resolve parent reference',courseId);
    const { renderDefault, elementProps } = props;
    const sanityClient = useClient({ apiVersion: '2023-01-01' });
    const docId = useFormValue(["_id"]);

    useEffect(() => {
        const updateDocument = async () => {
            try {

                    await sanityClient
                        .patch(docId)
                        .set({ parent: {
                                _type: 'reference',
                                _ref: courseId,
                            } })
                        .commit();

            } catch (error) {
                console.error('Error updating document:', error);
                // Handle error here
            }
        };

        updateDocument();
    }, [docId, courseId, sanityClient]);

    return renderDefault({ ...props, elementProps: { ...elementProps } });
});

export default ResolveParentReference;
