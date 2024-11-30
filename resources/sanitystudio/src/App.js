// src/App.js
import React, {useEffect, useState} from 'react';
import {RobotIcon, RocketIcon} from '@sanity/icons'
import {defineConfig, Studio} from 'sanity';
import {structureTool} from 'sanity/structure';
import {visionTool} from '@sanity/vision';
import {assist} from '@sanity/assist';
import {embeddingsIndexDashboard, embeddingsIndexReferenceInput} from '@sanity/embeddings-index-ui'

import DifficultyInput from './components/DifficultyInput'; // Import the custom component
import SoundsliceArrayInput from './components/SoundsliceArrayInput'; // Import the custom component
import SoundsliceSlugInput from './components/SoundsliceSlugInput'; // Import the custom component
import RolesBasedPermissionsInput from './components/RolesBasedPermissionsInput';
import OpenAiInput from './components/OpenAiInput'; // Import the custom component
import XpInput from './components/XpInput'; // Import the custom component
import {CreateImprovedAction, CreateDuplicateAction} from './actions/actions'; // Import the custom component
import {defaultDocumentNode} from './defaultDocumentNode';
import {musoraStructure} from './musoraStructure';
import IsUniqueAcrossBrand from './components/IsUniqueAcrossBrand';
import {media} from 'sanity-plugin-media';
import VimeoVideoInput from "./components/VimeoVideoInput"; // You can add more custom components here as needed

// You can add more custom components here as needed
const customComponents = {
    DifficultyInput: DifficultyInput,
    SoundsliceArrayInput: SoundsliceArrayInput,
    SoundsliceSlugInput: SoundsliceSlugInput,
    RolesBasedPermissionsInput: RolesBasedPermissionsInput,
    IsUniqueAcrossBrand: IsUniqueAcrossBrand,
    OpenAiInput: OpenAiInput,
    VimeoVideoInput: VimeoVideoInput,
    XpInput: XpInput
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
        if (field.fields) {
            field = {
                ...field,
                fields: mapComponents(field.fields)
            };
        }


        return field;
    });
};

function App() {
    const [config, setConfigs] = useState(null);
    // Define the singleton document types
    const singletonTypes = new Set([ 'foundation']);

    // Define the actions that should be available for singleton documents
    const singletonActions = new Set(["publish", "discardChanges", "restore"]);


    useEffect(() => {
        const loadConfigs = () => {
            const workspaceConfigs = window.sanityConfig.map((config, index) => {
                return defineConfig({
                    ...config,
                    name: config.name,
                    title: config.title,
                    icon: icons[config.icon] ? icons[config.icon] : null,
                    plugins: [
                        structureTool({
                            structure: musoraStructure,
                            defaultDocumentNode: defaultDocumentNode }),
                        media(),
                        assist(),
                        visionTool(),
                        embeddingsIndexReferenceInput(),
                        embeddingsIndexDashboard(),
                    ],
                    // TODO Removed with upgrade to PHP 8.3 React doesn't like the object return
                    // tools: (prev, {currentUser}) => {
                    //     if (currentUser.roles.find((r) => r.name === 'administrator' || r.name === 'developer')) {
                    //         return [
                    //             ...prev,
                    //             {name: 'vision', title: 'Vision', component: visionTool},
                    //             {name: 'embeddings', title: 'Embeddings', component: embeddingsIndexReferenceInput},
                    //             {name: 'embeddings-dashboard', title: 'Embeddings Dashboard', component: embeddingsIndexDashboard},
                    //         ]
                    //     }
                    //     return prev;
                    // },
                    schema: {
                        types: config.schema.types.map((type) => {
                            return {
                                ...type,
                                fields: mapComponents(type.fields)
                            };
                        }),
                        templates: (templates) =>
                                       templates.filter(({ schemaType }) => !singletonTypes.has(schemaType)),
                    },
                    document: {
                        // For singleton types, filter out actions that are not explicitly included
                        // in the `singletonActions` list defined above
                        actions: (input, context) =>
                                     singletonTypes.has(context.schemaType)
                                         ? input.filter(({ action }) => action && singletonActions.has(action))
                                         : input.map(function(previousAction){
                                             switch(previousAction.action){
                                                 case "publish": return CreateImprovedAction(previousAction, config.csrfToken, context);
                                                 case "duplicate": return CreateDuplicateAction(previousAction);
                                                 default: return previousAction;
                                             }
                                         }),
                    },
                    form: {
                        components: {
                            input: (props) => {
                                if (Array.isArray(props.groups) && props.groups.length > 0) {
                                    if (props.groups[0].name === 'all-fields') {
                                        props.groups.shift()
                                    }
                                }
                                return props.renderDefault(props)
                            },
                        },
                    },
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
