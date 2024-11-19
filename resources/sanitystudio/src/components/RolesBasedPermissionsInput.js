import React, { useMemo, memo } from 'react';
import { useCurrentUser } from 'sanity';

const RolesBasedPermissionsInput = memo(
    React.forwardRef((props, ref) => {
        const { renderDefault, schemaType } = props;
        const { role } = useCurrentUser();

const options = useMemo(() => {
    return schemaType.of.map((option) => {
        return role !== 'administrator'
            ? { ...option, options: { ...option.options, disableNew: true } }
            : option;
    });
}, [schemaType.of, role]);

        return renderDefault({ ...props, schemaType: { ...schemaType, of: options } });
    })
);

export default RolesBasedPermissionsInput;
