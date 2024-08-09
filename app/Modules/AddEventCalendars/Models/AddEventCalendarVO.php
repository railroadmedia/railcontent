<?php

namespace App\Modules\AddEventCalendars\Models;

use App\Services\AddEventService;

class AddEventCalendarVO
{
    private $externalId;
    private $externalUniquekey;
    private $externalTitle;
    private $externalDescription;
    private $externalFollowersActive;
    private $externalFollowersTotal;
    private $externalEventsTotal;
    private $externalMainCalendar;
    private $externalCustomData;
    private $externalTemplateId;
    private $externalLinkShort;
    private $externalLinkLong;
    private $externalDateCreate;
    private $externalDateModified;

    private $internalContentId;
    private $internalContentBrand;
    private $internalContentType;
    private $internalContentTitle;
    private $internalContentDescription;

    /**
     * @param $externalId
     * @param $externalUniquekey
     * @param $externalTitle
     * @param $externalDescription
     * @param $externalFollowersActive
     * @param $externalFollowersTotal
     * @param $externalEventsTotal
     * @param $externalMainCalendar
     * @param $externalCustomData
     * @param $externalTemplateId
     * @param $externalLinkShort
     * @param $externalLinkLong
     * @param $externalDateCreate
     * @param $externalDateModified
     */
    public function setExternalData(
        $externalId,
        $externalUniquekey,
        $externalTitle,
        $externalDescription,
        $externalFollowersActive,
        $externalFollowersTotal,
        $externalEventsTotal,
        $externalMainCalendar,
        $externalCustomData,
        $externalTemplateId,
        $externalLinkShort,
        $externalLinkLong,
        $externalDateCreate,
        $externalDateModified
    ) {
        $this->externalId = $externalId;
        $this->externalUniquekey = $externalUniquekey;
        $this->externalTitle = $externalTitle;
        $this->externalDescription = $externalDescription;
        $this->externalFollowersActive = $externalFollowersActive;
        $this->externalFollowersTotal = $externalFollowersTotal;
        $this->externalEventsTotal = $externalEventsTotal;
        $this->externalMainCalendar = $externalMainCalendar;
        $this->externalCustomData = $externalCustomData;
        $this->externalTemplateId = $externalTemplateId;
        $this->externalLinkShort = $externalLinkShort;
        $this->externalLinkLong = $externalLinkLong;
        $this->externalDateCreate = $externalDateCreate;
        $this->externalDateModified = $externalDateModified;
    }

    /**
     * @param $internalContentId
     * @param $internalContentBrand
     * @param $internalContentType
     * @param $internalContentTitle
     */
    public function setInternalData(
        $internalContentId,
        $internalContentBrand,
        $internalContentType,
        $internalContentTitle,
        $internalContentDescription
    ) {
        $this->internalContentId = $internalContentId;
        $this->internalContentBrand = $internalContentBrand;
        $this->internalContentType = $internalContentType;
        $this->internalContentTitle = $internalContentTitle;
        $this->internalContentDescription = $internalContentDescription;
    }

    /**
     * @return string
     */
    public function getExternalId(): string
    {
        return $this->externalId;
    }

    /**
     * The syncId is used to figure out which internal content id or data correlates to which calendar from the API.
     * @return string|null
     */
    public function getExternalCustomDataArray(): ?string
    {
        return json_decode($this->externalCustomData, true);
    }

    /**
     * The syncId is used to figure out which internal content id or data correlates to which calendar from the API.
     * @return string|null
     */
    public function getExternalSyncId(): ?string
    {
        return $this->getExternalCustomDataArray()['generated_id'] ?? null;
    }

    /**
     * The syncId is used to figure out which internal content id or data correlates to which calendar from the API.
     * @return string
     */
    public function getInternalSyncId(): string
    {
        return self::generateSyncId($this->internalContentId, $this->internalContentBrand, $this->internalContentType);
    }

    /**
     * @return string
     */
    public function getTitleToSync(): string
    {
        return ucwords($this->internalContentBrand) . ' - ' . $this->internalContentTitle;
    }

    /**
     * @return string
     */
    public function getDescriptionToSync(): string
    {
        // todo: prepend this with a link to the content catalogue page, with something like this:

        //        if($isCoachesCalendar){
        //            $catalogueUrlEnd = '';  // todo: how to get this?
        //        } else {
        //            $catalogueUrlEnd = config('addevent.' . $brand . '.content-type-to-catalogue-url-end-map'); // todo: how to get this?
        //        }
        //        $url = 'https://www.' . $this->internalContentBrand . '.com/members/' . $catalogueUrlEnd;
        //
        //        if (empty($this->internalContentDescription)) {
        //            return $url;
        //        }
        //
        //        return $url . ' ' . PHP_EOL . ' ' . PHP_EOL . $this->internalContentDescription;

        return $this->internalContentDescription;
    }

    /**
     * @return array
     */
    public function getCustomDataArrayToSync(): array
    {
        return [
            AddEventService::SYNC_ID_KEY => $this->getInternalSyncId(),
            'content_id' => $this->internalContentId,
            'content_brand' => $this->internalContentBrand,
            'content_type' => $this->internalContentType,
        ];
    }

    /**
     * @return bool
     */
    public function apiCreateRequired(): bool
    {
        return empty($this->externalId);
    }

    /**
     * @return bool
     */
    public function apiUpdateRequired(): bool
    {
        return ($this->getTitleToSync()) != $this->externalTitle ||
            $this->getDescriptionToSync() != $this->externalDescription;
    }

    /**
     * Should only be true if the getExternalCustomDataArray matches the passed in args but the internal content id is null? TBD
     * @return bool
     */
    public function apiDeleteRequired(): bool
    {
        return false;
    }

    /**
     * @param $contentId
     * @param $contentBrand
     * @param $contentType
     * @return string
     */
    public static function generateSyncId($contentId, $contentBrand, $contentType): string
    {
        return $contentId . '_' . $contentBrand . '_' . $contentType;
    }
}
