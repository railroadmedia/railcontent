// Sanity.io Service
const token = 'skhignhoJViFp4dhFlyE72d7ShYmU9WdDkqJPqLI5jHi0h3FR6haWUnzGus37cpB6woqh4pkMt7qNzEFyPAzZTjOXTranUUF9YFBYBEHQkZREqydD2wVdCiCx96TRJBKCou6FwrO6lr7cA2qDHsxDJG6aHDAWKrbAxy9Humj92NObVzNOeyQ';
const projectId = '4032r8py'; // Your project ID
const dataset = 'production'; // Your dataset name
const version = '2021-06-07'; // API version


// Fetch a Song by ID
export async function fetchSongById(documentId, fields) {
  if (!Array.isArray(fields)) {
    throw new Error('fields must be an array');
  }

  const query = `
    *[_type == "song" && railcontent_id == ${documentId}]{
      ${fields.join(', ')}
    }`;

  console.log("Generated GROQ Query:", query);

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
      return result.result[0];
    } else {
      throw new Error('No song found');
    }
  } catch (error) {
    console.error('Fetch error:', error);
    return null;
  }
}

// Fetch Artists
export async function fetchArtists(brand) {
  const query = `
    *[_type == "artist"]{
      name,
      "lessonsCount": count(*[_type == "song" && brand == "${brand}" && references(^._id)])
    }[lessonsCount > 0]
  `;

  //console.log("Generated GROQ Query:", query);

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
      return result.result;
    } else {
      throw new Error('No artists found');
    }
  } catch (error) {
    console.error('Fetch error:', error);
    return null;
  }
}

// Fetch Related Songs
export async function fetchRelatedSongs(brand, songId) {
  const query = `
    *[_type == "song" && railcontent_id == ${songId}]{
      ...,
      "relatedLessons": array::unique([
        ...(*[_type == "song" && brand == "${brand}" && railcontent_id != ${songId} && references(^.artist->_id)]{
          _id, 
          title, 
          railcontent_id, 
          web_url_path, 
          difficulty, 
          difficulty_string,
          "thumb": thumbnail.asset->url, 
          "length": soundslice[0].soundslice_length_in_second, 
          artist->
        }[0...10]),
        ...(*[_type == "song" && brand == "${brand}" && railcontent_id != ${songId} && references(^.genre[]->_id)]{
          _id, 
          title, 
          railcontent_id, 
          web_url_path, 
          difficulty, 
          difficulty_string,
          "thumb": thumbnail.asset->url, 
          "length": soundslice[0].soundslice_length_in_second, 
          artist->
        }[0...10])
      ])[0...10]
    }
  `;

  //console.log("Generated GROQ Query:", query);

  const encodedQuery = encodeURIComponent(query);
  const url = `https://${projectId}.api.sanity.io/v${version}/data/query/${dataset}?query=${encodedQuery}`;

  const headers = {
    'Authorization': `Bearer ${token}`,
    'Content-Type': 'application/json'
  };

  try {
    const response = await fetch(url, { headers });
    const result = await response.json();
    if (result.result && result.result.length > 0) {
      return result.result[0];
    } else {
      throw new Error('No related songs found');
    }
  } catch (error) {
    console.error('Fetch error:', error);
    return null;
  }
}

