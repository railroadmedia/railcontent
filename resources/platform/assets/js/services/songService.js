// Sanity.io Service
const token = 'skhignhoJViFp4dhFlyE72d7ShYmU9WdDkqJPqLI5jHi0h3FR6haWUnzGus37cpB6woqh4pkMt7qNzEFyPAzZTjOXTranUUF9YFBYBEHQkZREqydD2wVdCiCx96TRJBKCou6FwrO6lr7cA2qDHsxDJG6aHDAWKrbAxy9Humj92NObVzNOeyQ';

// Song
export async function fetchSongById(documentId, fields) {
  const projectId = '4032r8py'; // Your project ID
  const dataset = 'production'; // Your dataset name
  const version = '2021-06-07'; // API version

  // Ensure fields is an array
  if (!Array.isArray(fields)) {
    throw new Error('fields must be an array');
  }

  // Build the query with nested field selection
  const query = `
    *[_type == "song" && railcontent_id == ${documentId}]{
      ${fields.join(', ')}
    }`;

  // Log the query string before encoding
  console.log("Generated GROQ Query:", query);

  const encodedQuery = encodeURIComponent(query);
  const url = `https://${projectId}.api.sanity.io/v${version}/data/query/${dataset}?query=${encodedQuery}`;

  const headers = {
    'Authorization': `Bearer ${token}`, // Add the token to the Authorization header
    'Content-Type': 'application/json'
  };

  try {
    const response = await fetch(url, { headers });
    const result = await response.json();
    if (result.result && result.result.length > 0) {
      return result.result[0]; // Return the first result
    } else {
      throw new Error('No song found');
    }
  } catch (error) {
    console.error('Fetch error:', error);
    return null; // Return null if there's an error
  }
}
