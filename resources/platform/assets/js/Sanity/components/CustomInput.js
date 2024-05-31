import React from 'react';

const CustomInput = React.forwardRef((props, ref) => {
    const title = props.type?.title || 'Default Title';

    return (
        <div>
            <label>{title}</label>
            <input
                ref={ref}
                type="text"
                value={props.value || ''}
                onChange={(event) => props.onChange(event.target.value)}
            />
        </div>
    );
});

window.CustomInput = CustomInput;