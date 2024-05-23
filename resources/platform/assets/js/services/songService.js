// Sanity.io Service

//Song
export async function fetchSongById(documentId, fields) {
  const projectId = '4032r8py'; // Your project ID
  const dataset = 'production'; // Your dataset name
  const version = '2021-06-07'; // API version

  // Build the query with nested field selection
  const query = `
    *[_id == '${documentId}']{
      ${fields.join(', ')}
    }`;

  // Log the query string before encoding
  console.log("Generated GROQ Query:", query);

  const encodedQuery = encodeURIComponent(query);
  const url = `https://${projectId}.api.sanity.io/v${version}/data/query/${dataset}?query=${encodedQuery}`;

  try {
    const response = await fetch(url);
    const result = await response.json();
    return result.result; // Sanity's API returns the data under the "result" key
  } catch (error) {
    console.error('Fetch error:', error);
    return [];
  }
}
