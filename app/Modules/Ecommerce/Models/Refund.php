<?php

namespace App\Modules\Ecommerce\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Refund
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property int $id
 * @property float $payment_amount
 * @property float $refunded_amount
 * @property int $shopify_id
 * @property string $note
 * @property string $external_provider
 * @property string $external_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class Refund extends Model
{
    protected $table = 'ecommerce_refunds';
    protected $primaryKey = 'id';

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
