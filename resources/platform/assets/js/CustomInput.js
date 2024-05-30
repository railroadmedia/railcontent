import React from 'react';

const CustomInput = React.forwardRef((props, ref) => {
    return (
        <div>
            <label>{props.type.title}</label>
            <input
                ref={ref}
                type="text"
                value={props.value || ''}
                onChange={(event) => props.onChange(event.target.value)}
            />
        </div>
    );
});

export default CustomInput;
