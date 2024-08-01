// src/defaultDocumentNode.js

import { Iframe } from 'sanity-plugin-iframe-pane';

// Customise this function to show the correct URL based on the current document
// Customise this function to show the correct URL based on the current document
function getPreviewUrl(doc, dataset) {
    if (!doc) return `https://${getBaseUrl(dataset)}/drumeo/`;
    console.log(doc);

    const contentPath = doc.web_url_path;
    let contentId = doc._id;
    let brand = doc.brand || 'drumeo';

    // Remove the 'song_' prefix from the contentId
    if (contentId.startsWith('song_')) {
      contentId = contentId.replace('song_', '');
    }
  
    // Handle draft documents
    if (contentId.startsWith('drafts.')) {
      contentId = contentId.replace('drafts.', '');
      return contentPath && contentId
        ? `https://${getBaseUrl(dataset)}${contentPath}`
        : `https://${getBaseUrl(dataset)}/${brand}/`;
    }
  
    return contentPath && contentId
      ? `https://${getBaseUrl(dataset)}${contentPath}`
      : `https://${getBaseUrl(dataset)}/${brand}/`;
}

function getBaseUrl(dataset) {
    switch (dataset) {
      case 'production':
        return 'web-staging-five.musora.com' //Set To WS5 for now
      default:
        return 'beta-testing.musora.com';
    }
}

// Default Document Node Resolver
export const defaultDocumentNode = (S, { schemaType, documentId, dataset }) => {
    // Only show preview pane on `song` schema type documents
    switch (schemaType) {
      case `song`:
        return S.document().views([
          S.view.form(),
          S.view
            .component(Iframe)
            .options({
              url: (doc) => getPreviewUrl(doc, dataset),
            })
            .title('Preview'),
        ]);
      default:
        return S.document().views([S.view.form()]);
    }
};