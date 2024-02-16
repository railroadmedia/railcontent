<?php

namespace App\Modules\Ecommerce\Enums;

enum ShopifyTagEnum: string
{
    case Apple = 'Apple';
    case AppleMobileAppOrder = 'Apple Mobile App Order';
    case Drumeo = 'Drumeo';
    case Google = 'Google';
    case Subscription = 'Subscription';
    case SubscriptionFirstOrder = 'Subscription First Order';
    case SubscriptionRecurringOrder = 'Subscription Recurring Order';
    case Web = 'Web';

    case InitialOrder = 'Initial Order';
    case TrialStart = 'Trial Start';
    case TrialConversion = 'Trial Conversion';
    case MembershipRenewal = 'Membership Renewal';

    case  ThirtyDayTrial = '30-Day Trial';
    case SevenDayTrial = '7-Day Trial';
    case Accessories = 'Accessories';
    case Books = 'Books';
    case Challenges = 'Challenges';
    case Clothing = 'Clothing';
    case DigitalOneTime = 'Digital one time';
    case DigitalSubscription = 'Digital Subscription';
    case Gear = 'Gear';
    case Hats = 'Hats';
    case Lessons = 'Lessons';
    case Membership = 'Membership';
    case Packs = 'Packs';
    case Public = 'Public';
    case Shirt = 'Shirt';
    case Sweaters = 'Sweaters';
    case TShirts = 'T-Shirts';
    case TestTag = 'test tag';
    case Tools = 'Tools';
    case TrialProduct = 'Trial Product';

    /**
     * Get all tag enums used for Products
     *
     * @return ShopifyTagEnum[]
     */
    public function productTags(): array
    {
        return [
            self::ThirtyDayTrial,
            self::SevenDayTrial,
            self::Accessories,
            self::Books,
            self::Challenges,
            self::Clothing,
            self::DigitalOneTime,
            self::DigitalSubscription,
            self::Drumeo,
            self::Gear,
            self::Hats,
            self::Lessons,
            self::Membership,
            self::Packs,
            self::Public,
            self::Shirt,
            self::Sweaters,
            self::TShirts,
            self::TestTag,
            self::Tools,
            self::TrialProduct,
        ];
    }

    /**
     * Get all tag enums used for Orders
     *
     * @return ShopifyTagEnum[]
     */
    public function orderTags(): array
    {
        return [
            self::Apple,
            self::AppleMobileAppOrder,
            self::Drumeo,
            self::Google,
            self::Subscription,
            self::SubscriptionFirstOrder,
            self::SubscriptionRecurringOrder,
            self::Web,
            self::InitialOrder,
            self::TrialStart,
            self::TrialConversion,
            self::MembershipRenewal,
        ];
    }
}
