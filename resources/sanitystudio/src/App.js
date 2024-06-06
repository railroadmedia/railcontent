// src/App.js
import React, { useEffect, useState } from 'react';
import { Studio, defineConfig } from 'sanity';
import { structureTool } from 'sanity/structure';
import { visionTool } from '@sanity/vision';
import CustomInput from './components/CustomInput'; // Import the custom component
import ArrayInput from './components/ArrayInput'; // Import the custom component

// You can add more custom components here as needed
const customComponents = {
  CustomInput: CustomInput,
    ArrayInput: ArrayInput
};

function App() {
  const [config, setConfig] = useState(null);

  useEffect(() => {
    const loadConfig = () => {
      const clientConfig = {
        ...window.sanityConfig,
        plugins: [
          structureTool(),
          visionTool()
        ],
        schema: {
          types: window.sanityConfig.schema.types.map((type) => {
            return {
              ...type,
              fields: type.fields.map((field) => {
                if (field.components) {
                  return {
                    ...field,
                    components: Object.keys(field.components).reduce((acc, key) => {
                      if (customComponents[field.components[key]]) {
                        acc[key] = customComponents[field.components[key]];
                      }
                      return acc;
                    }, {})
                  };
                }
                return field;
              })
            };
          })
        }
      };
      setConfig(defineConfig(clientConfig));
    };

    if (!window.sanityConfig) {
      console.error('Sanity configuration not found in window object.');
    } else {
      loadConfig();
    }
  }, []);

  if (!config) {
    return <div>Loading...</div>;
  }

  return (
    <Studio config={config} />
  );
}

export default App;
