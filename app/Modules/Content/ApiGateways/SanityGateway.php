<?php

namespace App\Modules\Content\ApiGateways;

use Illuminate\Support\Carbon;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPermissionsService;
use Sanity\Client as SanityClient;

class SanityGateway
{
    private const SHEET_MUSIC_QUERY = "
      coalesce(assignment_sheet_music_image_new[]{
              _type == 'Image' => {
                'url': asset->url
              },
              _type == 'URL' => {
                url
              }
            }.url,
            assignment_sheet_music_image)
    ";

    private const AWS_URL = 'https://s3.us-east-1.amazonaws.com/musora-web-platform';
    private const CLOUDFRONT_URL = 'https://d3fzm1tzeyr5n3.cloudfront.net';
    private const RESOURCES_FIELD = 'resource[]{resource_name, _key, "resource_url": coalesce("' . self::CLOUDFRONT_URL . '"+string::split(resource_aws.asset->fileURL, "' . self::AWS_URL . '")[1], resource_url)}';


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
        "'lesson_count': child_count",
        "parent_content_data",
        'soundslice_slug',
    ];

    private array $contentSpecificFields = [
        'challenge' => [
            'enrollment_start_time',
            'enrollment_end_time',
            'cohort_start_date',
            'cohort_end_date',
            "'registration_url': '/' + brand + '/enrollment/' + slug.current",
            'is_solo',
            '"lesson_count": child_count',
            '"primary_cta_text": select(dateTime(published_on) > dateTime(now()) && dateTime(enrollment_start_time) > dateTime(now()) => "Notify Me", "View Challenge")',
            'challenge_state_text',
            '"description": description[0].children[0].text',
            'total_xp',
            'xp',
            '"instructors": instructor[]->name',
            '"instructor_signature": instructor[0]->signature.asset->url',
            '"instructor": instructor[]->{
                "id":railcontent_id,
                name,
                short_bio,
                "biography": short_bio[0].children[0].text,
                web_url_path,
                "coach_card_image": coach_card_image.asset->url,
                "coach_profile_image":thumbnail_url.asset->url
              }',
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
                "parent_content_data": parent_content_data[]{
                    "id": id,
                    "title": *[railcontent_id == ^.id][0].title,
                    "web_url_path": *[railcontent_id == ^.id][0].web_url_path,
                    "slug": *[railcontent_id == ^.id][0].slug,
                    "type": *[railcontent_id == ^.id][0]._type,
                },
                "chapters": chapter[]{
                    chapter_description,
                    chapter_timecode,
                    "chapter_thumbnail_url": chapter_thumbnail_url.asset->url
                },
                "assignments":assignment[]{
                    "id": railcontent_id,
                    "soundslice_slug": assignment_soundslice,
                    "title": assignment_title,
                    "sheet_music_image_url": ' . self::SHEET_MUSIC_QUERY . ',
                    "timecode": assignment_timecode,
                    "description": assignment_description,
                    "title":assignment_title,
                },
                soundslice_slug,
                "is_milestone": coalesce(is_milestone, false),
                xp,
                "resources": [
                                ... ' . self::RESOURCES_FIELD . ',
                                ... *[railcontent_id == ^.parent_content_data[0].id] [0].' . self::RESOURCES_FIELD . ',
                            ],
            }',
            'product_id',
            'is_banner_draft',
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
            "'soundslice_slug': coalesce(soundslice_slug, soundslice[0]['soundslice_slug'])",
            '"resources": [
                            ... ' . self::RESOURCES_FIELD . ',
                            ... *[railcontent_id == ^.parent_content_data[0].id] [0].' . self::RESOURCES_FIELD . ',
                        ]',
            "instrumentless",
            "high_soundslice_slug",
            "low_soundslice_slug",
            'soundslice',
            "'chapters': chapter[]{
                    chapter_description,
                    chapter_timecode,
                    'chapter_thumbnail_url': chapter_thumbnail_url.asset->url
                }",
            "'assignments':assignment[]{
                'id': railcontent_id,
                'soundslice_slug': assignment_soundslice,
                'title': assignment_title,
                'sheet_music_image_url': " . self::SHEET_MUSIC_QUERY . ",
                'timecode': assignment_timecode,
                'description': assignment_description,
                'title':assignment_title,
        }",
        ],
        'live-event' => [
            "'type': _type",
            "'slug':slug.current",
            "live_event_start_time",
            "live_event_end_time",
            "railcontent_id",
            "'videoId': coalesce(live_event_youtube_id, video.external_id)",
            "'instructors':instructor[]->name"
        ]
    ];

    private UserPermissionsService $userPermissionsService;
    private ?array $userPermissionsCached = null;

    public SanityClient $sanity;

    /**
     * Wrapper object around the Sanity client.
     * Provides utility functions for retrieving and updating data
     * The underlying client can be accessed through the $sanity attribute
     */
    public function __construct(SanityClient $sanity)
    {
        $this->sanity = $sanity;
        $this->userPermissionsService = app()->make(UserPermissionsService::class);
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
    public function getByRailContentIds(
        array $ids,
        ?string $type = null,
        ?string $brand = null,
        bool $includeParents = false
    ) {
        $idsString = implode(',', $ids);
        // see musora-content-services sanity.js for the fields and format we need to replicate
        $typeString = ($type && $type !== 'playlist-item') ? "&& _type == '$type'" : '';
        $brandString = $brand ? " && brand == '$brand'" : '';
        $publishedOnString = $this->getPublishedFilter(false);
        $fieldsString = $this->getFieldsString($type);
        $parentQuery = $includeParents
            ? ", 'parents': *[railcontent_id in (^.parent_content_data[].id)] {  $fieldsString }"
            : '';
        $query = "*[railcontent_id in [{$idsString}] $typeString $brandString $publishedOnString]{
            $fieldsString $parentQuery
        }";
        $documents = $this->sanity->fetch($query);
        // The following are used to format similar to RailContent, these are a stopgap measure
        // TODO these need to be removed and any decorators using them should be update/removed
        foreach ($documents as $key => $document) {
            $documents[$key]['fields'] = $this->mapSanityFields($document);
            $documents[$key]['data'] = $this->mapSanityFields($document);
            $this->postProcessDocument($documents[$key]);
        }
        return $documents;
    }

    /**
     * @param int $railcontentId - railcontent.id value
     * @param string $type - sanity _type value
     * @return array | null - matching challenge document or null
     */
    public function getByRailContentId(int $railcontentId, ?string $type = null): array|null
    {
        // see musora-content-services sanity.js for the fields and format we need to replicate
        $fieldsString = $this->getFieldsString($type);
        $typeString = $type ? "&& _type == '$type'" : '';
        $publishedFilter = $this->getPublishedFilter(true);
        $query = "*[railcontent_id == $railcontentId $typeString $publishedFilter]{
          $fieldsString
        } [0 ... 1]";
        $document = $this->sanity->fetch($query)[0] ?? null;
        if (is_null($document)) {
            return null;
        }
        // The following are used to format similar to RailContent, these are a stopgap measure
        // TODO these need to be removed and any decorators using them should be update/removed
        $document['fields'] = $this->mapSanityFields($document);
        $document['data'] = $this->mapSanityFields($document);
        $this->postProcessDocument($document);
        return $document;
    }

    public function getAllByType(string $type, int $limit = 20): array
    {
        // see musora-content-services sanity.js for the fields and format we need to replicate
        $fieldsString = $this->getFieldsString($type);
        $query = "*[_type == '$type']{
          $fieldsString
        } [0 ... $limit]";
        $documents = $this->sanity->fetch($query) ?? null;
        if (is_null($documents)) {
            return [];
        }
        return $documents;
    }

    public function getProductInformationForAllChallenges(): array
    {
        $query = "*[_type == 'challenge']{
            'sanity_id': _id,
            'id': railcontent_id,
            product_id,
            is_solo
        }";

        $results = $this->sanity->fetch($query);
        return $results;
    }

    /**
     * @param string $brand
     * @return array
     */
    public function getAllChallengesByBrand(?string $brand): array
    {
        $fieldsString = $this->getFieldsString('challenge');
        $brandString = $brand ? " && brand == '$brand'" : '';
        $publishedOnString = $this->getPublishedFilter(false);
        $query = "*[_type == 'challenge' $brandString $publishedOnString]{
            $fieldsString
        }";
        $results = $this->sanity->fetch($query);

        foreach ($results as $index => $document) {
            $this->postProcessDocument($results[$index]);
        }
        return $results;
    }


    /**
     * @param int $railcontentId - railcontent.id value
     * @param string $type - sanity _type value
     * @return array - matching challenge document
     */
    public function getChallengeChildAndParentData(int $railcontentId, ?string $type = null): array
    {
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
        $document = $this->sanity->fetch($query)[0] ?? [];
        $this->postProcessDocument($document);
        return $document;
    }

    public function getChallengeOpenEnrollmentCards(string $brand, bool $isAdmin): array
    {
        $cardStatusQuery = $isAdmin ? '' : '&& is_banner_draft != true';
        $challengeFields = $this->getFieldsString('challenge');
        $publishedOnString = $this->getPublishedFilter(false);
        $now = $this->getRoundedTime()->toISOString();
        $enrollmentDateString = " && enrollment_start_time <= '$now' && '$now' <= enrollment_end_time";
        $query = "*[_type == 'challenge'
            && brand == '$brand'
            $enrollmentDateString
            $publishedOnString
            $cardStatusQuery]{
            display_order,
            $challengeFields,
        }";
        $results = $this->sanity->fetch($query);
        $filtered = [];
        foreach ($results as $document) {
            $this->postProcessDocument($document);
            if (!$document['need_access']) {
                $filtered[] = $document;
            }
        }
        return $filtered;
    }

    public function getChallengePromotionalBannerCards(string $brand, bool $isAdmin): array
    {
        $cardStatusQuery = $isAdmin ? '' : '&& is_banner_draft != true';
        $challengeFields = $this->getFieldsString('challenge');
        $publishedOnString = $this->getPublishedFilter(false);
        $now = $this->getRoundedTime()->toISOString();
        $startDateString = "(is_solo && is_custom_banner && start_time <= '$now' && '$now' <= end_time)";
        $enrollmentDateString = "(enrollment_start_time <= '$now' && '$now' <= enrollment_end_time)";
        $timeFilter = "&& ($startDateString || $enrollmentDateString)";
        $query = "*[_type == 'challenge'
            && brand == '$brand'
            $timeFilter
            $publishedOnString
            $cardStatusQuery]{
            'display_order': coalesce(display_order, 0),
            $challengeFields,
        }";
        $results = $this->sanity->fetch($query);
        $filtered = [];
        foreach ($results as $document) {
            $this->postProcessDocument($document);
            if (!$document['need_access']) { //filter out open enrollment challenges if they don't have access
                $filtered[] = $document;
            }
        }
        return $filtered;
    }

    public function getCustomBannerCards(string $brand, bool $isAdmin): array
    {
        $cardStatusQuery = $isAdmin ? '' : '&& is_draft != true';
        $now = $this->getRoundedTime()->toISOString();
        $timeString = $isAdmin ? '' : "&& start_time <= '$now' && '$now' <= end_time";
        $brandString = $brand ? "&& (brand == '$brand' || !defined(brand))" : '';
        $query = "*[_type == 'banner-card' $timeString $cardStatusQuery $brandString] {
            is_draft,
            header,
            'subheader': sub_header,
            sub_header,
            'squareImg': squareImg.asset->url,
            'wideImg': wideImg.asset->url,
            'bgImg': bgImg.asset->url,
            'logo': logo.asset->url,
            button_text,
            'button_url': coalesce(button_url, content->web_url_path),
            'content_type' : content->_type,
            'content_id' : content->railcontent_id,
            'display_order': coalesce(display_order, 0),
        } | order(start_time desc)";
        return $this->sanity->fetch($query);
    }

    public function getAssignmentsByRailcontentIds(
        $brand,
        array $ids,
        array $parentIds,
        ?string $type = null,
        bool $includeParents = false
    ) {
        $idsString = implode(',', $ids);
        $parentIdsString = implode(',', $parentIds);
        $fieldsString = $this->getFieldsString($type);
        $parentQuery = $includeParents
            ? ", 'parents': *[railcontent_id in (^.parent_content_data[].id)] {  $fieldsString }"
            : '';
        $query = "*[brand == '{$brand}' && railcontent_id in [{$parentIdsString}]]{
          $fieldsString, 'resource':resource[]{resource_name, _key, 'resource_url':  coalesce(
            'https://d3fzm1tzeyr5n3.cloudfront.net'+string::split(resource_aws.asset->fileURL,'https://s3.us-east-1.amazonaws.com/musora-web-platform')[1],
            resource_url
          )} $parentQuery,
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
         'sheet_music_image_url': " . self::SHEET_MUSIC_QUERY . ",
         assignment_timecode,
         assignment_description,
         railcontent_id}
}";
        $documents = $this->sanity->fetch($query);
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
                                return 'L' . collect($document['parent_content_data'])->keyBy(
                                        'id'
                                    )[$parent['id']]['position'];
                            default:
                                return $parent['title'];
                        }
                    })->toArray();
                    $routes = array_reverse($route);
                }
                $routes = array_merge($routes, [$document['title']]);
                $assignments[] = [
                    'title' => $assignment['assignment_title'],
                    'item_type' => 'assignment',
                    'instructors' => $document['instructors'],
                    'instructors_details' => $document['instructors_details'],
                    'thumbnail' => $document['thumbnail'],
                    'difficulty_string' => $document['difficulty_string'],
                    'published_on' => $document['published_on'],
                    'railcontent_id' => $assignment['railcontent_id'],
                    'sheet_music_image_url' => $assignment['sheet_music_image_url'] ?? [],
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

    /**
     * @param string $slug - Challenge Slug value
     * @return array | null - matching challenge document or null
     */
    public function getChallengeEnrollmentPageData(string $slug, string $brand): array|null
    {
        $fieldsString = $this->getFieldsString('challenge-part');
        $brandString = " && brand == '$brand'";
        //$publishedOnString = $this->getPublishedFilter(true);
        $query = "*[slug.current == '$slug' && _type == 'challenge' $brandString]{
                'id': railcontent_id,
                headline,
                subheadline,
                header_description,
                'header_image_url': header_image_url.asset->url,
                cohort_trailer,
                'instructor': instructor[0]->name,
                icon1_title,
                icon1_copy,
                icon2_title,
                icon2_copy,
                icon3_title,
                icon3_copy,
                body_title,
                body_top_description,
                'body_image_url' : body_image_url.asset->url,
                body_logo,
                body_bottom_description,
                dropdown_title,
                bottom_title,
                bottom_description,
                product_id,
                cohort_start_date,
                cohort_end_date,
                conversation_thread_id,
                'icon1_url': icon1_url.asset->url,
                'icon2_url': icon2_url.asset->url,
                'icon3_url': icon3_url.asset->url,
                description_trailer_1,
                'description_trailer_1_thumb_url': description_trailer_1_thumb_url.asset->url,
                description_trailer_2,
                'description_trailer_2_thumb_url': description_trailer_2_thumb_url.asset->url,
                'demo_background_image_url': demo_background_image_url.asset->url,
                'demo_desktop_center_image_url': demo_desktop_center_image_url.asset->url,
                'demo_mobile_center_image_url': demo_mobile_center_image_url.asset->url,
                demo_title_text,
                demo_description_text,
                demo_label_text,
                demo_trailer,
                first_day_text,
                last_day_text,
                benefit_1,
                benefit_2,
                benefit_3,
                is_product,
                product_description_header,
                product_description_body,
                product_original_price,
                product_sale_price,
                'product_image': product_image.asset->url,
                course_description,
                course_product_description,
                get_product_badge,
                product_cart_link,
                product_name,
                product_cart_link_description,
                custom_cohort,
                railcontent_id,
                brand,
                title,
                'light_mode_logo': light_mode_logo_url.asset->url,
                'dark_mode_logo': dark_mode_logo_url.asset->url,
                'logo_image': logo_image_url.asset->url,
                'slug': slug->current,
                'course_id': railcontent_id,
                'brand_id': brand,
                'cohort_title': title,
                'course_url': web_url_path,
                enrollment_end_time,
                enrollment_start_time,
                dropdown,
                is_solo,
                published_on,
                status,
                'type': _type,
                'permission_id': permission[]->railcontent_id,
                'next_lesson': child[0]->{
                    $fieldsString
                }
        } [0 ... 1]";
        $document = $this->sanity->fetch($query)[0] ?? null;
        if ($document) {
            $document['dropdown'] = $document['dropdown'] ?? [];
        }
        $this->postProcessDocument($document);
        return $document;
    }

    /**
     * getOnboardingCard takes in user's information (basic/plus, and skill level) for a given brand and returns a
     * array of the onboarding cards
     * @param string $brand
     * @param string $access_level
     * @param string $difficultyString
     * @param bool $isAdmin
     * @return array
     */
    public function getOnboardingCard(
        string $brand,
        string $access_level,
        string $difficultyString,
        bool $isAdmin = false
    ): array {
        $id = strtolower("onboarding_content_card_" . $brand . '_' . $access_level . '_' . $difficultyString);
        $fieldsString = $this->getFieldsString(null);
        $adminCheck = $isAdmin ? '' : 'is_draft != true';
        $query = "*[_id == '$id'
                    && _type == 'onboarding-content-card'
                    ]{
                        description,
                        access_level,
                        brand,
                        _id,
                        experience_level,

                        'card': card[$adminCheck]
                        {
                            is_draft,
                            header,
                            subheader,
                            'squareImg': squareImg.asset->url,
                            'wideImg': wideImg.asset->url,
                            'bgImg': bgImg.asset->url,
                            'logo': logo.asset->url,
                            'content': content->{
                                _type,
                                'registration_url': '/' + brand + '/enrollment/' + slug.current,
                                $fieldsString
                            }
                        }
                    } [0 ... 1]";
        $document = $this->sanity->fetch($query)[0] ?? null;
        if (is_null($document) || is_null($document['card'])) {
            return $document;
        }
        $formattedCards = [];
        foreach ($document['card'] as $card) {
            $formattedCards[] = $this->formatBannerCardParamaters($card);
        }
        $document['card'] = $formattedCards;

        return $document;
    }

    public function getActiveBannerCards($brand, $isAdmin)
    {
        $statusString = $isAdmin ? '' : '&& is_draft != true';
        $now = $this->getRoundedTime()->toISOString();
        $timeRangeString = "&& start_time <= '$now' && end_time >= '$now'";
        $query = "*[_type == 'banner-card' && brand == '$brand' $statusString $timeRangeString]{
                      brand,
                      display_order,
                      difficulty,
                      name,
                      is_draft,
                      visible_on_desktop,
                      visible_on_mobile,
                      all_but_latest_version,
                      super_title,
                      super_title_colour,
                      title,
                      title_colour,
                      description,
                      description_colour,
                      button_text,
                      'button_url': coalesce(button_url, content->web_url_path),
                      'bgImg' : bgImg.asset->url,
                      'squareImg' : squareImg.asset->url,
                      'wideImg' : wideImg.asset->url,
                      'logo' : logo.asset->url,
                      'content': content->{
                        _type,
                        railcontent_id,
                        web_url_path,
                        'registration_url': '/' + brand + '/enrollment/' + slug.current,
                        enrollment_start_time,
                        enrollment_end_time,
                        is_solo,
                    },
        }";
        $documents = $this->sanity->fetch($query) ?? null;
        $formattedCards = [];
        foreach ($documents as $index => $document) {
            if ($isAdmin || !$document['is_draft']) {
                // TODO ADRIAN - how do we format this data?
                $formattedCards[] = $document['content'] ? [
                    ...$this->formatBannerCardParamaters($document),
                    $document['is_draft']
                ] : $document;
            }
        }
        return $formattedCards;
    }

    private function formatBannerCardParamaters($contentCard)
    {
        $content = $contentCard['content'];
        $type = $content['_type'];
        $contentCard['content_type'] = $type;
        $contentCard['id'] = $content['railcontent_id'];
        $pageType = match ($content['_type']) {
            'challenge' => 'PackOverview',
            'workout' => 'Lesson',
            'course' => 'CourseOverview',
            'quick-tips' => 'Lesson',
            'song' => 'Song',
            default => 'Lesson',
        };
        $pageParams = [
            'id' => $content['railcontent_id'],
            'contentType' => $type,
        ];

        $typesToIncludePageType = ['challenge', 'pack'];
        if (in_array($type, $typesToIncludePageType)) {
            $pageParams['type'] = 'Lesson';
        }
        if ($type == 'challenge') {
            $pageParams['isChallenge'] = true;
        }
        $contentUrl = $type == 'challenge' ? $content['registration_url'] : $content['web_url_path'];
        $contentCard['button'] = [
            'web_url_path' => $contentUrl,
            'page_type' => $pageType,
            'page_params' => $pageParams,
        ];
        return $contentCard;
    }

    public function countLessonsAndAssignments($id)
    {
        $fieldsString = $this->getFieldsString('playlist-item');

        // Fetch only leaf nodes directly, traversing the hierarchy
        $query = "*[railcontent_id == {$id}]{
        $fieldsString,
        'thumbnail': thumbnail.asset->url,
        'assignments':assignment[assignment_soundslice != null]{'railcontent_id': railcontent_id, 'title':assignment_title},
        // Use a recursive-like approach to get only leaf nodes
        'lastChildItems': array::compact(
            child[]-> {
                'id': railcontent_id,
                'type': _type,
                title,
                'thumbnail': thumbnail.asset->url,
                'assignments':assignment[assignment_soundslice != null]{'railcontent_id': railcontent_id, 'title':assignment_title},
                'children': child[]-> {
                    // Fetch child nodes if they exist
                    'id': railcontent_id,
                    'type': _type,
                    title,
                    'thumbnail': thumbnail.asset->url,
                    'assignments':assignment[assignment_soundslice != null]{'railcontent_id': railcontent_id, 'title':assignment_title},
                    'isLeaf': !defined(child)
                }
            }
        )
    }";

        $documents = $this->sanity->fetch($query);

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
                        $assignmentIds[$documents[0]['id']][$assignment['railcontent_id']] = [
                            'id' => $assignment['railcontent_id'],
                            'parent_id' => $documents[0]['id'],
                            'title' => $assignment['title']
                        ];
                        $assignmentsCount++;
                    }
                }
                $leafNodes[] = [
                    'id' => $id,
                    'parent_id' => $parent['id'] ?? null,
                    'title' => $documents[0]['title'],
                    'thumbnail' => $documents[0]['thumbnail']
                ];
            }
            foreach ($documents[0]['lastChildItems'] ?? [] as $item) {
                if (!empty($item['assignments'])) {
                    foreach ($item['assignments'] as $assignment) {
                        $assignmentIds[$item['id']][$assignment['railcontent_id']] = [
                            'id' => $assignment['railcontent_id'],
                            'parent_id' => $item['id'],
                            'title' => $assignment['title']
                        ];
                        $assignmentsCount++;
                    }
                }
                if (isset($item['children'])) {
                    foreach ($item['children'] as $child) {
                        if ($child['isLeaf']) {
                            $leafNodes[] = [
                                'id' => $child['id'],
                                'parent_id' => $item['id'],
                                'title' => $child['title'],
                                'thumbnail' => $child['thumbnail']
                            ];
                            if (!empty($child['assignments'])) {
                                foreach ($child['assignments'] as $assignment) {
                                    $assignmentIds[$item['id']][$assignment['railcontent_id']] = [
                                        'id' => $assignment['railcontent_id'],
                                        'parent_id' => $item['id'],
                                        'title' => $assignment['title']
                                    ];
                                    $assignmentsCount++;
                                }
                            }
                        }
                    }
                } else {
                    $leafNodes[] = [
                        'id' => $item['id'],
                        'parent_id' => $documents[0]['id'],
                        'title' => $item['title'],
                        'thumbnail' => $item['thumbnail']
                    ];
                    if (!empty($item['assignments'])) {
                        foreach ($item['assignments'] as $assignment) {
                            $assignmentIds[$item['id']][$assignment['railcontent_id']] = [
                                'id' => $assignment['railcontent_id'],
                                'parent_id' => $item['id'],
                                'title' => $assignment['title']
                            ];
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
        return [
            ['key' => 'title', 'value' => $document['title'] ?? '', 'position' => 1, 'type' => ''],
            ['key' => 'artist', 'value' => $document['artist_name'] ?? '', 'position' => 1, 'type' => ''],
            ['key' => 'thumbnail_url', 'value' => $document['thumbnail'] ?? '', 'position' => 1, 'type' => ''],
            [
                'key' => 'video',
                'value' => [
                    'fields' => [
                        [
                            'key' => 'length_in_seconds',
                            'value' => $document['length_in_seconds'] ?? '',
                            'position' => 1,
                            'type' => ''
                        ]
                    ],
                    'position' => 1,
                    'type' => ''
                ],
                'position' => 1,
                'type' => ''
            ],
            [
                'key' => 'length_in_seconds',
                'value' => $document['length_in_seconds'] ?? '',
                'position' => 1,
                'type' => ''
            ]
        ];
    }

    public function getExistingPopularityData($contentIds)
    {
        $contentIdString = join(',', $contentIds);
        $query = "*[railcontent_id in [$contentIdString]]{_id, railcontent_id, brand, popularity, 'artistId': artist._ref, 'genreIds': genre[]._ref }";
        return $this->sanity->fetch($query);
    }

    public function getLiveEvents(string $brand, int $buffer = 0): array
    {
        $fields = $this->getFieldsString('live-event');
        $startDate = Carbon::now()->addMinutes($buffer)->toISOString();
        $endDate = Carbon::now()->subMinutes($buffer)->toISOString();

        $query = '*[ live_event_start_time <= "' . $startDate . '"
            && live_event_end_time >= "' . $endDate . '"
            && status == "scheduled"
            && brand == "' . $brand . '"
            ]{
            ' . $fields . ',
        }';

        return $this->sanity->fetch($query);
    }

    public function getScheduledContent(string $brand, array $types)
    {
        $now = $this->getRoundedTime()->toISOString();
        $typesString = implode(
            ',',
            collect($types)->map(function ($type) {
                return "'$type'";
            })->toArray()
        );
        $query = "*[brand == '$brand' && _type in [$typesString] && (status == 'scheduled' || status == 'published') && published_on >= '$now']{
            'id': railcontent_id,
            'type': _type,
            brand,
            title,
            'description': description[0].children[0].text,
            published_on,
            live_event_start_time,
            live_event_end_time,
        } | order(published_on desc) ";

        $documents = $this->sanity->fetch($query);
        return $documents;
    }

    private function postProcessDocument(&$document): void
    {
        if (!$document) {
            return;
        }
        //fix parent_content_data for decorators
        if ($document['parent_content_data'] ?? false) {
            $document['parent_content_data'] = json_encode($document['parent_content_data']);
        }


        $isAdmin = user()?->isAdmin() ?? false;
        $userPermissionIds = $this->getPermissionIds();
        if ($document['type'] == 'challenge' && ($document['lessons'] ?? false)) {
            $this->processNeedsAccessForChildren($document['lessons'], $userPermissionIds, $isAdmin);
        } elseif ($document['type'] == 'challenge-part' && ($document['parent'] ?? false)) {
            $document['parent']['need_access'] = $this->doesUserNeedAccessToContent(
                $document['parent'],
                $userPermissionIds,
                $isAdmin
            );
            $this->processNeedsAccessForChildren($document['parent']['lessons'], $userPermissionIds, $isAdmin);
        }
        $document['need_access'] = $this->doesUserNeedAccessToContent($document, $userPermissionIds, $isAdmin);
    }

    private function processNeedsAccessForChildren(&$lessons, array $userPermissionIds, bool $isAdmin)
    {
        // TODO not sure how this should be best handled as it's context dependent and this will likely break playlist behaviour
        // $playlistAllowedStatuses = [
        //                        ContentService::STATUS_PUBLISHED,
        //                        ContentService::STATUS_SCHEDULED,
        //                        ContentService::STATUS_ARCHIVED
        //                    ];
        // $challengeAllowedStatuses = [ContentService::STATUS_PUBLISHED, ContentService::STATUS_UNLISTED];
        $allowedStatuses = [
            ContentService::STATUS_PUBLISHED,
            ContentService::STATUS_UNLISTED,
            ContentService::STATUS_ARCHIVED,
            ContentService::STATUS_SCHEDULED
        ];
        $lessons = array_filter(
            $lessons,
            function ($lesson) use ($isAdmin, $userPermissionIds, $allowedStatuses) {
                return $isAdmin || (!($lesson['status'] ?? false) || in_array($lesson['status'], $allowedStatuses));
            }
        );

        foreach ($lessons as $index => $lesson) {
            $lessons[$index]['need_access'] = $this->doesUserNeedAccessToContent($lesson, $userPermissionIds, $isAdmin);
        }
    }

    private function doesUserNeedAccessToContent($document, $userPermissionIds, $isAdmin): bool
    {
        if ($isAdmin) {
            return false;
        }
        $documentPermissions = $document['permission_id'] ?? null;
        if (!$documentPermissions || count($documentPermissions) == 0) {
            return false;
        }

        foreach ($documentPermissions as $permission) {
            if (in_array($permission, $userPermissionIds)) {
                return false;
            }
        }
        return true;
    }

    /**
     *  We need to set the published on filter date to be a round time so that it doesn't bypass the query cache
     *  with every request by changing the filter date every second. I've set it to one minute past the current hour
     *  because publishing usually publishes content on the hour exactly which means it should still skip the cache
     *  when the new content is available.
     * @return Carbon
     */
    private function getRoundedTime(): Carbon
    {
        /** @var Carbon $now */
        $now = Carbon::now();
        $roundedNow = Carbon::create($now->year, $now->month, $now->day, $now->hour, 1);
        return $roundedNow;
    }

    /**
     * @param $isSingle
     * @return void
     */
    public function getPublishedFilter($isSingle, $pullFutureContent = false): string
    {
        $now = $this->getRoundedTime()->toISOString();

        if (user()?->isAdmin() ?? false) {
            $statuses = [
                ContentService::STATUS_DRAFT,
                ContentService::STATUS_SCHEDULED,
                ContentService::STATUS_PUBLISHED,
                ContentService::STATUS_ARCHIVED,
                ContentService::STATUS_UNLISTED
            ];
            $getFutureScheduledContentsOnly = true;
        } elseif ($isSingle) {
            $statuses = [
                ContentService::STATUS_SCHEDULED,
                ContentService::STATUS_PUBLISHED,
                ContentService::STATUS_ARCHIVED,
                ContentService::STATUS_UNLISTED
            ];
            $getFutureScheduledContentsOnly = false;
        } else {
            $statuses = [ContentService::STATUS_SCHEDULED, ContentService::STATUS_PUBLISHED];
            $getFutureScheduledContentsOnly = true;
        }

        if ($getFutureScheduledContentsOnly && in_array(ContentService::STATUS_SCHEDULED, $statuses)) {
            $pullFutureContent = true;
            $statuses = array_filter($statuses, function ($status) {
                return $status != ContentService::STATUS_SCHEDULED;
            });
            $statusesString = $this->getStatusesString($statuses);

            $statusString = "&& (status in [$statusesString] || (status == 'scheduled' && defined(published_on) && published_on >= '$now'))";
        } else {
            $statusesString = $this->getStatusesString($statuses);
            $statusString = "&& status in [$statusesString]";
        }
        $publishedOnString = '';
        if (!$pullFutureContent) {
            $publishedOnString = " && published_on <= '$now'";
        }
        return $statusString . $publishedOnString;
    }

    private function getStatusesString(array $statuses): string
    {
        return implode(',', array_map(function ($status) {
            return "'$status'";
        }, $statuses));
    }

    private function getPermissionIds(): array
    {
        if (!user()) {
            return [];
        }
        $this->userPermissionsCached = $this->userPermissionsCached ?? $this->userPermissionsService->getUserPermissionsIds(user()->id, true);
        return $this->userPermissionsCached;
    }
}
