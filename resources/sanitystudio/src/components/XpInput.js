import React, { useCallback, useEffect, useState } from 'react';
import { useClient, useFormValue } from 'sanity';
import { Stack, TextInput, Spinner, Box } from '@sanity/ui';

const calculateXP = async ({ type, difficulty, childrenRefs = [], assignment = [] }, sanityClient, parentDocId) => {
    const specialXP = [
        { type: 'pack', value: 5000 },
        { type: 'pack-bundle', value: 500 },
        { type: 'unit', value: 1000 },
        { type: 'learning-path', value: 5000 },
        { type: 'learning-path-level', value: 1000 },
        { type: 'learning-path-course', value: 500 },
        { type: 'learning-path-lesson', value: 150 },
        { type: 'course', value: 500 },
        { type: 'song', value: 150 },
    ];

    const difficultyXP = [
        { id: '1', value: 100 },
        { id: '2', value: 100 },
        { id: '3', value: 100 },
        { id: '4', value: 150 },
        { id: '5', value: 150 },
        { id: '6', value: 150 },
        { id: '7', value: 200 },
        { id: '8', value: 200 },
        { id: '9', value: 200 },
        { id: '10', value: 200 },
    ];

    const defaultXPperType = specialXP.find(element => element.type === type);
    const difficultyDefaultXP = difficultyXP.find(element => element.id === String(difficulty));

    let baseXp = (defaultXPperType?.value ?? difficultyDefaultXP?.value) || 0;

    try {
        // Fetch the child documents based on references
        const childDocuments = await sanityClient.fetch(`*[_id in $ids]`, {
            ids: childrenRefs
        });

        console.log('Child Documents:', childrenRefs, childDocuments);

        // Calculate XP for each child document
        const childrenXp = await Promise.all(childDocuments.map(async (child) => {
            const childId = child._id.startsWith('drafts.') ? child._id : `drafts.${child._id}`;
            let childTotalXp = child.total_xp || 0;

            if (!childTotalXp) {
                // If total_xp is not set, recursively calculate it
                childTotalXp = await calculateXP({
                    type: child._type,
                    difficulty: child.difficulty,
                    childrenRefs: child.child || [], // Ensure to fetch references of the child
                    assignment: child.assignment || [],
                }, sanityClient, child._id);

                // Now patch the existing document with the calculated total_xp
                await sanityClient.patch(child._id).set({ total_xp: childTotalXp }).commit().catch(console.error);
            } else {
                childTotalXp = Number(childTotalXp) || 0; // Ensure it's a number
            }

            return childTotalXp || 0; // Return calculated XP for this child
        }));

        const assignmentsXp = assignment.length * 25; // Calculate XP for assignments

        // Calculate total XP
        const totalXp = baseXp + childrenXp.reduce((acc, xp) => acc + xp, 0) + assignmentsXp;

        console.log('Calculated XP:', { baseXp, childrenXp, assignmentsXp, totalXp });
        return totalXp; // Return the total XP
    } catch (error) {
        console.error("Error calculating XP:", error);
        return 0; // Fallback in case of error
    }
}

const XpInput = React.forwardRef((props, ref) => {
    const { schemaType, onChange, value = '', elementProps } = props;
    const sanityClient = useClient({ apiVersion: '2023-01-01' });

    const docId = String(useFormValue(["_id"]));
    const type = String(useFormValue(["_type"]));
    const difficulty = useFormValue(["difficulty"]);
    const xp = useFormValue(["xp"]);
    const children = useFormValue(["child"]);
    const assignment = useFormValue(["assignment"]);

    const [calculatedXp, setCalculatedXp] = useState(xp || 0);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(() => {
        const calculateAndSetXp = async () => {
            setLoading(true);
            setError(null); // Reset error state
            const parentId = docId;
                //docId.startsWith('drafts.') ? docId : `drafts.${docId}`;

            // Extract the _ref from each child object
            const childrenRefs = children ? children.map(child => child._ref).filter(Boolean) : [];
            console.log('XpInput child:', children, childrenRefs);

            try {
                const newTotalXp = await calculateXP({
                    type,
                    difficulty,
                    childrenRefs,
                    assignment,
                }, sanityClient, parentId);

                if (parentId && parentId !== "undefined") {
                    if (newTotalXp !== calculatedXp) {
                        setCalculatedXp(newTotalXp);
//TODO: uncomment when the tests are ready
//                         await sanityClient.patch(parentId)
//                             .set({ total_xp: newTotalXp })
//                             .commit();
                    }
                } else {
                    console.error("Invalid Document ID:", docId);
                }
            } catch (error) {
                console.error("Error in calculateAndSetXp:", error);
                setError("Failed to calculate XP.");
            } finally {
                setLoading(false);
            }
        };

        calculateAndSetXp();
    }, [type, difficulty, children, assignment, xp, calculatedXp, docId, sanityClient]);

    const handleChange = useCallback((event) => {
        const inputValue = event.currentTarget.value;
        onChange(inputValue);
    }, [onChange]);

    return (
        <Stack space={3}>
            {loading && (
                <Box>
                    <Spinner />
                </Box>
            )}
            {error && (
                <Box style={{ color: 'red' }}>{error}</Box>
            )}
            <TextInput
                {...elementProps}
                onChange={handleChange}
                value={value}
                ref={ref}
                readOnly={loading} // Disable input while loading
            />
            {!loading && <div>Calculated XP: {calculatedXp}</div>}
        </Stack>
    );
});

export default XpInput;
