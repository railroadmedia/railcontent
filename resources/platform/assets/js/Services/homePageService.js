// Sanity.io Service
import {fetchSanity} from "./sanityQueryService";

const token = 'skhignhoJViFp4dhFlyE72d7ShYmU9WdDkqJPqLI5jHi0h3FR6haWUnzGus37cpB6woqh4pkMt7qNzEFyPAzZTjOXTranUUF9YFBYBEHQkZREqydD2wVdCiCx96TRJBKCou6FwrO6lr7cA2qDHsxDJG6aHDAWKrbAxy9Humj92NObVzNOeyQ';
const projectId = '4032r8py'; // Your project ID
const dataset = 'staging'; // Your dataset name
const version = '2021-06-07'; // API version

export async function fetchWorkouts(brand) {
    const query = `*[_type == 'workout' && brand == '${brand}'] [0...5] {
          railcontent_id,
          title,
          "image": thumbnail.asset->url,
          "artist_name": artist->name,
          artist,
          difficulty,
          difficulty_string,
          web_url_path,
          published_on
        }`
    return fetchSanity(query);
}

export async function fetchNewReleases(brand) {
    //TODO: inject content type based on brand
    const query = `*[_type in ['song', 'live', 'workout'] && brand == '${brand}'] | order(releaseDate desc) [0...5] {
          railcontent_id,
          title,
          "image": thumbnail.asset->url,
          "artist_name": artist->name,
          artist,
          difficulty,
          difficulty_string,
          web_url_path,
          published_on
        }`
    return fetchSanity(query);
}

