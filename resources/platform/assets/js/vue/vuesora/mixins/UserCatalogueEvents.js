import ContentService from '../assets/js/services/content';
import Toasts from '../assets/js/classes/toasts';


const getValue = (obj, key) => {
    return obj.filter((field) => {
        if (field.key === key) {
            return true;
        }
    })[0].value;
}

export default {
    methods: {
        // Used at the top level to emit the event with a payload
        addToList(e) {
            if (this.destroyOnListRemoval) {
                // TODO: CONFIRM IF THIS PART CAN BE DELETED
                Toasts.confirm({
                    title: 'Hold your horses… This will remove this lesson from your list, are you sure about this?',
                    submitButton: {
                        text: `<span class="bg-${this.themeColor} text-white short">I want to remove it</span>`,
                        callback: () => {
                            this.emitAddToList({
                                content_id: this.item.id,
                                type: e.currentTarget.getAttribute('data-content-type'),
                                is_added: this.item.is_added_to_primary_playlist || false,
                            });

                            Toasts.push({
                                icon: 'happy',
                                title: 'REMOVED!',
                                themeColor: this.themeColor,
                                message: 'The lesson has been removed from your list.',
                            });
                        },
                    },
                    cancelButton: {
                        text: '<span class="bg-grey-3 inverted text-grey-3 short">Get me out of here</span>',
                    },
                });
            } else {
                console.log({...this.item})
                const name = getValue(this.item.fields, 'title');
                const thumbnail_url = getValue(this.item.data, 'thumbnail_url');
                const description = getValue(this.item.data, 'description');

                this.emitAddToList({
                    content_id: this.item.id,
                    type: e.currentTarget.getAttribute('data-content-type'),
                    is_added: this.item.is_added_to_primary_playlist || false,
                    name,
                    thumbnail_url,
                    description
                });
            }
        },

        progressReset(event) {
            const icon = event.target;
            Toasts.confirm({
                title: 'Hold your horses… This will reset your progress, are you sure about this?',
                submitButton: {
                    text: `<span class="bg-${this.themeColor} text-white short">I want to start over</span>`,
                    callback: () => {
                        icon.classList.remove('fa-undo');
                        icon.classList.add('fa-spin', 'fa-spinner');

                        this.emitResetProgess({
                            content_id: this.item.id,
                            icon,
                        });
                    },
                },
                cancelButton: {
                    text: '<span class="bg-grey-3 inverted text-grey-3 short">Get me out of here</span>',
                },
            });
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
            console.log('add to list event handler', payload)
            window.openplaylistmodal({ modalType: 'addItem', content: payload });
        },

        resetProgressEventHandler(payload) {
            const post_index = this.content.map(post => post.id).indexOf(payload.content_id);

            ContentService.resetContentProgress(payload.content_id)
                .then((response) => {
                    if (response) {
                        Toasts.push({
                            icon: 'happy',
                            title: 'READY TO START AGAIN?',
                            themeColor: this.themeColor,
                            message: 'Your progress has been reset.',
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
