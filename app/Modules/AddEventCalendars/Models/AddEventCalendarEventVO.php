<?php


namespace App\Modules\AddEventCalendars\Models;


use App\Services\AddEventService;
use Carbon\Carbon;

class AddEventCalendarEventVO
{
    private $internalBrand;
    private $internalTypeOrSlug;
    private $internalId;
    private $internalTitle;
    private $internalPublishedOn;
    private $internalLiveEventStartTime;
    private $internalLiveEventEndTime;
    private $internalLiveStreamFeedType;
    private $internalDescription;

    // This list of "external" properties is copied from AddEvent API Documentation
    // Specifically the List and Create endpoint return examples. Some values appear in one but no the other. These
    // are noted below accordingly.
    private $externalId;
    private $externalCalendar; // returned from create but not list
    private $externalUniqueKey; // returned from create but not list
    private $externalTitle;
    private $externalEventName;
    private $externalDescription;
    private $externalLocation;
    private $externalOrganizer;
    private $externalOrganizerEmail;
    private $externalDateStart;
    private $externalDateStartTime;
    private $externalDateStartAmpm;
    private $externalDateStartUnix; // returned from list but not create
    private $externalDateEnd;
    private $externalDateEndTime;
    private $externalDateEndAmpm;
    private $externalDateEndUnix; // returned from list but not create
    private $externalAllDayEvent;
    private $externalDateFormat;
    private $externalTimezone;
    private $externalReminder;
    private $externalRrule;
    private $externalTemplateId; // returned from create but not list
    private $externalColor;
    private $externalUpdatedTimes;
    private $externalRsvpRequire;
    private $externalRsvpTemplateId;
    private $externalRsvpSeatLimited; // returned from list but not create
    private $externalRsvpSeatLimit; // returned from list but not create
    private $externalRsvpSeatsLeft; // returned from list but not create
    private $externalRsvpInactive; // returned from list but not create
    private $externalRsvpNotify; // returned from list but not create
    private $externalRsvpCount; // returned from list but not create
    private $externalRsvpAttnGoing; // returned from list but not create
    private $externalRsvpAttnMaybe; // returned from list but not create
    private $externalRsvpAttnCantGo; // returned from list but not create
    private $externalCustomData;
    private $externalLinkShort;
    private $externalLinkLong;
    private $externalDateCreate;
    private $externalDateModified;

    private static $defaultEventLengthForContentReleases = 5;

    /**
     * @param $brand
     * @param $typeOrSlug
     * @param $id
     * @param $title
     * @param $publishedOn
     * @param $liveEventStartTime
     * @param $liveStreamFeedType
     * @param $description
     * @return void
     */
    public function setInternalData(
        $brand,
        $typeOrSlug,
        $id,
        $title,
        $publishedOn,
        $liveEventStartTime,
        $liveEventEndTime,
        $liveStreamFeedType,
        $description
    ) {
        $this->internalBrand = $brand;
        $this->internalTypeOrSlug = $typeOrSlug;
        $this->internalId = $id;
        $this->internalTitle = $title;
        $this->internalPublishedOn = $publishedOn;
        $this->internalLiveEventStartTime = $liveEventStartTime;
        $this->internalLiveEventEndTime = $liveEventEndTime;
        $this->internalLiveStreamFeedType = $liveStreamFeedType;
        $this->internalDescription = $description;
    }

