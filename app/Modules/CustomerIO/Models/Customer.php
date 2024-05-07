<?php

namespace App\Modules\CustomerIO\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Customer
 *
 * @package App\Modules\CustomerIO\Models
 * @property integer $id
 * @property string $uuid
 * @property string $email
 * @property string $user_id
 * @property string $workspace_name
 * @property string $workspace_id
 * @property string $site_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @property int $internal_id
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Query\Builder|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereInternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereSiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereWorkspaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereWorkspaceName($value)
 * @method static \Illuminate\Database\Query\Builder|Customer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Customer withoutTrashed()
 * @mixin \Eloquent
 */
class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customer_io_customers';
    protected $primaryKey = 'internal_id';

    /**
     * When this hydrated from the API it will be an array of key value pairs.
     *
     * @var bool|array
     */
    private $externalAttributes = false;

    /**
     * Customer constructor.
     */
    public function __construct(array $attributes = [])
    {
        $this->setConnection(config('customer-io.database_connection_name'));

        parent::__construct($attributes);
    }

    public function generateUUID()
    {
        $this->uuid = bin2hex(openssl_random_pseudo_bytes(16));
    }

    /**
     * @return array|bool
     */
    public function getExternalAttributes()
    {
        if ($this->externalAttributes === false) {
            return $this->externalAttributes;
        }

        foreach ($this->externalAttributes as $externalAttributeName => $externalAttributeValue) {
            if ($externalAttributeValue === 'true') {
                $this->externalAttributes[$externalAttributeName] = true;
            }

            if ($externalAttributeValue === 'false') {
                $this->externalAttributes[$externalAttributeName] = false;
            }

            if (is_numeric($externalAttributeValue)) {
                $this->externalAttributes[$externalAttributeName] = (int)$externalAttributeValue;
            }
        }

        return $this->externalAttributes;
    }

    /**
     * @param  array|bool  $externalAttributes
     */
    public function setExternalAttributes($externalAttributes): void
    {
        $this->externalAttributes = $externalAttributes;
    }
}
