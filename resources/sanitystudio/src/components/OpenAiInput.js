import React, { useCallback } from 'react';
import {useFormValue, useClient} from 'sanity';
import {Stack, TextInput} from '@sanity/ui';

const OpenAiInput = React.forwardRef((props, ref) => {
    // eslint-disable-next-line
    const {onChange, value = '', elementProps} = props;
    const sanityClient = useClient({ apiVersion: '2023-01-01' });
    const docId = String(useFormValue(["_id"]));
    const patch = sanityClient.patch( docId);

    const releasedYearAI = Number(useFormValue(["released_year_ai"]));
    const released = Number(useFormValue(["released"]));
    if(releasedYearAI && releasedYearAI !== released){
        patch.set({ released: releasedYearAI }).commit().catch(console.error);
    }
    const difficultyAI = Number(useFormValue(["difficulty_ai"]));
    const difficulty = Number(useFormValue(["difficulty"]));
    if(difficultyAI && difficultyAI !== difficulty){
        patch.set({ difficulty: difficultyAI }).commit().catch(console.error);
    }

    const handleChange = useCallback(
        (event) => {
            console.log('OpenAiInput handleChange ');
        },
        [onChange]
    );
    return (
        <Stack space={3}>
            <TextInput
                {...elementProps}
                onChange={handleChange}
                value={value}
                ref={ref}
            />
        </Stack>
    );
});

export default OpenAiInput;
