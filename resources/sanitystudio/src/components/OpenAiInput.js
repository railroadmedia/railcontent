import React, { useCallback, useEffect, useState } from 'react';
import { useFormValue, useClient } from 'sanity';
import { Stack, TextInput } from '@sanity/ui';

const OpenAiInput = React.forwardRef((props, ref) => {
    const { onChange, value = '', elementProps } = props;
    const sanityClient = useClient({ apiVersion: '2023-01-01' });
    const docId = String(useFormValue(["_id"]));

    const releasedYearAI = Number(useFormValue(["released_year_ai"]));
    const released = Number(useFormValue(["released"]));

    const difficultyAI = Number(useFormValue(["difficulty_ai"]));
    const difficulty = Number(useFormValue(["difficulty"]));

    const [error, setError] = useState(null);

    useEffect(() => {
        const patchDocument = async () => {
            try {
                const patch = sanityClient.patch(docId);

                if (releasedYearAI && releasedYearAI !== released) {
                    patch.set({ released: releasedYearAI });
                }
                if (difficultyAI && difficultyAI !== difficulty) {
                    patch.set({ difficulty: difficultyAI });
                }

                await patch.commit();
            } catch (error) {
                console.error("Error patching document:", error);
                setError("Failed to update document.");
            }
        };

        if (releasedYearAI !== released || difficultyAI !== difficulty) {
            patchDocument();
        }
    }, [releasedYearAI, released, difficultyAI, difficulty, docId, sanityClient]);

    const handleChange = useCallback((event) => {
        const newValue = event.currentTarget.value;
        console.log('OpenAiInput handleChange', newValue);
        onChange(newValue); // Call the onChange prop to handle changes externally
    }, [onChange]);

    return (
        <Stack space={3}>
            {error && <div style={{ color: 'red' }}>{error}</div>}
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
