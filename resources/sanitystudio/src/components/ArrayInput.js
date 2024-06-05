import React from 'react';
import {useCallback, useState} from 'react'
import {Grid, Stack, Button, Box, Flex} from '@sanity/ui'
import {ArrayOfObjectsInputProps, useClient, useFormValue, set, unset} from 'sanity'



const ArrayInput  = React.forwardRef((props, ref) => {
    const {renderDefault, elementProps, onChange, value = '',  path} = props
    const sanityClient = useClient({apiVersion: '2023-01-01'});
    const docId = useFormValue(["_id"]);
    const entries = useFormValue(['soundslice']) ?? [];
    const childrenCount = useFormValue(['child_count']) ?? 0;
    const totalXP = useFormValue(['total_xp']);
    const xp = useFormValue(['xp']) ?? 150;

//     const handleChange = useCallback(
//         (event) => {
//
//             console.log('event in soundslice array::::: ', event.parent.parent,'  document::::: ', event.target);
//             const nextValue = event.currentTarget.value
//             //change <otherField> to the field you'd like to patch
//             //client.patch(id).set({otherField: nextValue}).commit()
//             console.log('entries', entries);
//             const number = entries.length;
//
//             if(number !== childrenCount) {
//                 console.log("handleChange ArrayInput   soundslices ", number, 'childrenCount:::',childrenCount)
//                 sanityClient
//                     .patch(docId)
//                     .set({
//                         child_count: number,
//                     })
//                     .commit()
//             }
//
//
//             const calculatedXP = 25*number + xp;
//             if(calculatedXP !== totalXP) {
//                 console.log("handleChange ArrayInput   soundslices ", entries, entries.length, 'totalXP:::',calculatedXP)
//                 sanityClient
//                     .patch(docId)
//                     .set({
//                         total_xp: calculatedXP,
//                     })
//                     .commit()
//             }
//
//             onChange(nextValue ? set(nextValue) : unset())
//         },
//         [onChange],
//     )
    console.log('entries', entries);
    const number = entries.length;

    if(number !== childrenCount) {
        console.log("handleChange ArrayInput   soundslices ", number, 'childrenCount:::',childrenCount)
        sanityClient
            .patch(docId)
            .set({
                child_count: number,
            })
            .commit()
    }

    const calculatedXP = 25*number + xp;
    if(calculatedXP !== totalXP) {
        console.log("handleChange ArrayInput   soundslices ", entries, entries.length, 'totalXP:::',calculatedXP)
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
