<?php

namespace App\Modules\Content\ApiGateways;

use Sanity\Client as SanityClient;

class SanityGateway
{
    private array $defaultFields = [
        "'sanity_id' : _id",
        "'id': railcontent_id",
        "railcontent_id",
        "artist",
        "title",
        "'image': thumbnail.asset->url",
        "'thumbnail': thumbnail.asset->url",
        "difficulty",
        "difficulty_string",
        "web_url_path",
        "'url' : web_url_path",
        "published_on",
        "'type': _type",
        "'length_in_seconds' : coalesce(length_in_seconds, soundslice[0].soundslice_length_in_second)",
        "brand",
        "'genre': genre[]->name",
        'status',
        "'slug' : slug.current",
        "'permission_id': permission[]->railcontent_id",
        'child_count',
        "'description': description[0].children[0].text",
        "'artist_name':coalesce(artist->name, instructor[0]->name)",
    ];

    private array $contentSpecificFields = [
        'challenge' => [
            'enrollment_start_time',
            'enrollment_end_time',
            "'registration_url': '/' + brand + '/enrollment/' + slug.current",
            'is_solo',
            '"lesson_count": child_count',
            '"primary_cta_text": select(dateTime(published_on) > dateTime(now()) && dateTime(enrollment_start_time) > dateTime(now()) => "Notify Me", "View Challenge")',
            'challenge_state',
            'challenge_state_text',
            '"description": description[0].children[0].text',
            'total_xp',
            'xp',
            '"instructors": instructor[]->name',
            '"instructor_signature": instructor[0]->signature.asset->url',
            '"header_image_url": thumbnail.asset->url',
            '"logo_image_url": logo_image_url.asset->url',
            '"award": award.asset->url',
            'award_custom_text',
            '"gold_award": gold_award.asset->url',
            '"silver_award": silver_award.asset->url',
            '"bronze_award": bronze_award.asset->url',
            '"logo_image_url": logo_image_url.asset->url',
            '"dark_mode_logo_url": dark_mode_logo_url.asset->url',
            '"light_mode_logo_url": light_mode_logo_url.asset->url',
            '"bgImg": bgImg.asset->url',
            '"wideImg": wideImg.asset->url',
            '"squareImg": squareImg.asset->url',
            'child_count',
            '"badge" : badge.asset->url',
            '"lessons": child[]->{
                "sanity_id" : _id,
                "id": railcontent_id,
                railcontent_id,
                artist,
                title,
                "image": thumbnail.asset->url,
                "thumbnail": thumbnail.asset->url,
                difficulty,
                difficulty_string,
                web_url_path,
                "url" : web_url_path,
                published_on,
                "type": _type,
                "length_in_seconds" : coalesce(length_in_seconds, soundslice[0].soundslice_length_in_second),
                brand,
                "genre": genre[]->name,
                status,
                "slug" : slug.current,
                "permission_id": permission[]->railcontent_id,
                is_always_unlocked_for_challenge,
                is_bonus_content_for_challenge,
                video,
            }',
        ],
        'playlist-item' => [
            "'type': _type",
            '"instructors": instructor[]->name',
            '"instructors_details": instructor[]->{
                    "id":railcontent_id,
                    name,
                    short_bio,
                    "biography": long_bio[0].children[0].text,
                    web_url_path,
                    "coach_card_image": coach_card_image.asset->url,
                    "coach_profile_image":thumbnail_url.asset->url
                }',
            'parent_content_data',
            'video',
            "'soundslice_slug':soundslice[0]['soundslice_slug']",
            '"resources": resource',
            "instrumentless",
            "'chapters': chapter[]{
                    chapter_description,
                    chapter_timecode,
                    'chapter_thumbnail_url': chapter_thumbnail_url.asset->url
                }",
            "'assignments':assignment[]{
                'id': railcontent_id,
                'soundslice_slug': assignment_soundslice,
                'title': assignment_title,
                'sheet_music_image_url': assignment_sheet_music_image,
                'timecode': assignment_timecode,
                'description': assignment_description,
                'title':assignment_title,
        }",
        ]
        ];

    public SanityClient $sanity;

    /**
     * Wrapper object around the Sanity client.
     * Provides utility functions for retrieving and updating data
     * The underlying client can be accessed through the $sanity attribute
     */
    public function __construct()
    {
        $projectId = config('content.project_id');
        $dataset = config('content.dataset');
        $accessToken = config('content.api_token_wr');
        $apiVersion = '2021-06-07';
        $this->sanity = new SanityClient([
            'projectId' => $projectId,
            'dataset' => $dataset,
            'apiVersion' => $apiVersion,
            'token' => $accessToken,
            'perspective' => 'published'
        ]);
    }

    /**
     * @param string $id - document ID to update
     * @param array $data - array of fields to edit
     * @return array - updated document
     * @throws \Sanity\Exception\ConfigException
     */
    public function patchSetSingle(string $id, array $data): array
    {
        return $this->sanity->patch($id)->set($data)->commit();
    }

    /**
     * @param string $id - document ID to update
     * @param string $field - name of the document field
     * @param array $newReferences - array of references, these must be the document ids of the referenced documents
     * @return array - updated document
     * @throws \Sanity\Exception\ConfigException
     */
    public function patchAppendReferences(string $id, string $field, array $newReferences): array
    {
        $data = [];
        foreach ($newReferences as $newReference) {
            $data[] = ["_type" => 'reference', "_ref" => $newReference, '_key' => uniqid()];
        }
        return $this->sanity->patch($id)->setIfMissing([$field => []])->append($field, $data)->commit();
    }

    /**
     * @param string $id - document ID to update
     * @param string $field - name of the document field
     * @param array $data - array of Objects to append, each first level element must correspond to a full child object
     * @return array - updated document
     * @throws \Sanity\Exception\ConfigException
     */
    public function patchAppend(string $id, string $field, array $data): array
    {
        foreach ($data as $index => $datum) {
            $data[$index]['_key'] = $data[$index]['_key'] ?? uniqid();
        }
        return $this->sanity->patch($id)->setIfMissing($field = [])->append($field, $data)->commit();
    }

    /**
     * @param array $mutations - array of mutation objects, must be documentID => [mutations]
     * @return array - updated documents
     * @throws \Sanity\Exception\ConfigException
     * @throws \Sanity\Exception\InvalidArgumentException
     */
    public function patchSetMany(array $mutations): array
    {
        $transaction = $this->sanity->transaction();
        foreach ($mutations as $id => $data) {
            $transaction->patch($this->sanity->patch($id)->set($data));
        }
        return $transaction->commit();
    }

    /**
     * @param string $id - document Id to retrieve
     * @return array|string
     */
    public function getDocument(string $id)
    {
        return $this->sanity->getDocument($id);
    }

    /**
     * @param array $ids - railcontent.id values
     * @param string $type - sanity _type value
     * @return mixed|string - matching documents
     */
    public function getByRailContentIds(array $ids, ?string $type = null, ?string $brand = null, bool $includeParents = false)
    {
        $gateway = new SanityGateway();
        $idsString = implode(',', $ids);
        // see musora-content-services sanity.js for the fields and format we need to replicate
        $typeString = ($type && $type !== 'playlist-item') ? "&& _type == '$type'" : '';
        $brandString = $brand ? " && brand == '$brand'" : '';
        $fieldsString = $this->getFieldsString($type);
        $parentQuery = $includeParents
            ? ", 'parents': *[railcontent_id in (^.parent_content_data[].id)] {  $fieldsString }"
            : '';
        $query = "*[railcontent_id in [{$idsString}] $typeString $brandString]{
            $fieldsString $parentQuery
        }";
        $documents = $gateway->sanity->fetch($query);
        // The following are used to format similar to RailContent, these are a stopgap measure
        // TODO these need to be removed and any decorators using them should be update/removed
        foreach ($documents as $key => $document) {
            $documents[$key]['fields'] = $this->mapSanityFields($document);
            $documents[$key]['data'] = $this->mapSanityFields($document);
        }
        return $documents;
    }

    /**
     * @param int $railcontentId - railcontent.id value
     * @param string $type - sanity _type value
     * @return array | null - matching challenge document or null
     */
    public function getByRailContentId(int $railcontentId, ?string $type = null): array | null
    {

        $gateway = new SanityGateway();
        // see musora-content-services sanity.js for the fields and format we need to replicate
        $fieldsString = $this->getFieldsString($type);
        $typeString = $type ? "&& _type == '$type'" : '';
        $query = "*[railcontent_id == $railcontentId $typeString]{
          $fieldsString
        } [0 ... 1]";
        $document = $gateway->sanity->fetch($query)[0] ?? null;
        if (is_null($document)) {
            return null;
        }
        // The following are used to format similar to RailContent, these are a stopgap measure
        // TODO these need to be removed and any decorators using them should be update/removed
        $document['fields'] = $this->mapSanityFields($document);
        $document['data'] = $this->mapSanityFields($document);
        return $document;
    }

    public function getProductInformationForAllChallenges(): array
    {
        $gateway = new SanityGateway();
        $query = "*[_type == 'challenge']{
            'sanity_id': _id,
            'id': railcontent_id,
            'product_id',
            'is_solo'
        }";
        $results = $gateway->sanity->fetch($query);
        return $results;
    }

    /**
     * @param string $brand
     * @return array
     */
    public function getAllChallengesByBrand(?string $brand): array
    {
        $gateway = new SanityGateway();
        $fieldsString = $this->getFieldsString('challenge');
        $brandString = $brand ? " && brand == '$brand'" : '';
        $query = "*[_type == 'challenge' $brandString]{
            $fieldsString
        }";
        $results = $gateway->sanity->fetch($query);
        return $results;
    }


    /**
     * @param int $railcontentId - railcontent.id value
     * @param string $type - sanity _type value
     * @return array - matching challenge document
     */
    public function getChallengeChildAndParentData(int $railcontentId, ?string $type = null): array
    {

        $gateway = new SanityGateway();
        // see musora-content-services sanity.js for the fields and format we need to replicate
        $challengeFields = $this->getFieldsString('challenge');
        $typeString = $type ? "&& _type == '$type'" : '';
        $fieldsString = $this->getFieldsString($type);
        $query = "*[railcontent_id == $railcontentId $typeString]{
          $fieldsString,
          'parent': *[references(^._id) && _type == 'challenge'][0]{
                $challengeFields
                },
        } [0 ... 1]";
        $document = $gateway->sanity->fetch($query)[0] ?? [];
        return $document;
    }

    public function getChallengesWithOpenEnrollment(string $brand): array
    {
        $challengeFields = $this->getFieldsString('challenge');
        $query = "*[_type == 'challenge'
            && enrollment_start_time <= now()
            && enrollment_end_time >= now()
            && brand == '$brand'
            ]{
            $challengeFields,
        }";
        return $this->sanity->fetch($query);
    }

    public function getAssignmentsByRailcontentIds($brand, array $ids, array $parentIds, ?string $type = null, bool $includeParents = false)
    {

        $gateway = new SanityGateway();
        $idsString = implode(',', $ids);
        $parentIdsString = implode(',', $parentIds);
        $fieldsString = $this->getFieldsString($type);
        $parentQuery = $includeParents
            ? ", 'parents': *[railcontent_id in (^.parent_content_data[].id)] {  $fieldsString }"
            : '';
        $query = "*[brand == '{$brand}' && railcontent_id in [{$parentIdsString}]]{
          $fieldsString, resource $parentQuery,
          'instructors_details': instructor[]->{
                    'id':railcontent_id,
                    name,
                    short_bio,
                    'biography': long_bio[0].children[0].text,
                    web_url_path,
                    'coach_card_image': coach_card_image.asset->url,
                    'coach_profile_image':thumbnail_url.asset->url
                },
  assignment[railcontent_id in  [{$idsString}]]{assignment_soundslice,
         assignment_title,
         assignment_sheet_music_image,
         assignment_timecode,
         assignment_description,
         railcontent_id}
}";
        $documents = $gateway->sanity->fetch($query);
        $assignments = [];
        foreach ($documents as $key => $document) {
            foreach ($document['assignment'] ?? [] as $assignment) {
                $routes = [];

                if (!empty($document['parents'] ?? [])) {

                    $route = collect($document['parents'])->map(function ($parent) use ($document) {
                        switch ($parent['type']) {
                            case 'learning-path':
                                return 'Method';
                            case 'learning-path-level':
                                return 'L'.collect($document['parent_content_data'])->keyBy('id')[$parent['id']]['position'];
                            default:
                                return $parent['title'];
                        }
                    })->toArray();
                    $routes = array_reverse($route);
                }
                $routes = array_merge($routes, [$document['title']]);
                $assignments[] = [
                    'title'     => $assignment['assignment_title'],
                    'item_type' => 'assignment',
                    'instructors' => $document['instructors'],
                    'instructors_details' => $document['instructors_details'],
                    'thumbnail' => $document['thumbnail'],
                    'difficulty_string' => $document['difficulty_string'],
                    'published_on' => $document['published_on'],
                    'railcontent_id'     => $assignment['railcontent_id'],
                    'sheet_music_image_url' => $assignment['assignment_sheet_music_image'] ?? [],
                    'timecode' => $assignment['assignment_timecode'] ?? null,
                    'description' => $assignment['assignment_description'] ?? null,
                    'soundslice_slug' => $assignment['assignment_soundslice'] ?? null,
                    'route' => $routes,
                    'resources' => $document['resource'] ?? [],
                    'permission_id' => $document['permission_id'] ?? [],
                    'status' => $document['status'],
                    'parent' => [
                        'type' => $document['type'],
                        'title' => $document['title'],
                        'url' => $document['url']
                    ]
                ];
            }
        }
        return $assignments;
    }

    public function countLessonsAndAssignments($id)
    {
        $gateway = new SanityGateway();
        $fieldsString = $this->getFieldsString('playlist-item');

        // Fetch only leaf nodes directly, traversing the hierarchy
        $query = "*[railcontent_id == {$id}]{
        $fieldsString,
        resource,
        'thumbnail': thumbnail.asset->url,
        'assignments':assignment[assignment_soundslice != null]{'railcontent_id': railcontent_id},
        // Use a recursive-like approach to get only leaf nodes
        'lastChildItems': array::compact(
            child[]-> {
                'id': railcontent_id,
                'type': _type,
                title,
                'thumbnail': thumbnail.asset->url,
                'assignments':assignment[assignment_soundslice != null]{'railcontent_id': railcontent_id},
                'children': child[]-> {
                    // Fetch child nodes if they exist
                    'id': railcontent_id,
                    'type': _type,
                    title,
                    'thumbnail': thumbnail.asset->url,
                    'assignments':assignment[assignment_soundslice != null]{'railcontent_id': railcontent_id},
                    'isLeaf': !defined(child)
                }
            }
        )
    }";

        $documents = $gateway->sanity->fetch($query);

        $assignmentIds = [];
        $leafNodes = [];
        $assignmentsCount = 0;
        if (!empty($documents)) {
            // Flatten the structure to get leaf nodes only
            if (!$documents[0]['lastChildItems']) {
                if (isset($documents[0]['parent_content_data'])) {
                    $parent = (last($documents[0]['parent_content_data']));
                }
                if (!empty($documents[0]['assignments'])) {
                    foreach ($documents[0]['assignments'] as $assignment) {
                        $assignmentIds[$documents[0]['id']][$assignment['railcontent_id']] = ['id' => $assignment['railcontent_id'], 'parent_id' => null];
                        $assignmentsCount++;
                    }
                }
                $leafNodes[] = ['id' => $id, 'parent_id' => $parent['id'] ?? null, 'title' => $documents[0]['title'], 'thumbnail' => $documents[0]['thumbnail']];
            }
            foreach ($documents[0]['lastChildItems'] ?? [] as $item) {
                if (!empty($item['assignments'])) {
                    foreach ($item['assignments'] as $assignment) {
                        $assignmentIds[$item['id']][$assignment['railcontent_id']] = ['id' => $assignment['railcontent_id'], 'parent_id' => $item['id']];
                        $assignmentsCount++;
                    }
                }
                if (isset($item['children'])) {
                    foreach ($item['children'] as $child) {
                        if ($child['isLeaf']) {
                            $leafNodes[] = ['id' => $child['id'],  'parent_id' => $item['id'], 'title' => $child['title'], 'thumbnail' => $child['thumbnail']];
                            if (!empty($child['assignments'])) {
                                foreach ($child['assignments'] as $assignment) {
                                    $assignmentIds[$item['id']][$assignment['railcontent_id']] = ['id' => $assignment['railcontent_id'], 'parent_id' => $item['id']];
                                    $assignmentsCount++;
                                }
                            }
                        }
                    }
                } else {
                    $leafNodes[] = ['id' => $item['id'],  'parent_id' => $documents[0]['id'],  'title' => $item['title'], 'thumbnail' => $item['thumbnail']];
                    if (!empty($item['assignments'])) {
                        foreach ($item['assignments'] as $assignment) {
                            $assignmentIds[$item['id']][$assignment['railcontent_id']] = ['id' => $assignment['railcontent_id'], 'parent_id' => $item['id']];
                            $assignmentsCount++;
                        }
                    }
                }
            }
            //   $assignmentsCount = count($assignmentIds);
            if ($documents[0]['type'] == 'song') {
                if ($documents[0]['instrumentless']) {
                    $assignmentsCount = 2;
                } else {
                    $assignmentsCount = 1;
                }
            }
        }

        return [
            'lessons' => $leafNodes,
            'lessons_count' => count($leafNodes),
            'soundslice_assignments' => $assignmentIds,
            'soundslice_assignments_count' => $assignmentsCount,
        ];
    }

    /**
     * @param string $contentType - sanity _type value
     * @return string - groq query string for fields
     */
    private function getFieldsString(?string $contentType): string
    {
        $allFields = array_merge($this->defaultFields, $this->contentSpecificFields[$contentType] ?? []);
        return implode(',', $allFields);
    }

    private function mapSanityFields($document)
    {
        // fields needs to exist for decorators to work, but no longer needs actual data
        // eventually this should be removed.
        return [];
    }

}
