import React, { useCallback } from 'react';
import { useClient, useFormValue, unset } from 'sanity';
import { Stack, TextInput } from '@sanity/ui';
import { randomKey } from '@sanity/util/content';

const VimeoVideoInput = React.forwardRef((props, ref) => {
    const { elementProps, renderDefault, value = '', onChange } = props;
    const sanityClient = useClient({ apiVersion: '2023-01-01' });
    const docId = useFormValue(["_id"]);
    const videoType = useFormValue(['video.type']) ?? null;

    const handleBlur = useCallback(() => {
        if (value && videoType === 'vimeo-video') {
                const sanityConfig = window.sanityConfig.find(item => item.name === 'publishing-workspace');
                const url = `${sanityConfig.appUrl}/admin/vimeo/${value}`;

                fetch(url, {
                    method:  'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept':       'application/json',
                    },
                })
                    .then(response => {
                        if (!response.ok) {
                            console.error('Network response was not ok', response.statusText);
                            return; // Exit if the response is not ok
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Vimeo video data:', data);
                        const { length_in_seconds, hlsManifestUrl, video_playback_endpoints } = data;

                        let parsedVideoPlaybackEndpoints;
                        try {
                            parsedVideoPlaybackEndpoints = JSON.parse(video_playback_endpoints); // Parse the string to an array
                        } catch (error) {
                            console.error('Error parsing video_playback_endpoints:', error);
                            return; // Exit if there's a parsing error
                        }

                        // Ensure that parsedVideoPlaybackEndpoints is an array before updating
                        if (Array.isArray(parsedVideoPlaybackEndpoints)) {
                            // Add a unique _key to each item using randomKey
                            const itemsWithKeys = parsedVideoPlaybackEndpoints.map((item) => ({
                                _key: randomKey(), // Generate a unique key for each item
                                ...item,
                            }));

                            return sanityClient
                                .patch(docId)
                                .set({
                                    length_in_seconds, // Assuming length_in_seconds exists in your data
                                    'video.hlsManifestUrl': hlsManifestUrl,
                                    'video.video_playback_endpoints': itemsWithKeys // Now this is an array with unique keys
                                })
                                .commit();
                        } else {
                            console.error('Parsed video_playback_endpoints is not an array:', parsedVideoPlaybackEndpoints);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching Vimeo data:', error);
                    });
            } else {
            sanityClient
                .patch(docId)
                .unset(['video.hlsManifestUrl', 'video.video_playback_endpoints'])
                .commit()
                .then(() => {
                    console.log('Unset video.hlsManifestUrl and video.video_playback_endpoints successfully');
                })
                .catch(error => {
                    console.error('Error unsetting fields:', error);
                });
        }

    }, [value, videoType, sanityClient, docId]);

    return (
        <Stack space={3}>
            <TextInput
                {...elementProps}
                value={value}
                ref={ref}
                onBlur={handleBlur}
                placeholder="Enter Video external ID"
            />
        </Stack>
    );
});

export default VimeoVideoInput;
