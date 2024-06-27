import React, { useCallback } from 'react';
import { useClient, useFormValue, unset } from 'sanity';
import { Stack, TextInput } from '@sanity/ui';
import { randomKey } from '@sanity/util/content';


const OpenAIFetchSongDetails = React.forwardRef((props, ref) => {
    const { elementProps,  value = '', onChange} = props;
    const sanityClient = useClient({ apiVersion: '2023-01-01' });
    const docId = useFormValue(["_id"]);

    const oldValueRef = React.useRef(0);
    console.log('roxana first',elementProps, value);
//     // eslint-disable-next-line
//     const soundsliceEntries = useFormValue(['soundslice']) ?? [];
//
//     const extractValue = (str) => {
//         // Define the regular expression pattern to match the key's value
//         const pattern = /soundslice\[_key=="(.*?)"\]/;
//         const match = str.match(pattern);
//
//         // If there's a match, extract the value, otherwise return null
//         return match ? match[1] : null;
//     };

        const OPENAI_API_KEY = 'sk-proj-kzgtxjxyxwuaRc9a9Qo1T3BlbkFJ6REV0l9r6eet3WwKI3cz';
    const songName = useFormValue(['name']);
    const [state, setState] = useState();

//     const [error, setError] = useState(null);
//     const { documentId } = useFormState();
//     const { patch } = useDocumentOperation(documentId, 'song');
    console.log('roxana 2');
    const handleChange = useCallback(

         (event) => {
             const oldValue = oldValueRef.current;
             console.log('roxana handleChange', oldValueRef, oldValue);
            // Get the soundslice key (_key) from the event target's id
            const newValue = event.target.value;
            const elementNameArray = event.target.id.split(".");
            const firstElement = elementNameArray[0];
//             const soundsliceKey = extractValue(firstElement);
//             console.log('roxana 3');
//             console.log('SoundsliceSlug Soundslice KEY:', soundsliceEntries, soundsliceKey, window.sanityConfig.appUrl);

            if (newValue) {
                const url = 'https://api.openai.com/v1/completions';
                console.log('roxana 4');
//                 fetch(url, {
//                     method: 'POST',
//                     headers: {
//                         'Content-Type': 'application/json',
//                         'Accept': 'application/json',
//                     },
//                 })
//                     .then(response => {
//                         if (!response.ok) {
//                             throw new Error('Network response was not ok');
//                         }
//                         return response.json();
//                     })
//                     .then(data => {
//                         const newLength = data;
//
//                         // Update the soundslice array
//                         const updatedEntries = soundsliceEntries.map(entry => {
//                             if (entry._key === soundsliceKey) {
//                                 return {
//                                     ...entry,
//                                     soundslice_slug: newValue,
//                                     soundslice_length_in_second: newLength,
//                                 };
//                             }
//                             return entry;
//                         });
//
//                         // Handle case where no existing entry matches the key
//                         const entryExists = updatedEntries.some(entry => entry._key === soundsliceKey);
//                         if (!entryExists || !soundsliceKey) {
//                             updatedEntries.push({
//                                 _key: randomKey(),
//                                 soundslice_slug: newValue,
//                                 soundslice_length_in_second: newLength,
//                             });
//                         }
//
//                         console.log('SoundsliceSlug ...... from Soundslice API:   duration', newLength, ' updated Entries:::: ', updatedEntries);
//                         sanityClient
//                             .patch(docId)
//                             .set({
//                                 soundslice: updatedEntries,
//                             })
//                             .commit()
//                     })
//                     .catch(error => {
//                         console.error('Error fetching data from Soundslice API:', error);
//                     });

                try {
                    console.log('roxana fetch  5');
                    const response = fetch('https://api.openai.com/v1/completions', {
                        method:  'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            Authorization:  `Bearer ${OPENAI_API_KEY}`,
                        },
                        body:    JSON.stringify({
                            model:      'gpt-3.5-turbo',
                            prompt:     `Provide the album name and release date for the song "${songName}".`,
                            max_tokens: 60,
                        }),
                    });

                    const data =  response.json();
                    const result = data.choices[0].text.trim();
                    const [album, released] = result.split('\n').map(line => line.split(': ')[1]);

                    // Update the document fields with the fetched data
//                     patch.execute([
//                         {set: {album}},
//                         {set: {released}},
//                     ]);
                } catch (error) {
                    console.error('Error fetching song details:', error);
                } finally {
                   // setLoading(false);
                }

        } else {
                //onChange(unset(['soundslice']));
            }
        },
        [onChange,  docId, sanityClient]
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

export default OpenAIFetchSongDetails;
