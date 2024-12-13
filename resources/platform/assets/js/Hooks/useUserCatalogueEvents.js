import { resetContentProgress } from 'musora-content-services';

export default function useUserCatalogueEvents(props, context) {
    function progressReset(event) {
        const icon = event.target;
        window.showconfirmationmodal({
            title: 'Hold your horses… This will reset your progress, are you sure about this?',
            subtitle: 'This cannot be undone.',
            callbacks: {
                submit: () => {
                    if (icon) {
                        icon.classList.remove('fa-undo');
                        icon.classList.add('fa-spin', 'fa-spinner');
                    }
        
                    props.emitResetProgress({
                        content_id: props.item.id,
                        icon,
                    });
                },
                cancel: () => {
                    console.log('Reset progress cancelled');
                }
            }
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
                name = props.item.title;
                thumbnail_url = props.item.thumbnail;
                description = props.item.artist_name;
            } else {
                name = props.item.title ?? '';
                thumbnail_url = props.item.thumbnail ?? '';
                description = '';

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
        return resetContentProgress(payload.content_id);
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
