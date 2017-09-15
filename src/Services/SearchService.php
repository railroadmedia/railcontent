<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/15/2017
 * Time: 4:24 PM
 */

namespace Railroad\Railcontent\Services;


use Railroad\Railcontent\Repositories\RepositoryBase;
use Railroad\Railcontent\Requests\ContentIndexRequest;

class SearchService extends RepositoryBase implements SearchInterface
{
    protected $search, $contentRepository;

    /**
     * Search constructor.
     * @param $searchService
     */
    public function __construct(SearchInterface $searchService)
    {
        $this->search = $searchService;
    }

    /**
     * @param ContentIndexRequest $request
     * @return mixed
     */
    public function generateQuery(ContentIndexRequest $request)
    {
        $queryBuilder = $this->search->generateQuery($request);

        return $queryBuilder;
    }


    public function search(ContentIndexRequest $request)
    {

        $query = $this->generateQuery($request);

        return $query->get();
    }

    public function getPaginated(ContentIndexRequest $request)
    {
        $fieldsWithContent = $this->search($request);

        return $this->parseAndGetLinkedContent($fieldsWithContent);
    }

    /**
     * @param $fieldsWithContent
     * @return array
     */
    private function parseAndGetLinkedContent($fieldsWithContent)
    {
        $linkedContentIdsToGrab = [];

        foreach($fieldsWithContent as $fieldWithContent) {
            if($fieldWithContent['field_type'] === 'content_id') {
                $linkedContentIdsToGrab[] = $fieldWithContent['field_value'];
            }
        }

        $linkedContents = [];

        if(!empty($linkedContentIdsToGrab)) {
            $linkedContents = $this->getManyById($linkedContentIdsToGrab);
        }

        $content = [];

        foreach($fieldsWithContent as $fieldWithContent) {
            $content[$fieldWithContent['id']] = [
                'id' => $fieldWithContent['id'],
                'slug' => $fieldWithContent['slug'],
                'status' => $fieldWithContent['status'],
                'type' => $fieldWithContent['type'],
                'position' => $fieldWithContent['position'],
                'parent_id' => $fieldWithContent['parent_id'],
                'published_on' => $fieldWithContent['published_on'],
                'created_on' => $fieldWithContent['created_on'],
                'archived_on' => $fieldWithContent['archived_on'],
            ];
        }

        foreach($fieldsWithContent as $fieldWithContent) {
            if(($fieldWithContent['field_key'] === null) && ($fieldWithContent['datum_key'] === null)) {
                continue;
            }

            if($fieldWithContent['field_type'] === 'content_id') {

                $content[$fieldWithContent['id']]['fields'][$fieldWithContent['field_key']] = [
                    'id' => $linkedContents[$fieldWithContent['field_value']]['id'],
                    'slug' => $linkedContents[$fieldWithContent['field_value']]['slug'],
                    'status' => $linkedContents[$fieldWithContent['field_value']]['status'],
                    'type' => $linkedContents[$fieldWithContent['field_value']]['type'],
                    'position' => $linkedContents[$fieldWithContent['field_value']]['position'],
                    'parent_id' => $linkedContents[$fieldWithContent['field_value']]['parent_id'],
                    'published_on' => $linkedContents[$fieldWithContent['field_value']]['published_on'],
                    'created_on' => $linkedContents[$fieldWithContent['field_value']]['created_on'],
                    'archived_on' => $linkedContents[$fieldWithContent['field_value']]['archived_on'],
                ];

                if(array_key_exists('fields', $linkedContents[$fieldWithContent['field_value']])) {
                    foreach($linkedContents[$fieldWithContent['field_value']]['fields'] as
                            $linkedContentFieldKey => $linkedContentFieldValue) {

                        $content[$fieldWithContent['id']]['fields'][$fieldWithContent['field_key']]
                        ['fields'][$linkedContentFieldKey] = $linkedContentFieldValue;
                    }
                }

                if(array_key_exists('datum', $linkedContents[$fieldWithContent['field_value']])) {
                    foreach($linkedContents[$fieldWithContent['field_value']]['datum'] as
                            $linkedContentDatumKey => $linkedContentDatumValue) {

                        $content[$fieldWithContent['id']]['fields'][$fieldWithContent['field_key']]
                        ['datum'][$linkedContentDatumKey] = $linkedContentDatumValue;
                    }
                }

            } else {
                // put multiple fields with same key in to an array
                if($fieldWithContent['field_type'] == 'multiple') {

                    $content[$fieldWithContent['id']]
                    ['fields']
                    [$fieldWithContent['field_key']]
                    [$fieldWithContent['field_position']] =
                        $fieldWithContent['field_value'];

                } elseif($fieldWithContent['field_value']) {

                    $content[$fieldWithContent['id']]
                    ['fields']
                    [$fieldWithContent['field_key']] =
                        $fieldWithContent['field_value'];
                }
            }

            //put datum as array key => value
            if($fieldWithContent['datum_value']) {
                $content[$fieldWithContent['id']]
                ['datum']
                [$fieldWithContent['datum_key']] =
                    $fieldWithContent['datum_value'];
            }
        }

        return $content;
    }
}