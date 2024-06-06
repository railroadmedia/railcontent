import React from 'react';
import {useCallback, useMemo} from 'react'
import {useFormValue, NumberInputProps} from 'sanity'
import {Stack, TextInput, Grid, Button} from '@sanity/ui'
import {set, unset, useClient} from 'sanity'

const CustomInput = React.forwardRef((props, ref) => {
    const {schemaType, renderDefault, onChange, value = '', elementProps, document } = props
    const {validation = []} = schemaType
    const sanityClient = useClient({apiVersion: '2023-01-01'});
    const docId = String(useFormValue(["_id"]));
    const diff = [
        {id: '0', title: 'All'},
        {id: '1', title: 'Novice'},
        {id: '2', title: 'Beginner'},
        {id: '3', title: 'Beginner'},
        {id: '4', title: 'Intermediate'},
        {id: '5', title: 'Intermediate'},
        {id: '6', title: 'Advanced'},
        {id: '7', title: 'Advanced'},
        {id: '8', title: 'Expert'},
        {id: '9', title: 'Expert'},
        {id: '10', title: 'Expert'},
    ];

    // Creates a change handler for patching data
    const handleChange = useCallback(
        (event) => {
            if(event.target.id === 'difficulty') {
                const difficulty = diff.filter((element) => {
                     return element.id === event.target.value;
                    }
                );
                if (difficulty[0]) {
                    sanityClient
                        .patch(docId)
                        .set({
                            difficulty_string: difficulty[0] ? difficulty[0].title : '',
                        })
                        .commit()
                }
            }
            onChange(event.target.value ? set(event.target.value) : unset());
        },
        [onChange]
    );
    const range = useMemo(() => generateRange(validation), [validation])

    const handleDifficulty = useCallback(
        (event: MouseEvent<HTMLButtonElement>) => {
            const value = Number(event.currentTarget.value)
            console.log('difficulty', event, 'value',value)
            const difficulty = diff.filter((element) => {
                    return Number(element.id) === value;
                }
            );
            console.log('difficulty string', difficulty)
            if (difficulty[0]) {
                sanityClient
                    .patch(docId)
                    .set({
                        difficulty_string: difficulty[0] ? difficulty[0].title : '',
                    })
                    .commit()
            }
            onChange(set(value))
        },
        [onChange]
    )

    return (
//         <Stack space={3}>
//             <TextInput {...elementProps} onChange={handleChange} value={value} />
//         </Stack>
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
    )
});

export default CustomInput;

/**
 * Function that finds the `min` and `max` rules from validations,
 * and generates the range of numbers between them
 **/
function generateRange(validation: any[]) {
    const [min, max] = validation
        .reduce((acc, {_rules}) => {
            return [...acc, ..._rules]
        }, [])
        .filter((rule: any) => ['max', 'min'].includes(rule.flag))
        .map((rule: any) => rule.constraint)

    let range = []
    for (let i = min; i <= max; i++) {
        range.push(i)
    }

    return range
}

