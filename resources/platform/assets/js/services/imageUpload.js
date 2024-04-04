export const uploadImage = async (formData, token, progressCallback) => {
    return Vapor.store(formData.get('file'), {
        visibility: 'public-read',
        progress: progress => {
            progressCallback(progress * 100);
        }
    }).then(response => {
        console.log(response);
        const options = token ? {
            headers: {
                'X-CSRF-TOKEN': token
            }
        } : {};
        axios.post('/musora-api/v5/picture/upload-from-s3', {
            uuid: response.uuid,
            s3_bucket_path: response.key,
            bucket: response.bucket,
            fieldKey: 'forum_post_photo'
        }, options)
    })
};
