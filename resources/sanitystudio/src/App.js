// src/App.js
import React, { useEffect, useState } from 'react';
import { Studio, defineConfig } from 'sanity';
import { structureTool } from 'sanity/structure';
import { visionTool } from '@sanity/vision';
import DifficultyInput from './components/DifficultyInput'; // Import the custom component
import SoundsliceArrayInput from './components/SoundsliceArrayInput'; // Import the custom component
import SoundsliceSlugInput from './components/SoundsliceSlugInput'; // Import the custom component
import RolesBasedPermissionsInput from './components/RolesBasedPermissionsInput';
import {CreateImprovedAction} from './actions/actions'; // Import the custom component

// You can add more custom components here as needed
const customComponents = {
    DifficultyInput: DifficultyInput,
    SoundsliceArrayInput: SoundsliceArrayInput,
    SoundsliceSlugInput: SoundsliceSlugInput,
    RolesBasedPermissionsInput: RolesBasedPermissionsInput
};

// Helper function to map components
const mapComponents = (fields) => {
    return fields.map((field) => {
        // Map components at the field level
        if (field.components) {
            field = {
                ...field,
                components: Object.keys(field.components).reduce((acc, key) => {
                    const componentKey = field.components[key];
                    if (customComponents[componentKey]) {
                        acc[key] = customComponents[componentKey];
                    }
                    return acc;
                }, {})
            };
        }

        // Map components in nested fields within 'of'
        if (field.of) {
            field = {
                ...field,
                of: field.of.map((ofField) => {
                    if (ofField.fields) {
                        ofField = {
                            ...ofField,
                            fields: mapComponents(ofField.fields)
                        };
                    }
                    return ofField;
                })
            };
        }

        return field;
    });
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
          document: {
              actions: (prev) =>
                           prev.map((previousAction) =>
                               previousAction.action === 'publish' ? CreateImprovedAction(previousAction, window.sanityConfig.csrfToken) : previousAction
                           ),
          },
        schema: {
          types: window.sanityConfig.schema.types.map((type) => {
            return {
              ...type,
                fields: mapComponents(type.fields)
            };
          })
        }
      };
      console.log('schema',clientConfig)
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
