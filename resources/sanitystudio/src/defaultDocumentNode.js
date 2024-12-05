// src/defaultDocumentNode.js

import { Iframe } from 'sanity-plugin-iframe-pane';

// Customise this function to show the correct URL based on the current document
// Customise this function to show the correct URL based on the current document
function getPreviewUrl(doc, dataset) {
    const sanityConfig = window.sanityConfig.find(item => item.name === 'publishing-workspace');
    const { appUrl } = sanityConfig;
    if (!doc) return `invalid_document`;
    const contentPath = doc.web_url_path;
    return contentPath
      ? `${appUrl}${contentPath}?sanityPreview`
      : `invalid_web_url_path`;
}

// Default Document Node Resolver
export const defaultDocumentNode = (S, { schemaType, documentId, dataset }) => {
    // Only show preview pane on `song` schema type documents
    console.log(S.document());
    switch (schemaType) {
        default: //enable for everything for now
        return S.document().views([
          S.view.form(),
          S.view
            .component(Iframe)
            .options({
              url: (doc) => getPreviewUrl(doc, dataset),
            })
            .title('Preview'),
        ]);
      //default:
        //return S.document().views([S.view.form()]);
    }
};
