// src/defaultDocumentNode.js

import { Iframe } from 'sanity-plugin-iframe-pane';

// Customise this function to show the correct URL based on the current document
// Customise this function to show the correct URL based on the current document
function getPreviewUrl(doc, dataset) {
    if (!doc) return `https://${getBaseUrl(dataset)}/drumeo/`;

    const contentName = doc.slug?.current;
    let contentId = doc._id;
    let brand = doc.brand || 'drumeo';
    let contentType = doc._type;

    // Remove the 'song_' prefix from the contentId
    if (contentId.startsWith('song_')) {
      contentId = contentId.replace('song_', '');
    }
  
    // Handle draft documents
    if (contentId.startsWith('drafts.')) {
      contentId = contentId.replace('drafts.', '');
      return contentName && contentId
        ? `https://${getBaseUrl(dataset)}/${brand}/${contentType}s/${contentName}/${contentId}`
        : `https://${getBaseUrl(dataset)}/${brand}/`;
    }
  
    return contentName && contentId
      ? `https://${getBaseUrl(dataset)}/${brand}/${contentType}s/${contentName}/${contentId}`
      : `https://${getBaseUrl(dataset)}/${brand}/`;
}

function getBaseUrl(dataset) {
    switch (dataset) {
      case 'production':
        return 'musora.com';
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