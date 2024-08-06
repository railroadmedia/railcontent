// Sanity.io Service
const token = 'skhignhoJViFp4dhFlyE72d7ShYmU9WdDkqJPqLI5jHi0h3FR6haWUnzGus37cpB6woqh4pkMt7qNzEFyPAzZTjOXTranUUF9YFBYBEHQkZREqydD2wVdCiCx96TRJBKCou6FwrO6lr7cA2qDHsxDJG6aHDAWKrbAxy9Humj92NObVzNOeyQ';
const projectId = '4032r8py'; // Your project ID
const dataset = 'staging'; // Your dataset name
const version = '2021-06-07'; // API version


// Fetch a Song by ID
export async function fetchSanity(query) {
  console.log("fetchSanity Query:", query);
  const encodedQuery = encodeURIComponent(query);
  const url = `https://${projectId}.apicdn.sanity.io/v${version}/data/query/${dataset}?query=${encodedQuery}`;
  const headers = {
    'Authorization': `Bearer ${token}`,
    'Content-Type': 'application/json'
  };

  try {
    const response = await fetch(url, { headers });
    const result = await response.json();
    if (result.result && result.result.length > 0) {
        console.log("fetchSanity Results:", result.result);

        return result.result[0];
    } else {
      throw new Error('No results found');
    }
  } catch (error) {
    console.error('sanityQueryService: Fetch error:', error);
    return null;
  }
}
