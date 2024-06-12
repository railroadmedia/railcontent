import React, { useCallback, useMemo } from 'react';
import { useFormValue, set, useClient } from 'sanity';
import { Grid, Button } from '@sanity/ui';

const CustomInput = React.forwardRef((props, ref) => {
    const { schemaType, onChange, value = '', elementProps } = props;
    const { validation = [] } = schemaType;
    const sanityClient = useClient({ apiVersion: '2023-01-01' });

    const docId = String(useFormValue(["_id"]));
    const patch = sanityClient.patch( docId);

    const diff = [
        { id: '0', title: 'All' },
        { id: '1', title: 'Novice' },
        { id: '2', title: 'Beginner' },
        { id: '3', title: 'Beginner' },
        { id: '4', title: 'Intermediate' },
        { id: '5', title: 'Intermediate' },
        { id: '6', title: 'Advanced' },
        { id: '7', title: 'Advanced' },
        { id: '8', title: 'Expert' },
        { id: '9', title: 'Expert' },
        { id: '10', title: 'Expert' },
    ];

    const range = useMemo(() => generateRange(validation), [validation]);

    const handleDifficulty = useCallback(
        (event) => {
            const value = Number(event.currentTarget.value);
            const difficulty = diff.find(element => Number(element.id) === value);
            if (difficulty) {
                patch.set({ difficulty_string: difficulty.title }).commit().catch(console.error);
            }
            onChange(set(value));
        },
        [onChange, patch, diff]
    );

    return (
        <Grid columns={range.length} gap={1}>
            {range.map((index) => (
                <Button
                    key={index}
                    mode={value === index ? 'default' : 'ghost'}
                    tone={value === index ? 'primary' : 'default'}
                    text={index.toString()}
                    value={index}
                    onClick={handleDifficulty}
                />
            ))}
        </Grid>
    );
});

export default CustomInput;

function generateRange(validation) {
    const [min, max] = validation
        .reduce((acc, { _rules }) => [...acc, ..._rules], [])
        .filter((rule) => ['max', 'min'].includes(rule.flag))
        .map((rule) => rule.constraint);

    const range = [];
    for (let i = min; i <= max; i++) {
        range.push(i);
    }
    return range;
}
