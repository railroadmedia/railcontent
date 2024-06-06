import React from 'react';
import {useCallback} from 'react'
import {useFormValue} from 'sanity'
import {Stack, TextInput} from '@sanity/ui'
import {set, unset, useClient} from 'sanity'


const CustomInput = React.forwardRef((props, ref) => {
    console.log('This is an important message');
    const sanityClient = useClient({apiVersion: '2023-01-01'});
    const docId = String(useFormValue(["_id"]));

    const {onChange, value = '', elementProps, document } = props

    console.log("handleChange doc id:: ", docId, 'props:::: ',elementProps)

    const diff = [
        {id: '1', title: 'Novice'},
        {id: '2', title: 'Beginner'},
        {id: '3', title: 'Beginner'},
        {id: '4', title: 'Intermediate'},
        {id: '5', title: 'Intermediate'},
        {id: '6', title: 'Advanced'},
        {id: '7', title: 'Advanced'},
        {id: '8', title: 'Expert'},
        {id: '9', title: 'Expert'},
        {id: '10', title: 'Expert'},
    ];

    // Creates a change handler for patching data
    const handleChange = useCallback(
        (event) => {
            console.log('handleChange event', event,  docId);
            if(event.target.id === 'difficulty') {
                const difficulty = diff.filter((element) => {
                     return element.id === event.target.value;
                    }
                );

                if (difficulty[0]) {
                    console.log('handleChange set difficulty string',difficulty[0], docId);
                    sanityClient
                        .patch(docId)
                        .set({
                            difficulty_string: difficulty[0] ? difficulty[0].title : '',
                        })
                        .commit()
                }
            }
            onChange(event.target.value ? set(event.target.value) : unset());
        },
        [onChange]
    )

    return (
        <Stack space={3}>
            <TextInput type={"number"} {...elementProps} onChange={handleChange} value={value} />
        </Stack>
    )
});

export default CustomInput;