    public function setExternalData(
        $externalId = null,
        $externalCalendar = null,
        $externalUniqueKey = null,
        $externalTitle = null,
        $externalEventName = null,
        $externalDescription = null,
        $externalLocation = null,
        $externalOrganizer = null,
        $externalOrganizerEmail = null,
        $externalDateStart = null,
        $externalDateStartTime = null,
        $externalDateStartAmpm = null,
        $externalDateStartUnix = null,
        $externalDateEnd = null,
        $externalDateEndTime = null,
        $externalDateEndAmpm = null,
        $externalDateEndUnix = null,
        $externalAllDayEvent = null,
        $externalDateFormat = null,
        $externalTimezone = null,
        $externalReminder = null,
        $externalRrule = null,
        $externalTemplateId = null,
        $externalColor = null,
        $externalUpdatedTimes = null,
        $externalRsvpRequire = null,
        $externalRsvpTemplateId = null,
        $externalRsvpSeatLimited = null,
        $externalRsvpSeatLimit = null,
        $externalRsvpSeatsLeft = null,
        $externalRsvpInactive = null,
        $externalRsvpNotify = null,
        $externalRsvpCount = null,
        $externalRsvpAttnGoing = null,
        $externalRsvpAttnMaybe = null,
        $externalRsvpAttnCantGo = null,
        $externalCustomData = null,
        $externalLinkShort = null,
        $externalLinkLong = null,
        $externalDateCreate = null,
        $externalDateModified = null
    ) {
        $this->externalId = $externalId;
        $this->externalCalendar = $externalCalendar;
        $this->externalUniqueKey = $externalUniqueKey;
        $this->externalTitle = $externalTitle;
        $this->externalEventName = $externalEventName;
        $this->externalDescription = $externalDescription;
        $this->externalLocation = $externalLocation;
        $this->externalOrganizer = $externalOrganizer;
        $this->externalOrganizerEmail = $externalOrganizerEmail;
        $this->externalDateStart = $externalDateStart;
        $this->externalDateStartTime = $externalDateStartTime;
        $this->externalDateStartAmpm = $externalDateStartAmpm;
        $this->externalDateStartUnix = $externalDateStartUnix;
        $this->externalDateEnd = $externalDateEnd;
        $this->externalDateEndTime = $externalDateEndTime;
        $this->externalDateEndAmpm = $externalDateEndAmpm;
        $this->externalDateEndUnix = $externalDateEndUnix;
        $this->externalAllDayEvent = $externalAllDayEvent;
        $this->externalDateFormat = $externalDateFormat;
        $this->externalTimezone = $externalTimezone;
        $this->externalReminder = $externalReminder;
        $this->externalRrule = $externalRrule;
        $this->externalTemplateId = $externalTemplateId;
        $this->externalColor = $externalColor;
        $this->externalUpdatedTimes = $externalUpdatedTimes;
        $this->externalRsvpRequire = $externalRsvpRequire;
        $this->externalRsvpTemplateId = $externalRsvpTemplateId;
        $this->externalRsvpSeatLimited = $externalRsvpSeatLimited;
        $this->externalRsvpSeatLimit = $externalRsvpSeatLimit;
        $this->externalRsvpSeatsLeft = $externalRsvpSeatsLeft;
        $this->externalRsvpInactive = $externalRsvpInactive;
        $this->externalRsvpNotify = $externalRsvpNotify;
        $this->externalRsvpCount = $externalRsvpCount;
        $this->externalRsvpAttnGoing = $externalRsvpAttnGoing;
        $this->externalRsvpAttnMaybe = $externalRsvpAttnMaybe;
        $this->externalRsvpAttnCantGo = $externalRsvpAttnCantGo;
        $this->externalCustomData = $externalCustomData;
        $this->externalLinkShort = $externalLinkShort;
        $this->externalLinkLong = $externalLinkLong;
        $this->externalDateCreate = $externalDateCreate;
        $this->externalDateModified = $externalDateModified;
    }

    public function getExternalId()
    {
        return $this->externalId;
    }

    public function getExternalCustomDataArray()
    {
        return json_decode($this->externalCustomData, true);
    }

    public function getExternalSyncId()
    {
        return $this->getExternalCustomDataArray()[AddEventService::SYNC_ID_KEY] ?? null;
    }

    public function getInternalSyncId()
    {
        return $this->internalId . '_' . $this->internalBrand . '_' . $this->internalTypeOrSlug;
    }

    public function getTitleToSync()
    {
        /*
         * If the lesson title is something like "#101 - MmmBop" it doesn't make for a good event title in a calendar.
         * Constrained to Student Collaborations because that's where it was observed.
         */
        if ($this->internalTypeOrSlug === 'student-collaborations') {
            $startWithPoundCharacter = strpos($this->internalTitle, '#') === 0;
            if ($startWithPoundCharacter) {
                return 'Student Collaboration ' . $this->internalTitle;
            }
        }

        return $this->internalTitle;
    }

    public function getDescriptionToSync()
    {
        $url = 'https://www.musora.com/' . $this->internalBrand . '/content/' . $this->internalId;

        if($this->internalTypeOrSlug === 'live' || $this->internalTypeOrSlug === 'question-and-answer') {

            $liveUrl = 'https://www.musora.com/' . $this->internalBrand . '/live/';

            $addEventDescriptionPrepend = 'Click this link to access the live stream: <br> ' . $liveUrl;

            $addEventDescriptionAppend = 'Can\'t make it to the live stream? No problem! You can find it in our ' .
                'archives 2-3 business days after the event through this link: <br> ' . $url;

            if (empty($this->internalDescription)) {
                return $addEventDescriptionPrepend . ' <br><br> ' . $addEventDescriptionAppend;
            }

            return $addEventDescriptionPrepend . ' <br> ' . $this->internalDescription . ' <br> ' . $addEventDescriptionAppend;
        }

        if (empty($this->internalDescription)) {
            return $url;
        }

        return $url . ' <br> ' . $this->internalDescription;
    }