// Fetch All Songs for a Brand with Pagination and Search
export async function fetchAllSongs(brand, page = 1, limit = 10, searchTerm = "", sort = "-published_on", includedFields = [], groupBy = "") {
  console.log('groupBy', groupBy)
  const start = (page - 1) * limit;
  const end = start + limit;

  // Construct the search filter
  const searchFilter = searchTerm
    ? `&& (artist->name match "${searchTerm}*" || title match "${searchTerm}*")`
    : "";

  // Construct the included fields filter, replacing 'difficulty' with 'difficulty_string'
  const includedFieldsFilter = includedFields.length > 0
    ? includedFields.map(field => {
        let [key, value] = field.split(',');
        if (key === 'difficulty') {
          key = 'difficulty_string';
        }
        return `&& ${key} == "${value}"`;
      }).join(' ')
    : "";

  // Determine the sort order
  let sortOrder;
  switch (sort) {
    case "slug":
      sortOrder = "artist->name asc";
      break;
    case "published_on":
      sortOrder = "published_on desc";
      break;
    case "-published_on":
      sortOrder = "published_on asc";
      break;
    case "-slug":
      sortOrder = "artist->name desc";
      break;
    case "-popularity":
      sortOrder = "popularity desc";
      break;
    default:
      sortOrder = "published_on asc";
      break;
  }

  // Determine the group by clause
  let groupQuery = "";
  if (groupBy === "artist") {
    groupQuery = `
      {
        "total": count(*[_type == 'artist' && count(*[_type == 'song' && brand == '${brand}' && ^._id == artist._ref ]._id) > 0]),
        "entity": *[_type == 'artist' && count(*[_type == 'song' && brand == '${brand}' && ^._id == artist._ref ]._id) > 0]
          { 
            'id': _id, 
            'type': _type, 
            name, 
            'head_shot_picture_url': thumbnail_url.asset->url, 
            'all_lessons_count': count(*[_type == 'song' && brand == '${brand}' && ^._id == artist._ref ]._id),
            'lessons': *[_type == 'song' && brand == '${brand}' && ^._id == artist._ref ]{ 
              railcontent_id,
              title,
              "image": thumbnail.asset->url,
              "artist_name": artist->name,
              artist,
              difficulty,
              difficulty_string,
              web_url_path,
              published_on
            }[0...10]
          }
        |order(${sortOrder})
        [${start}...${end}]
      }`;
  } else if (groupBy === "genre") {
    groupQuery = `
      {
        "total": count(*[_type == 'genre'  && count(*[_type == 'song' && brand == '${brand}' && ^._id in genre[]._ref ]._id) > 0]),
        "entity": 
          *[_type == 'genre'  && count(*[_type == 'song' && brand == '${brand}' && ^._id in genre[]._ref ]._id)>0]
          { 
            'id': _id, 
            'type': _type, 
            name, 
            'head_shot_picture_url': thumbnail_url.asset->url,
            'all_lessons_count': count(*[_type == 'song' && brand == '${brand}' && ^._id in genre[]._ref ]._id),
            'lessons': *[_type == 'song' && brand == '${brand}' && ^._id in genre[]._ref ]{ 
              railcontent_id,
              title,
              "image": thumbnail.asset->url,
              "artist_name": artist->name,
              artist,
              difficulty,
              difficulty_string,
              web_url_path,
              published_on
            }[0...10]
          }
        |order(${sortOrder})
        [${start}...${end}]
      }`;
  } else {
    groupQuery = `
      {
        "entity": *[_type == 'song' && brand == "${brand}" ${searchFilter} ${includedFieldsFilter}] | order(${sortOrder}) [${start}...${end}] {
          railcontent_id,
          title,
          "image": thumbnail.asset->url,
          "artist_name": artist->name,
          artist,
          difficulty,
          difficulty_string,
          web_url_path,
          published_on
        },
        "total": count(*[_type == 'song' && brand == "${brand}" ${searchFilter} ${includedFieldsFilter}])
      }
    `;
  }

  console.log("Generated GROQ Query:", groupQuery);

  const encodedQuery = encodeURIComponent(groupQuery);
  const url = `https://${projectId}.api.sanity.io/v${version}/data/query/${dataset}?query=${encodedQuery}`;

  const headers = {
    'Authorization': `Bearer ${token}`,
    'Content-Type': 'application/json'
  };

  try {
    const response = await fetch(url, { headers });
    const data = await response.json();
    //Return Results
    if (data.result && data.result.entity.length > 0) {
      return data.result;
    }
    throw new Error('No results found');
  } catch (error) {
    console.error('Fetch error:', error);
    return null;
  }
}

// Fetch Filter Options
export async function fetchFilterOptions(brand) {
  const query = `
    {
      "difficulty": [
        {"type": "Introductory", "count": count(*[_type == 'song' && brand == ${brand} && difficulty_string == "Introductory"]._id)},
        {"type": "Beginner", "count": count(*[_type == 'song' && brand == ${brand} && difficulty_string == "Beginner"]._id)},
        {"type": "Intermediate", "count": count(*[_type == 'song' && brand == ${brand} && difficulty_string == "Intermediate"]._id)},
        {"type": "Advanced", "count": count(*[_type == 'song' && brand == ${brand} && difficulty_string == "Advanced"]._id)},
        {"type": "Expert", "count": count(*[_type == 'song' && brand == ${brand} && difficulty_string == "Expert"]._id)}
      ],
      "genre": *[_type == 'genre' && 'song' in filter_types] {
        "type": name,
        "count": count(*[_type == 'song' && brand == ${brand} && references(^._id)]._id)
      },
      "instrumentless": [
        {"type": "Full Song Only", "count": count(*[_type == 'song' && brand == ${brand} && instrumentless == false]._id)},
        {"type": "Instrument Removed", "count": count(*[_type == 'song' && brand == ${brand} && instrumentless == true]._id)}
      ]
    }
  `;

  const encodedQuery = encodeURIComponent(query);
  const url = `https://${projectId}.api.sanity.io/v${version}/data/query/${dataset}?query=${encodedQuery}`;

  const headers = {
    'Authorization': `Bearer ${token}`,
    'Content-Type': 'application/json'
  };

  try {
    const response = await fetch(url, { headers });
    const data = await response.json();
    if (data.result) {
      return data.result;
    } else {
      throw new Error('No results found');
    }
  } catch (error) {
    console.error('Fetch error:', error);
    return null;
  }
}


//FETCH SONG COUNT
export async function fetchSongCount(brand) {
  const query = `count(*[_type == 'song' && brand == "${brand}"])`;
  const encodedQuery = encodeURIComponent(query);
  const url = `https://${projectId}.api.sanity.io/v${version}/data/query/${dataset}?query=${encodedQuery}`;

  const headers = {
    'Authorization': `Bearer ${token}`,
    'Content-Type': 'application/json'
  };

  try {
    const response = await fetch(url, { headers });
    const result = await response.json();
    return result.result;
  } catch (error) {
    console.error('Fetch error:', error);
    return null;
  }
}

//FETCH IN PROGRESS SONGS
export async function fetchSongsInProgress(userId, brand, token) {
  const url = `/content/in_progress/${userId}?content_type=song&brand=${brand}`;

  const headers = {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': token
  };
  
  try {
    const response = await fetch(url, { headers });
    const result = await response.json();
    if(result){
      console.log('fetchSongsInProgress', result);
      return result;
    } else {
      console.log('result not json')
    }
  } catch (error) {
    console.error('Fetch error:', error);
    return null;
  }
}