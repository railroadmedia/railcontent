import React from 'react';
import { renderStudio, defineConfig } from "sanity";
import {structureTool} from 'sanity/structure'
import CustomInput from '../components/CustomInput';  

const SanityStudio = ({ projectId, dataset, basePath }) => {
  const sanityContainerRef = React.useRef(null);  // Create a ref for the Sanity container

  React.useEffect(() => {
    if (sanityContainerRef.current) {
      const config = defineConfig({
            plugins: [
                structureTool()
            ],
            projectId: projectId,
            dataset: dataset,
            basePath: basePath,
            schema: {
                types: [
                    {
                        type: "document",
                        name: "post",
                        title: "Post",
                        fields: [
                            {
                                type: "string",
                                name: "title",
                                title: "Title"
                            },
                            {
                                name: 'myCustomField',
                                title: 'My Custom Field',
                                type: 'string',
                                inputComponent: CustomInput
                            }
                        ]
                    }
                ]
            }
        });
        renderStudio(sanityContainerRef.current, config);  // Render Sanity Studio into the ref'd container
    }
  }, [projectId, dataset, basePath]); // Depend on props to re-render

  return <div ref={sanityContainerRef}></div>;  // Assign the ref to a div dedicated to Sanity
};

export default SanityStudio;
