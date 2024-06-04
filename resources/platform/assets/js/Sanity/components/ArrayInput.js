import React from 'react';
import {useCallback} from 'react'
import {Grid, Stack, Button} from '@sanity/ui'
import {AddIcon} from '@sanity/icons'
import {ArrayOfObjectsInputProps, useFormValue} from 'sanity'
import {useDocumentPane} from 'sanity/desk'


const ArrayInput  = React.forwardRef((props, ref) => {
    const {value, path} = props
    const {onChange} = useDocumentPane()
    const docId = String(useFormValue(["_id"]));
    console.log("handleChange ArrayInput   doc id:: ", docId, 'props:::: ',props)

    const handleChange = useCallback(
        (event) => {
            console.log('handleChange event', event,  docId);

            onChange(event.target.value ? set(event.target.value) : unset());
        },
        [onChange]
    )

    return (
        <Stack space={3}>
            {props.renderDefault(props)}
        </Stack>
    )
});
export default ArrayInput;
