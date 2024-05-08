<?php

namespace Railroad\Railcontent\Events;

class UserContentProgressCompleted extends UserContentProgressStatusUpdated
{
  /**
   * @param int $userId
   * @param int $contentId
   * @param $progressPercent
   */
  public function __construct($userId, $contentId, $progressPercent)
  {
    $this->userId = $userId;
    $this->contentId = $contentId;
    $this->progressPercent = $progressPercent;
    $this->progressStatus = 'completed';
  }
}
