<?php

namespace App\Modules\AddEventCalendars\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $uniquekey
 * @property string $title
 */
class AddEventCalendar extends Model
{
    protected $table = 'add_event_calendars';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
