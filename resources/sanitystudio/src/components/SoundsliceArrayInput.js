import React, { useEffect } from 'react';
import { useClient, useFormValue, set } from 'sanity';

const SoundsliceArrayInput = React.forwardRef((props, ref) => {
    const { renderDefault, elementProps } = props;
    const sanityClient = useClient({ apiVersion: '2023-01-01' });
    const docId = useFormValue(["_id"]);
    const entries = useFormValue(['soundslice']) || [];
    const childrenCount = useFormValue(['child_count']) || 0;
    const totalXP = useFormValue(['total_xp']);
    const xp = useFormValue(['xp']) || 150;

    useEffect(() => {
        const updateDocument = async () => {
            try {
                const number = entries.length;
                if (number !== childrenCount) {
                    await sanityClient
                        .patch(docId)
                        .set({ child_count: number })
                        .commit();
                }

                const calculatedXP = 25 * number + xp;
                if (calculatedXP !== totalXP) {
                    await sanityClient
                        .patch(docId)
                        .set({ total_xp: calculatedXP })
                        .commit();
                }
            } catch (error) {
                console.error('Error updating document:', error);
                // Handle error here
            }
        };

        updateDocument();
    }, [docId, entries, childrenCount, totalXP, xp, sanityClient]);

    return renderDefault({ ...props, elementProps: { ...elementProps } });
});

export default SoundsliceArrayInput;
