import React from 'react';
import {useCallback} from 'react'
import {useClient, useFormValue, set, unset} from 'sanity'

const ArrayInput  = React.forwardRef((props, ref) => {
    const {renderDefault, elementProps, value = '',  onChange} = props
    const sanityClient = useClient({apiVersion: '2023-01-01'});
    const docId = useFormValue(["_id"]);
    const entries = useFormValue(['soundslice']) ?? [];
    const childrenCount = useFormValue(['child_count']) ?? 0;
    const totalXP = useFormValue(['total_xp']);
    const xp = useFormValue(['xp']) ?? 150;

    const handleChange = useCallback(
        (event) => {
            const elementName = event.target.id.split(".").pop();
            if(elementName === 'soundslice_slug') {
                const url = 'https://dev.musora.com:8443/admin/soundslice?slug='+event.target.value;
                    const getDuration = async () =>
                        fetch(url,{
                            method: 'get',
                            headers: new Headers({
                                'Access-Control-Allow-Origin': '*',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            }),
                        }).then(response=>response.json())
                            .then(data=>{ console.log(data);
                                sanityClient
                                    .patch(docId)
                                    .set({
                                        length_in_seconds: data,
                                    })
                                    .commit()})
                           .catch((error) => {
                            console.error(error);
                        });
                    getDuration();
            }
           const nextValue = event.target.value;
        },
        [onChange],
    )
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

    return renderDefault({ ...props, elementProps: {...elementProps, onChange:handleChange}})
});
export default ArrayInput;
