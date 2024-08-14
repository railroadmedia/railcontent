<?php

namespace App\Modules\Content\ApiGateways;

use Sanity\Client as SanityClient;


class SanityGateway
{
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
     * @return mixed|string - matching documents
     */
    public function getByRailContentIds(array $ids)
    {
        $gateway = new SanityGateway();
        $idsString = implode(',', $ids);
        // see musora-content-services index.js for the fields required for this
        $query ="*[railcontent_id in [${idsString}]]{
          railcontent_id,
          title,
          'image': thumbnail.asset->url,
          'thumbnail': thumbnail.asset->url,
          'artist': select(artist->name != null => artist->name, instructor[0]->name),
          difficulty,
          difficulty_string,
          web_url_path,
          published_on,
          'type': _type,
          progress_percent,
          brand,
          slug,
        }";
        $documents = $gateway->sanity->fetch($query);
        // The following are used to format similar to RailContent, these are a stopgap measure
        foreach($documents as $key => $document) {
            $documents[$key]['id'] = $document['railcontent_id'];
            $documents[$key]['slug'] = $document['slug']['current'];
            $documents[$key]['url'] = $document['web_url_path'];
            //$documents[$key]['fields'] = $this->mapSanityFields($document);
            //$documents[$key]['data'] = $this->mapSanityData($document);
        }
        return $documents;
    }

    private function mapSanityFields($document)
    {
        // fields needs to exist, but no longer needs actual data
        return [];
        $fieldsToDuplicate = ['artist', 'difficulty', 'instructor'];
        $fields = [];
        foreach($fieldsToDuplicate as $index => $toDuplicate) {
            if ($document[$toDuplicate] ?? false) {
                // TODO not sure about null checking here, but I don't think we should duplicate null fields
                $fields[] = [
                    'key' => $toDuplicate,
                    'value' => $document[$toDuplicate],
                    'position' => $index,
                    'type' => 'string',
                    'content_id' => $document['railcontent_id'],
                    'id' => md5("{$document['railcontent_id']}".$toDuplicate),
                ];
            }
        }
        return $fields;
    }

//    private function mapSanityData($document)
//    {
//        // needs to exist, but no data
//        return [];
//        $contentId = $document['railcontent_id'];
//        $dataToGenerate = [
//            'original_thumbnail_url' => 'thumbnail',
//        ];
//        foreach($dataToGenerate as $dataKey => $sanityKey) {
//            $data[] = $this->generateData($document[$sanityKey], $dataKey, $contentId);
//        }
//        return $data;
//    }
//
//    private function generateData($value, $key, $contentId)
//    {
//        return [
//            'key' => $key,
//            'value' => $value,
//            'position' => 0, //TODO what?
//            'type' => 'string',
//            'content_id' => $contentId,
//            'id' => md5($contentId.$key),
//        ];
//    }
}