    /**
     * @return Carbon
     * @throws \Exception
     */
    public function getStartTimeToSync(): Carbon
    {
        if (!empty($this->internalLiveEventStartTime) && ($this->internalLiveEventStartTime != 'Invalid date')) {
            return Carbon::parse($this->internalLiveEventStartTime);
        }

        if (!$this->internalPublishedOn) {
            throw new \Exception('No start date set on lesson');
        }
        return Carbon::parse($this->internalPublishedOn);
    }

    /**
     * @return Carbon
     * @throws \Exception
     */
    public function getEndTimeToSync()
    {
        if (($this->internalLiveEventEndTime != 'Invalid date') && !empty($this->internalLiveEventEndTime)) {
            return Carbon::parse($this->internalLiveEventEndTime);
        }

        if (!$this->internalPublishedOn) {
            throw new \Exception('No End date set on lesson');
        }

        return Carbon::parse($this->internalPublishedOn)
            ->addMinutes(self::$defaultEventLengthForContentReleases);
    }

    public function getCustomDataArrayToSync()
    {
        // todo ...?
    }

    public function apiCreateRequired()
    {
        return empty($this->externalId);
    }

    public function apiUpdateRequired($verbose = false)
    {
        $titleSame = !$this->apiUpdateRequiredByTitle($verbose);
        $descriptionSame = !$this->apiUpdateRequiredByDescription($verbose);
        $startTimeSame = !$this->apiUpdateRequiredByStart($verbose);
        $endTimeSame = !$this->apiUpdateRequiredByEnd($verbose);

        $allSame = $titleSame && $descriptionSame && $startTimeSame && $endTimeSame;

        return !$allSame;
    }

    public function apiUpdateRequiredByTitle($verbose = false)
    {
        $titleSame = $this->internalTitle == $this->externalTitle;

        $updateRequired = !$titleSame;

        if ($verbose && $updateRequired) {
            var_export([
                'message' => "api update required for content $this->internalId",
                'property-prompting-update' => "title",
                'internal (content) value' => $this->internalTitle,
                'external (event) value' => $this->externalTitle,
            ]);
        }
        return $updateRequired;
    }

    public function apiUpdateRequiredByDescription($verbose = false)
    {
        $descriptionSame = $this->getDescriptionToSync() == $this->externalDescription;

        $updateRequired = !$descriptionSame;

        if ($verbose && $updateRequired) {
            var_export([
                'message' => "api update required for content $this->internalId",
                'property-prompting-update' => "description",
                'internal (content) value' => $this->getDescriptionToSync(),
                'external (event) value' => $this->externalDescription,
            ]);
        }
        return $updateRequired;
    }

    public function apiUpdateRequiredByStart($verbose = false)
    {
        $internalStartTimeObj = Carbon::parse($this->getStartTimeToSync());
        $externalStartTimeObj = Carbon::createFromTimestamp($this->externalDateStartUnix);
        $startTimeSame = $internalStartTimeObj->eq($externalStartTimeObj);

        $updateRequired = !$startTimeSame;

        if ($verbose && $updateRequired) {
            var_export([
                'message' => "api update required for content $this->internalId",
                'property-prompting-update' => "start time",
                'internal (content) value' => $internalStartTimeObj->toDateTimeString(),
                'external (event) value' => $externalStartTimeObj->toDateTimeString(),
            ]);
        }
        return $updateRequired;
    }

    public function apiUpdateRequiredByEnd($verbose = false)
    {
        $internalEndTimeObj = Carbon::parse($this->getEndTimeToSync());
        $externalEndTimeObj = Carbon::createFromTimestamp($this->externalDateEndUnix);
        $endTimeSame = $internalEndTimeObj->eq($externalEndTimeObj);

        $updateRequired = !$endTimeSame;

        if ($verbose && $updateRequired) {
            var_export([
                'message' => "api update required for content $this->internalId",
                'property-prompting-update' => "end time",
                'internal (content) value' => $internalEndTimeObj->toDateTimeString(),
                'external (event) value' => $externalEndTimeObj->toDateTimeString(),
            ]);
        }
        return $updateRequired;
    }

    public function apiDeleteRequired()
    {
        // todo ...?
    }

    public static function generateSyncId()
    {
        // todo ...?
    }

}
