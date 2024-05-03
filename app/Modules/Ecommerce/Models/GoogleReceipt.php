<?php

namespace App\Modules\Ecommerce\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class GoogleReceipt
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property int $id
 * @property string $purchase_token
 * @property string $package_name
 * @property string $product_id
 * @property string $request_type
 * @property string|null $notification_type
 * @property string|null $email
 * @property string $brand
 * @property bool $valid
 * @property string|null $validation_error
 * @property string $order_id
 * @property string|null $raw_receipt_response
 * @property string $purchase_type
 * @property float $local_price
 * @property string $local_currency
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Payment $payment
 *
 */
class GoogleReceipt extends Model
{
    public const MOBILE_APP_REQUEST_TYPE = 'mobile';
    public const GOOGLE_NOTIFICATION_REQUEST_TYPE = 'notification';
    public const GOOGLE_RENEWAL_NOTIFICATION_TYPE = 'renewal';
    public const GOOGLE_CANCEL_NOTIFICATION_TYPE = 'cancel';
    public const GOOGLE_PRODUCT_PURCHASE = 'product';
    public const GOOGLE_SUBSCRIPTION_PURCHASE = 'subscription';

    protected $table = 'ecommerce_google_receipts';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id'
    ];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'order_id', 'external_id')
            ->where('external_provider', 'google');
    }

    protected function localPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => floatval($value),
        );
    }
}
