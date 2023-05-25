import axios from 'axios';

export default {
    push(error) {
        if (axios.isCancel(error)) {

        } else {
            console.error(error);
        }
    },
};
