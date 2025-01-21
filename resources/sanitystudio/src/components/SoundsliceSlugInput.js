import React, { useCallback } from 'react';
import { useClient, useFormValue, unset } from 'sanity';
import { Stack, TextInput } from '@sanity/ui';
import { randomKey } from '@sanity/util/content';

const SoundsliceSlugInput = React.forwardRef((props, ref) => {
    const { elementProps,  value = '', onChange} = props;
    const sanityClient = useClient({ apiVersion: '2023-01-01' });
    const docId = useFormValue(["_id"]);
    // eslint-disable-next-line
    const soundsliceEntries = useFormValue(['soundslice']) ?? [];

    const extractValue = (str) => {
        // Define the regular expression pattern to match the key's value
        const pattern = /soundslice\[_key=="(.*?)"\]/;
        const match = str.match(pattern);

        // If there's a match, extract the value, otherwise return null
        return match ? match[1] : null;
    };

    const handleChange = useCallback(
        (event) => {
            // Get the soundslice key (_key) from the event target's id
            const newValue = event.target.value;
            const elementNameArray = event.target.id.split(".");
            const firstElement = elementNameArray[0];
            const soundsliceKey = extractValue(firstElement);
            const sanityConfig = window.sanityConfig.find(item => item.name == 'publishing-workspace');
            if (newValue) {
                const url = sanityConfig.appUrl +`/admin/soundslice?slug=${newValue}`;
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        const newLength = data;

                        // Update the soundslice array
                        const updatedEntries = soundsliceEntries.map(entry => {
                            if (entry._key === soundsliceKey) {
                                return {
                                    ...entry,
                                    soundslice_slug: newValue,
                                    soundslice_length_in_second: newLength,
                                };
                            }
                            return entry;
                        });

                        // Handle case where no existing entry matches the key
                        const entryExists = updatedEntries.some(entry => entry._key === soundsliceKey);
                        if (!entryExists || !soundsliceKey) {
                            updatedEntries.push({
                                _key: randomKey(),
                                soundslice_slug: newValue,
                                soundslice_length_in_second: newLength,
                            });
                        }

                        console.log('SoundsliceSlug ...... from Soundslice API:   duration', newLength, ' updated Entries:::: ', updatedEntries);
                        sanityClient
                            .patch(docId)
                            .set({
                                soundslice: updatedEntries,
                            })
                            .commit()
                    })
                    .catch(error => {
                        console.error('Error fetching data from Soundslice API:', error);
                    });
            } else {
                onChange(unset(['soundslice']));
            }
        },
        [onChange, soundsliceEntries, docId, sanityClient]
    );

    return (
        <Stack space={3}>
            <TextInput
                {...elementProps}
                onChange={handleChange}
                value={value}
                ref={ref}
                data-soundslice-id={props._key}
            />
        </Stack>
    );
});

export default SoundsliceSlugInput;
