import React from 'react';
import {useCallback} from 'react'
import {useClient, useFormValue, set} from 'sanity'
import {randomKey} from '@sanity/util/content'

const ArrayInput  = React.forwardRef((props, ref) => {
    const {renderDefault, elementProps, value = '',  onChange} = props
    const sanityClient = useClient({apiVersion: '2023-01-01'});
    const docId = useFormValue(["_id"]);
    const entries = useFormValue(['soundslice']) ?? [];
    const childrenCount = useFormValue(['child_count']) ?? 0;
    const totalXP = useFormValue(['total_xp']);
    const xp = useFormValue(['xp']) ?? 150;

    const number = entries.length;
    if(number !== childrenCount) {
        sanityClient
            .patch(docId)
            .set({
                child_count: number,
            })
            .commit()
    }

    const calculatedXP = 25*number + xp;
    if(calculatedXP !== totalXP) {
        sanityClient
            .patch(docId)
            .set({
                total_xp: calculatedXP,
            })
            .commit()
    }

    return renderDefault({ ...props, elementProps: {...elementProps}})
});
export default ArrayInput;
