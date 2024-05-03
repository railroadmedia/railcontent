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
 * @property string $receipt
 * @property string $transaction_id
 * @property string $request_type
 * @property string|null $notification_type
 * @property string|null $email
 * @property string $brand
 * @property bool $valid
 * @property string $notification_request_data
 * @property string|null $validation_error
 * @property int|null $payment_id
 * @property int|null $subscription_id
 * @property string|null $raw_receipt_response
 * @property string $purchase_type
 * @property float $local_price
 * @property string $local_currency
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Payment $payment
 *
 */
class AppleReceipt extends Model
{
    public const MOBILE_APP_REQUEST_TYPE = 'mobile';
    public const APPLE_NOTIFICATION_REQUEST_TYPE = 'notification';

    public const APPLE_INITIAL_BUY_NOTIFICATION_TYPE = 'INITIAL_BUY';
    public const APPLE_RENEWAL_NOTIFICATION_TYPE = 'DID_RENEW';
    public const APPLE_CANCEL_NOTIFICATION_TYPE = 'CANCEL';

    public const APPLE_PRODUCT_PURCHASE = 'product';
    public const APPLE_SUBSCRIPTION_PURCHASE = 'subscription';

    protected $table = 'ecommerce_apple_receipts';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id'
    ];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'transaction_id', 'external_id')
            ->where('external_provider', 'apple');
    }

    protected function localPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => floatval($value),
        );
    }
}
