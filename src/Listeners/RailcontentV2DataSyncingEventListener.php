<?php

namespace Railroad\Railcontent\Listeners;

use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Events\ContentDatumCreated;
use Railroad\Railcontent\Events\ContentDatumDeleted;
use Railroad\Railcontent\Events\ContentDatumUpdated;
use Railroad\Railcontent\Events\ContentDeleted;
use Railroad\Railcontent\Events\ContentFieldCreated;
use Railroad\Railcontent\Events\ContentFieldDeleted;
use Railroad\Railcontent\Events\ContentFieldUpdated;
use Railroad\Railcontent\Events\ContentSoftDeleted;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Events\HierarchyUpdated;
use Railroad\Railcontent\Events\UserContentProgressSaved;

class RailcontentV2DataSyncingEventListener
{
    public function handleContentCreated(ContentCreated $contentCreated)
    {
    }

    public function handleContentUpdated(ContentUpdated $contentUpdated)
    {
    }

    public function handleContentDeleted(ContentDeleted $contentDeleted)
    {
    }

    public function handleContentSoftDeleted(ContentSoftDeleted $contentSoftDeleted)
    {
    }

    public function handleContentFieldCreated(ContentFieldCreated $contentFieldCreated)
    {
    }

    public function handleContentFieldUpdated(ContentFieldUpdated $contentFieldUpdated)
    {
    }

    public function handleContentFieldDeleted(ContentFieldDeleted $contentFieldDeleted)
    {
    }

    public function handleContentDatumCreated(ContentDatumCreated $contentDatumCreated)
    {
    }

    public function handleContentDatumUpdated(ContentDatumUpdated $contentDatumUpdated)
    {
    }

    public function handleContentDatumDeleted(ContentDatumDeleted $contentDatumDeleted)
    {
    }

    public function handleUserContentProgressSaved(UserContentProgressSaved $userContentProgressSaved)
    {
    }

    public function handleHierarchyUpdated(HierarchyUpdated $hierarchyUpdated)
    {
    }
}