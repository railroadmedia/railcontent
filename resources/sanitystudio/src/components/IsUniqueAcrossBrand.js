// eslint-disable-next-line no-unused-vars
import React, { useEffect } from 'react';

export default async function IsUniqueAcrossBrand(slug, context) {
    const { document, getClient } = context;
    const client = getClient({ apiVersion: '2022-12-07' });
    let clean_id = document._id.replace(/^drafts\./, '');

    const params = {
        type: document._type,
        id: clean_id,
        draft_id: 'drafts.'+ clean_id,
        slug,
    };
    // Construct the query based on the presence of the brand field
    let query = `*[_type == $type && slug.current == $slug && !(_id in [$id, $draft_id])]`;
    if (document.parent_type) {
        params.type = document.parent_type;
        query = `*[_type == $type && ($id in child[]._ref)  && $slug in child[]->slug.current && !(child[]->_id in [$id, $draft_id])]{
           child[]->{'exists':_id != $id && slug.current == $slug}
        }`;
    } else if (document.brand) {
        params.brand = document.brand;
        query = `*[_type == $type && brand == $brand && slug.current == $slug && !(_id in [$id, $draft_id])]`;
    }
    const documents = await client.fetch(query, params);
    if (document.parent_type) {
        const isSlugUnique = !documents.some(doc =>
            doc.child.some(child => child.exists === true)
        );
        return isSlugUnique;
    }
    // Returns true if no documents are found, false otherwise
    return documents.length === 0;
};




