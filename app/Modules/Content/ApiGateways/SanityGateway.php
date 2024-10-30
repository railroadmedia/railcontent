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
        "progress_percent",
        "'length_in_seconds' : coalesce(length_in_seconds, soundslice[0].soundslice_length_in_second)",
        "brand",
        "'genre': genre[]->name",
        'status',
        "'slug' : slug.current",
        "'permission_id': permission[]->railcontent_id",
    ];

    private array $contentSpecificFields = [
        'challenge' => [
            'enrollment_start_time',
            'enrollment_end_time',
            'is_solo_challenge',
            'registration_url',
            '"lesson_count": child_count',
            '"primary_cta_text": select(dateTime(published_on) > dateTime(now()) && dateTime(enrollment_start_time) > dateTime(now()) => "Notify Me", "Start Challenge")',
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
            'child_count',
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
                progress_percent,
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
        ]);
    }

    /**
     * @param string $id - document ID to update
     * @param array $data - array of fields to edit
     * @return array - updated document
     * @throws \Sanity\Exception\ConfigException
     */
    public function patchSetSingle(string $id, array $data) : array
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
    public function patchAppendReferences(string $id, string $field, array $newReferences) : array
    {
        $data = [];
        foreach($newReferences as $newReference) {
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
    public function patchAppend(string $id, string $field, array $data) : array
    {
        foreach($data as $index => $datum) {
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
    public function patchSetMany(array $mutations) : array
    {
        $transaction = $this->sanity->transaction();
        foreach($mutations as $id => $data) {
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
    public function getByRailContentIds(array $ids, ?string $type = null)
    {

        $gateway = new SanityGateway();
        $idsString = implode(',', $ids);
        // see musora-content-services sanity.js for the fields and format we need to replicate
        $typeString = $type ? "&& _type = '$type'" : '';
        $fieldsString = $this->getFieldsString($typeString);
        $query ="*[railcontent_id in [{$idsString}] $typeString]{
          $fieldsString
        }";
        $documents = $gateway->sanity->fetch($query);
        // The following are used to format similar to RailContent, these are a stopgap measure
        // TODO these need to be removed and any decorators using them should be update/removed
        foreach($documents as $key => $document) {
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
    public function getByRailContentId(int $railcontentId, ?string $type = null) : array | null
    {

        $gateway = new SanityGateway();
        // see musora-content-services sanity.js for the fields and format we need to replicate
        $fieldsString = $this->getFieldsString($type);
        $typeString = $type ? "&& _type == '$type'" : '';
        $query ="*[railcontent_id == $railcontentId $typeString]{
          $fieldsString
        } [0 ... 1]";
        $document = $gateway->sanity->fetch($query)[0] ?? null;
        if (is_null($document)) return null;
        // The following are used to format similar to RailContent, these are a stopgap measure
        // TODO these need to be removed and any decorators using them should be update/removed
        $document['fields'] = $this->mapSanityFields($document);
        $document['data'] = $this->mapSanityFields($document);
        return $document;
    }

    /**
     * @param int $railcontentId - railcontent.id value
     * @param string $type - sanity _type value
     * @return array - matching challenge document
     */
    public function getChallengeChildAndParentData(int $railcontentId, ?string $type = null) : array
    {

        $gateway = new SanityGateway();
        // see musora-content-services sanity.js for the fields and format we need to replicate
        $challengeFields = $this->getFieldsString('challenge');
        $typeString = $type ? "&& _type == '$type'" : '';
        $fieldsString = $this->getFieldsString($type);
        $query ="*[railcontent_id == $railcontentId $typeString]{
          $fieldsString,
          'parent': *[references(^._id) && _type == 'challenge'][0]{
                $challengeFields
                },
        } [0 ... 1]";
        $document = $gateway->sanity->fetch($query)[0] ?? [];
        return $document;
    }


    /**
     * @param string $contentType - sanity _type value
     * @return string - groq query string for fields
     */
    private function getFieldsString(?string $contentType) : string
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
