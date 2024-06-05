// src/App.js
import React, { useEffect, useState } from 'react';
import { Studio, defineConfig } from 'sanity';
import { structureTool } from 'sanity/structure';
import { visionTool } from '@sanity/vision'

function App() {
  const [config, setConfig] = useState(null);

  useEffect(() => {
    const loadConfig = () => {
      const clientConfig = {
        ...window.sanityConfig,
        plugins: [
          structureTool(),
          visionTool()
        ]
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
