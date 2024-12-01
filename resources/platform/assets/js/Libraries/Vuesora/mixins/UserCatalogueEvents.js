import ContentService from '../assets/js/Services/content';
import {useResetProgress} from "@hooks/useResetProgress";

export default {
    methods: {
        // Used at the top level to emit the event with a payload
        addToList(e) {
            if (this.destroyOnListRemoval) {
                // TODO: CONFIRM IF THIS PART CAN BE DELETED
                window.showconfirmationmodal({
                    title: 'Hold your horses… This will remove this lesson from your list, are you sure about this?',
                    subtitle: 'This cannot be undone.',
                    callbacks: {
                        submit: () => {
                            this.emitAddToList({
                                content_id: this.item.id,
                                type: e.currentTarget.getAttribute('data-content-type'),
                                is_added: this.item.is_added_to_primary_playlist || false,
                            });

                            window.shownotification({
                                icon: 'check',
                                text: 'Removed! The lesson has been removed from your list.'
                            });
                        },
                        cancel: () => {
                            console.log('Remove lesson cancelled');
                        }
                    }
                });
            } else {
                const type = this.item.type ? this.item.type : e.currentTarget.getAttribute('data-content-type');

                const name = this.item.title;
                const thumbnail_url = this.item.image;
                const description = this.item.artist_name;

                this.emitAddToList({
                    content_id: this.item.id,
                    type,
                    is_added: this.item.is_added_to_primary_playlist || false,
                    name,
                    thumbnail_url,
                    description
                });
            }
        },

        progressReset(event) {
            const {resetProgress} = useResetProgress();

            resetProgress(this.item.id, {value: 'fas fa-redo-alt fa-flip-horizontal'}, true);
        },

        // Used to bus the event up one more level to the components parent
        emitAddToList(payload) {
            this.$emit('addToList', payload);
        },

        emitResetProgress(payload) {
            this.$emit('progressReset', payload);
        },

        // Used to handle the event when bussed to the top level parent
        addToListEventHandler(payload) {
            window.openplaylistmodal({modalType: 'addItem', content: payload});
        },

        resetProgressEventHandler(payload) {
            const post_index = this.content.map(post => post.id).indexOf(payload.content_id);

            ContentService.resetContentProgress(payload.content_id)
                .then((response) => {
                    if (response) {
                        window.shownotification({
                            icon: 'check',
                            text: 'Ready to start again? Your progress has been reset.'
                        });

                        this.content.splice(post_index, 1);
                    }


                    payload.icon.classList.remove('fa-spin', 'fa-spinner');
                    payload.icon.classList.add('fa-undo');
                });
        },

        addEvent(payload) {
            const payloadObject = payload.title ? payload : {
                title: this.mappedData.black_title,
                date: this.item.published_on,
            };

            this.$emit('addEvent', payloadObject);
        },
    },
};
