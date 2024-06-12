import React from 'react';
import { useCurrentUser} from 'sanity'

const RolesBasedArrayInput = React.forwardRef((props, ref) => {
    const {renderDefault, schemaType} = props;
    const {role} = useCurrentUser();

    // Disable 'Create' options for editors
    schemaType.of.map((option) => {
        if (role !== 'administrator') {
            option.options = {...option.options, disableNew: true};
        }
        return option;
    });

    return renderDefault({...props});
});

export default RolesBasedArrayInput;
