import ContentService from '../vuesora/assets/js/services/content';
import Toasts from '../vuesora/assets/js/classes/toasts';

const getValue = (obj, key) => {
    const filtered = obj.filter((field) => {
        if (field.key === key) {
            return true;
        }
    })
    return filtered.length ? filtered[0].value : '';
}

export default function useUserCatalogueEvents(props, context) {
    function progressReset(event) {
        const icon = event.target;
        Toasts.confirm({
            title: 'Hold your horses… This will reset your progress, are you sure about this?',
            submitButton: {
                text: `<span class="bg-${props.themeColor} text-white short">I want to start over</span>`,
                callback: () => {
                    if(icon){
                        icon.classList.remove('fa-undo');
                        icon.classList.add('fa-spin', 'fa-spinner');
                    }

                    props.emitResetProgress({
                        content_id: props.item.id,
                        icon,
                    });
                },
            },
            cancelButton: {
                text: '<span class="bg-grey-3 inverted text-grey-3 short">Get me out of here</span>',
            },
        });
    }

    function emitResetProgress(payload) {
        context.emit('progressReset', payload);
    }

    function addToList(payload) {
        if (!payload) {
            const type = props.item.type ? props.item.type : e.currentTarget.getAttribute('data-content-type');
            let name = '';
            let thumbnail_url = '';
            let description = '';
            if (type === 'song') {
                name = getValue(props.item.fields, 'title');
                thumbnail_url = getValue(props.item.data, 'thumbnail_url');
                description = getValue(props.item.fields, 'artist');
            } else {
                name = getValue(props.item.fields, 'title');
                thumbnail_url = getValue(props.item.data, 'thumbnail_url');
                description = getValue(props.item.data, 'description');

            }
            window.openplaylistmodal({
                modalType: 'addItem', content: {
                    content_id: props.item.id,
                    type,
                    is_added: props.item.is_added_to_primary_playlist || false,
                    name,
                    thumbnail_url,
                    description
                }
            })
        } else {
            window.openplaylistmodal({ modalType: 'addItem', content: payload });
        }
    }

    function resetProgressEventHandler(payload) {
        const post_index = props.content.map(post => post.id).indexOf(payload.content_id);

        ContentService.resetContentProgress(payload.content_id)
            .then((response) => {
                if (response) {
                    Toasts.push({
                        icon: 'happy',
                        title: 'READY TO START AGAIN?',
                        themeColor: props.themeColor,
                        message: 'Your progress has been reset.',
                    });

                    props.content.splice(post_index, 1);
                }

                if(payload.icon) {
                    payload.icon.classList.remove('fa-spin', 'fa-spinner');
                    payload.icon.classList.add('fa-undo');
                }
            });
    }

    function addEvent(payload) {
        const payloadObject = payload.title ? payload : {
            title: props.mappedData.black_title,
            date: props.item.published_on,
        };

        context.emit('addEvent', payloadObject);
    }

    return {
        addToList,
        progressReset,
        emitResetProgress,
        resetProgressEventHandler,
        addEvent,
    };
}
