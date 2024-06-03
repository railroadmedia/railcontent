import React from 'react';
import {useCallback} from 'react'
import {useFormValue} from 'sanity'
import {Box, Stack, Text, TextInput} from '@sanity/ui'
import {StringInputProps, StringSchemaType, set, unset, useClient} from 'sanity'


const CustomInput = React.forwardRef((props) => {
    console.log('This is an important message');
    const sanityClient = useClient({apiVersion: '2023-01-01'});
    const docId = String(useFormValue(["_id"]));
    const {onChange, value = '', elementProps, document } = props
    const diff = [
        {id: '0', title: 'Novice', content: 'Welcome to learning React!'},
        {id: '1', title: 'Intermediate', content: 'You can install React from npm.'},
        {id: '2', title: 'Intermediate', content: 'You can install React from npm.'}];

    // Creates a change handler for patching data
    const handleChange = useCallback(
        (event) =>
            onChange(event.currentTarget.value ? set(event.currentTarget.value) : unset()),
        [onChange]
    )

    const difficulty = diff.filter((element) =>
    {
        console.log("listofItems: element:: ", element, element.id, value, element.id === value)
        return element.id === value;
    }
    );

    if(difficulty[0]) {
        sanityClient
            .patch(docId)
            .set({
                post: {
                    difficult: difficulty[0] ? difficulty[0].title : '',
                },
            })
            .commit()
    }

    return (
        <Stack space={3}>
            <TextInput {...elementProps} onChange={handleChange} value={value} />
        </Stack>
    )
});

export default CustomInput;

