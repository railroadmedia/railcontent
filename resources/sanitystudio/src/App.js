// src/App.js
import React, { useEffect, useState } from 'react';
import {RobotIcon, RocketIcon} from '@sanity/icons'
import { Studio, defineConfig } from 'sanity';
import { structureTool } from 'sanity/structure';
import { visionTool } from '@sanity/vision';
 import {openaiImageAsset} from 'sanity-plugin-asset-source-openai';
import {assist} from '@sanity/assist';
import DifficultyInput from './components/DifficultyInput'; // Import the custom component
import SoundsliceArrayInput from './components/SoundsliceArrayInput'; // Import the custom component
import SoundsliceSlugInput from './components/SoundsliceSlugInput'; // Import the custom component
import OpenAIFetchSongDetails from './components/OpenAIFetchSongDetails';
import RolesBasedPermissionsInput from './components/RolesBasedPermissionsInput';
import {CreateImprovedAction} from './actions/actions'; // Import the custom component
import { defaultDocumentNode } from './defaultDocumentNode';
import IsUniqueAcrossBrand from './components/IsUniqueAcrossBrand';

// You can add more custom components here as needed
const customComponents = {
    DifficultyInput: DifficultyInput,
    SoundsliceArrayInput: SoundsliceArrayInput,
    SoundsliceSlugInput: SoundsliceSlugInput,
    RolesBasedPermissionsInput: RolesBasedPermissionsInput,
    IsUniqueAcrossBrand: IsUniqueAcrossBrand,
    OpenAIFetchSongDetails: OpenAIFetchSongDetails,
};

const icons = {
    RobotIcon: RobotIcon,
    RocketIcon: RocketIcon,
};

// Helper function to map components
const mapComponents = (fields) => {
    return fields.map((field) => {
        // Map components at the field level if they exist in options
        if (field.options) {
            const { isUnique } = field.options;
            if (isUnique) {
                field = {
                    ...field,
                    options: {
                        ...field.options,
                        isUnique: customComponents[isUnique]
                    }
                };
            }
        }
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
    const [config, setConfigs] = useState(null);

    useEffect(() => {
        const loadConfigs = () => {
            const workspaceConfigs = window.sanityConfig.map((config, index) => {
                return defineConfig({
                    ...config,
                    name: config.name,
                    title: config.title,
                    icon: icons[config.icon] ? icons[config.icon] : null,
                    plugins: [
                      structureTool({ defaultDocumentNode }),
                      visionTool(),
                        openaiImageAsset({
                            API_KEY:"sk-proj-67J17Z91oSK5uJ36y8RyT3BlbkFJ4LzgX2eNYY2q3jx7rk94"
                        }),
                        assist(),
                    ],
                    document: {
                        actions: (prev) =>
                            prev.map((previousAction) =>
                                previousAction.action === 'publish' ? CreateImprovedAction(previousAction, config.csrfToken) : previousAction
                            ),
                    },
                    schema: {
                        types: config.schema.types.map((type) => {
                            return {
                                ...type,
                                fields: mapComponents(type.fields)
                            };
                        })
                    }
                });
            });
            setConfigs(workspaceConfigs);
        };

        if (!window.sanityConfig || !Array.isArray(window.sanityConfig)) {
            console.error('Sanity configuration not found or is not an array in the window object.');
        } else {
            loadConfigs();
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
