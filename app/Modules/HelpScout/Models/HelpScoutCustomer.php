<?php

namespace App\Modules\HelpScout\Models;

use App\Modules\HelpScout\database\factories\HelpScoutCustomerFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HelpScoutCustomer
 *
 * @internal
 * @package App\Modules\HelpScout\Models
 * @property integer $internal_id
 * @property integer $external_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @method static \App\Modules\HelpScout\database\factories\HelpScoutCustomerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpScoutCustomer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HelpScoutCustomer newQuery()
 * @method static \Illuminate\Database\Query\Builder|HelpScoutCustomer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HelpScoutCustomer query()
 * @method static \Illuminate\Database\Eloquent\Builder|HelpScoutCustomer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpScoutCustomer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpScoutCustomer whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpScoutCustomer whereInternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpScoutCustomer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|HelpScoutCustomer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|HelpScoutCustomer withoutTrashed()
 * @mixin \Eloquent
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
