import React from 'react';
import { renderStudio, defineConfig } from "sanity";
import {structureTool} from 'sanity/structure'
import  CustomInput from '../components/CustomInput' ;
import  ArrayInput from '../components/ArrayInput' ;

const SanityStudio = ({ projectId, dataset, basePath, schema }) => {
  const sanityContainerRef = React.useRef(null);  // Create a ref for the Sanity container

  React.useEffect(() => {
    if (sanityContainerRef.current) {
        console.log('roxana schema   ',schema);
      const config = defineConfig({
            plugins: [
                structureTool()
            ],
            projectId: projectId,
            dataset: dataset,
            basePath: basePath,
            schema: schema
//             schema: {
//                 types: [
//                     {
//                         type: "document",
//                         name: "rox",
//                         title: "Post",
//                         fields: [
//                             {
//                                 type: "string",
//                                 name: "title",
//                                 title: "Title"
//                             },
//
//                             {
//                                 name: 'difficulty',
//                                 title: 'Difficulty',
//                                 type: 'string',
//                                 components: {
//                                     input: CustomInput
//                                 }
//                             },
//                             {
//                                 type: "string",
//                                 name: "difficult",
//                                 title: "Difficulty String"
//                             },
//                             {
//                                 name: 'soundslice',
//                                 title: 'Soundslice',
//                                 type: 'array',
//                                 of: [
//                                     {
//                                         type: 'object',
//                                         fields: [
//                                             {
//                                                 title: 'Title',
//                                                 name: 'title',
//                                                 type: 'string'
//                                             },
//                                         ]
//                                     }
//                                 ],
//                                 components: {
//                                     input: ArrayInput
//                                 }
//                             }
//                         ]
//                     }
//                 ]
//             }
        });
        renderStudio(sanityContainerRef.current, config);  // Render Sanity Studio into the ref'd container
    }
  }, [projectId, dataset, basePath, schema]); // Depend on props to re-render

  return <div ref={sanityContainerRef}></div>;  // Assign the ref to a div dedicated to Sanity
};

export default SanityStudio;
