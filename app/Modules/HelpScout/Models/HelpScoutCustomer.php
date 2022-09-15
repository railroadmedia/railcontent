<?php

namespace App\Modules\HelpScout\Models;

use App\Modules\HelpScout\database\factories\HelpScoutCustomerFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HelpScoutCustomer
 * @internal
 *
 * @package App\Modules\HelpScout\Models
 *
 * @property integer $internal_id
 * @property integer $external_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 */
class HelpScoutCustomer extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'helpscout_customers';

    protected $primaryKey = 'internal_id';

    protected static function newFactory(): HelpScoutCustomerFactory
    {
        return HelpScoutCustomerFactory::new();
    }
}
