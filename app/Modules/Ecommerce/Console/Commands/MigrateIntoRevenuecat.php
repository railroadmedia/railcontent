<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;

use App\Modules\Ecommerce\ApiGateways\RevenueCatApiGateway;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Services\RevenueCatService;
use App\Modules\Ecommerce\Services\SubscriptionService;
use App\Modules\Ecommerce\Services\UserProductService;
use Carbon\Carbon;
use Modules\Ecommerce\Models\SubscriptionPayment;
use Railroad\Ecommerce\Gateways\RevenueCatGateway;
use Modules\UserManagementSystem\Models\User;


class MigrateIntoRevenuecat extends Command
{
    protected $signature = 'ecommerce:migrateIntoRevenuecat';

    protected $description = 'Check subscriptions migrated into Revenuecat';

    public function handle(
        RevenueCatService $revenueCatService,
        RevenueCatGateway $revenueCatGateway,
        SubscriptionService $subscriptionService,
        UserProductService $userProductService
    ) {

//               $user = User::query()->where('id', 597285)->first();
//              // dd($user);
//                $res = $revenueCatGateway->sendRequest(
//                    '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',
//                    $user,
//                    'drumeo_app_1_month_2021',
//                    'ios',
//                    '29.99',
//                    'USD',
//                    'Drumeo'
//                );
//         dd($res);

        $res = [ 251994,
     341420,
     341638,
     342523,
     345900,
     344465,
     346231,
     346680,
     356282,
     356286,
     357444,
     348752,
     350750,
     344661,
     361435,
     361906,
//     340815,
     218340,
     363639,
    // 364096,
     309028,
     388650,
     358012,
     345669,
    306028,
    390015,
     // 403795,
     404273,
   //  392732,
    407419,
     326159,
     408948,
     409442,
     341298,
   // 390882,
     405849,
     410813,
     401974,
     413977,
     350178,
     288724,
     414765,
     417243,
    423899,
     423706,
    413321,
     425044,
     349541,
     426645, 345984,
     350518,
     347274,
     427955,
     428618,
   //  412712,
     426038,
     323726,
     436198,
  //   437838,
    440253,
     439060,
     440612,
    346616,
   //  409997, - wrong product
   // 387018,
     444291,
    453035,
     453337,
//     453971,
   // 350256,
     398034,
   //  403317,
 453089,
// 460346,
// 460220,
//455198,
 477587,
 413031,
 421032,
349138,
// 486089,
 499173,
//490721,
 387344,
 503504,
//487479,
 389983,
356935,
// 454743,
508542,
 508721,
 504307,
// 397942,
// 440958,
 509618,
 510089,
 514742,
515971,
364364,
515830,
 517254,
518030,
 518021,
519515,
// 507045,
 439150,
519954,
 525509,



 432402,
524346,
// 478275,
 343983,
// 532750,
// 520935,
528215,
 361881,
 534740,
397915,
 517528,
 536782,
 530175,
 538237,
 536798,
 539189,
 534402,
 540372,
540683,
 541403,
// 541443,
 // 516939,   - expiration with unknown reason
 //500764, - expiration with unknown reason
 450810,
 543041,
 485568,
519610,
 402987,
// 549890,
 538333,
538067,
 534046,
 530607,
452372,
 526739,
515374,
 508212,
427652,
 // 510084, - produs gresit
 453287,
 490638,
 // 489101,
 484772,
 477665,
471989,
 // 441192,
 457443,
 // 456576, - produs gresit
 456715,
// 456771,
 448255,
 448235,
 429094,
//425372, - produs gresit
452481,
 552562,
 527902,
//533623,
554734,];
        $res2 = [
    '555105' => 555105,
    '559619' => 559619,
   // '361979' => 361979,
    '486443' => 486443,
    '562458' => 562458,
    '562024' => 562024,
    '563212' => 563212,
    '537021' => 537021,
   // '567051' => 567051,
    '415998' => 415998,
    '566581' => 566581,
   // '566395' => 566395, - produs gresit
    '566673' => 566673,
    '567699' => 567699,
    '568556' => 568556,
    '503039' => 503039,
   // '552228' => 552228,
    '538551' => 538551,
    '570967' => 570967,
    '571130' => 571130,
    '539436' => 539436,
//    '539586' => 539586,
    '572961' => 572961,
    '337048' => 337048,
//    '557748' => 557748,
    '345438' => 345438,
    '573559' => 573559,
    '575027' => 575027,
    '568375' => 568375,
    '549888' => 549888,
    '568304' => 568304,
    '446391' => 446391,
    '426113' => 426113,
    '354268' => 354268,
    '322250' => 322250,
    '454165' => 454165,
    '580034' => 580034,
   // '330336' => 330336, - ciudat
    //'575499' => 575499,
    '409237' => 409237,
    '579809' => 579809,
   // '582141' => 582141, - produs gresit
   // '567551' => 567551, - produs gresit
    //'584069' => 584069,
    '584633' => 584633,
    '585154' => 585154,
    '585784' => 585784,
    '572058' => 572058,
   // '588781' => 588781,
   // '519732' => 519732,
    '513261' => 513261,
    '508354' => 508354,
    '591506' => 591506,
    '435294' => 435294,
    '365210' => 365210,
   // '595313' => 595313,
    '597980' => 597980,
   // '577942' => 577942,
  //  '588417' => 588417,
   // '338421' => 338421,
    '599119' => 599119,
    '599157' => 599157,
  //  '601358' => 601358,
    '564672' => 564672,
    '513978' => 513978,
  //  '606649' => 606649,  - verific webhook
    '607910' => 607910,
  //  '586537' => 586537,
    //'525218' => 525218,
    '584154' => 584154,
   // '568846' => 568846,
    '588134' => 588134,
  //  '613132' => 613132,
    // '553785' => 553785,  - ciudat
    '516872' => 516872,
    //'555967' => 555967,
    //'591921' => 591921,  -- IMPORTSANT
    '566607' => 566607,
    '614625' => 614625,
    '615005' => 615005,
    '524816' => 524816,
  //  '581422' => 581422,
    '477793' => 477793,
    '586791' => 586791,
    '616117' => 616117,
    '592487' => 592487,
   // '604040' => 604040, - IMPORTANT
    '592607' => 592607,
    '616456' => 616456,
    '616606' => 616606,
    '597285' => 597285,
    '600286' => 600286,
    '586141' => 586141,
    '618219' => 618219,
    '616951' => 616951,
    '617500' => 617500,
    '617746' => 617746,
    '619385' => 619385,
    '619440' => 619440,
    '619446' => 619446,
    '619536' => 619536,
    '435527' => 435527,
    '619695' => 619695,
    '619712' => 619712,
    '619755' => 619755,
    '619826' => 619826,
    '619834' => 619834,
    '619872' => 619872,
    '619882' => 619882,
    '619985' => 619985,
    '620029' => 620029,
    '620046' => 620046,
    '620049' => 620049,
    '525517' => 525517,
    '620082' => 620082,
    '620086' => 620086,
    '620139' => 620139,
    '620142' => 620142,
    '519322' => 519322,
    '620212' => 620212,
  //  '568357' => 568357,  - nu stiu
    '620253' => 620253,
    '620266' => 620266,
    '620288' => 620288,
    '490944' => 490944,
  //  '504877' => 504877,
    '620503' => 620503,
    '620521' => 620521,
    '620772' => 620772,
    '595709' => 595709,
    '620919' => 620919,
    '607299' => 607299,
    '613343' => 613343,
    '613683' => 613683,
    '613824' => 613824,
    '613860' => 613860,
    '613889' => 613889,
    '614094' => 614094,
    '568741' => 568741,
    '614734' => 614734,
    '615044' => 615044,
    '615267' => 615267,
    '615393' => 615393,
    '615779' => 615779,
    '615860' => 615860,
    '616193' => 616193,
    '616232' => 616232,
    '616840' => 616840,
    '617081' => 617081,
    '617158' => 617158,
    '617585' => 617585,
    '617870' => 617870,
    '618177' => 618177,
    '618299' => 618299,
    '618450' => 618450,
    '444711' => 444711,
    '612049' => 612049,
    '618762' => 618762,
    '514284' => 514284,
    '325499' => 325499,
    '523401' => 523401,
    '524798' => 524798,
    '536528' => 536528,
    '555190' => 555190,
    '566595' => 566595,
    '573526' => 573526,
    '577599' => 577599,
    '595433' => 595433,
    '597365' => 597365,
    '598296' => 598296,
    '602980' => 602980,
    '607536' => 607536,
    '440816' => 440816,
    '479788' => 479788,
    '500116' => 500116,
    '513730' => 513730,
    '488037' => 488037,
];

        $resPianote = [
//            '437114' => 437114,
//    '443003' => 443003,
//    '444740' => 444740,
   // '463216' => 463216,
    '473249' => 473249,
    '476586' => 476586,
    '484350' => 484350,
    '432847' => 432847,
    '484522' => 484522,
    '338903' => 338903,
    '524819' => 524819,
    '528574' => 528574,
    '528390' => 528390,
   // '522779' => 522779,
    '506857' => 506857,
    '533543' => 533543,
    '428968' => 428968,
    '527655' => 527655,
    '506156' => 506156,
    '537389' => 537389,
    '539493' => 539493,
    '532324' => 532324,
    '541966' => 541966,
    '540451' => 540451,
    '531050' => 531050,
    '535398' => 535398,
    '543226' => 543226,
    '540349' => 540349,
    '520698' => 520698,
    '545976' => 545976,
    //'548721' => 548721, - need to investigate
    '526616' => 526616,
    '455774' => 455774,
    //'430454' => 430454,
    //'510883' => 510883,
    '436900' => 436900,
    '542091' => 542091,
    '552962' => 552962,
    '539958' => 539958,
    //'545048' => 545048,
    '478016' => 478016,
    '563073' => 563073,
    '565077' => 565077,
    '565876' => 565876,
    '568769' => 568769,
    '572593' => 572593,
    '551954' => 551954,
    '571505' => 571505,
   // '571528' => 571528,
    '550962' => 550962,
    '429063' => 429063,
    '578730' => 578730,
    '429714' => 429714,
    '581525' => 581525,
    '581220' => 581220,
   // '583709' => 583709,
    '588374' => 588374,
   // '387018' => 387018,
    '588567' => 588567,
    '487307' => 487307,
    '435257' => 435257,
    '596279' => 596279,
    '600113' => 600113,
    '529114' => 529114,
   // '601898' => 601898,
    '612892' => 612892,
    '505628' => 505628,
    '613714' => 613714,
    '306787' => 306787,
    '518915' => 518915,
    '615601' => 615601,
    '450111' => 450111,
    '615863' => 615863,
    '616795' => 616795,
   // '617163' => 617163, - tb investigat
    '586236' => 586236,
   // '619352' => 619352,
   //'616416' => 616416, - tb investigat
    //'619575' => 619575,
    //'619594' => 619594,
    //'619663' => 619663,
    '618409' => 618409,
    '619921' => 619921,
    //'617203' => 617203,
    '620205' => 620205,
    //'620719' => 620719,
    '613949' => 613949,
    '614758' => 614758,
    '617630' => 617630,
    '351505' => 351505,
    '618200' => 618200,
    '616803' => 616803,
    '519630' => 519630,
    '475168' => 475168,
    '564468' => 564468,
    '598146' => 598146,
    '433132' => 433132,

        ];

        foreach ($resPianote as $userR){
            $user = User::query()->where('id', $userR)->first();
            if(!$user){
                $this->info('user not found --->'.$userR);
                //break;
            }
           // $subscriptions = Subscription::query()->where('user_id', $user->id)->get();
            //$customer = $revenueCatService->getSubscriber($userR);
            $subscriber = $revenueCatService->getSubscriber($user->id);
            // dd($subscriber);
//            if($userR == 604040){
//                                        dd($subscriber);
//                                    }
            $entitlements = $subscriber->entitlements;
            $subscriptions = $subscriber->subscriptions;
            $conditionMeet = false;

            if (!empty($entitlements)) {
                foreach ($entitlements as $entitlement) {
                    $productIdentifier = $entitlement->product_identifier;
                    $subscriptionData = $subscriptions->$productIdentifier;
                   //dd($subscriptionData->store);
                    $type = (strtolower($subscriptionData->store) == 'app_store') ? 'apple' : 'google';
                    $store = $type.'_store';


                        $productsMap = array_merge(
                            [config('ecommerce.'.$store.'_products_map')[$productIdentifier]],
                            [config('ecommerce.'.$store.'_products_map_trial')[$productIdentifier]]
                        );
                      //  dd($productsMap);


                    $musoraProducts =
                        Product::whereIn('sku', $productsMap)
                            ->get();

                    $musoraSubscriptions =
                        Subscription::query()
                            ->where('user_id', '=', $user->id)
                            ->where('type', '=', $type.'_subscription')
                            ->whereIn(
                                'product_id',
                                $musoraProducts->pluck('id')
                                    ->toArray()
                            )
                            ->orderby('paid_until', 'desc')
                            ->first();
//                    if($userR == 604040){
//                        dd($musoraSubscriptions);
//                    }
if(!$musoraSubscriptions){
    $this->info('nu am gasit subscriptie  '.$user->id.'    revenuecat expiration date: '.Carbon::parse($subscriptionData->expires_date) );
   //break;
}
//dd($musoraSubscriptions->apple_expiration_date.' '.Carbon::parse($subscriptionData->expires_date)->toDateTimeString());
                    $isActiveRevenueCat = ((Carbon::parse($subscriptionData->expires_date) >= now()->subDays(5)
                            && !$subscriptionData->unsubscribe_detected_at )|| $subscriptionData->auto_resume_date);
                   // $isActive = $isActiveRevenueCat == $musoraSubscriptions->is_active;
                    $isActive = $musoraSubscriptions->apple_expiration_date == Carbon::parse($subscriptionData->expires_date)->toDateTimeString();
                    if($isActive)   {
                        $conditionMeet = true;
//                        continue;
                    }

                }}
            if(!$conditionMeet) {
                // dd($subscriptionData);
                if(!isset($musoraSubscriptions)){
                    $this->info(
                        'nu are subscription '.
                        $user->id
                    );
                }else {
                    $this->info(
                        'nu s-a respectat conditia pentru '.
                        $user->id.
                        '    revenuecat expiration date: '.
                        Carbon::parse($subscriptionData->expires_date).
                        '   musora expiration date :: '.$musoraSubscriptions->apple_expiration_date
                    );
                }
            }
            //$user->update(''subscription_id' => $userR->subscription_id]);
        }
//,        $user = User::query()->where('id', 568357)->first();
//,
//        $res = $revenueCatGateway->sendRequest(
//            'gngiooonafdchndohbmpddga.AO-J1OwW6PZ7fyIfXa7h4BR42KfzpC38pMWMi91XwQR-VseMopkZ8iZnuXxcWr-5xmRDufufjrEoSBhdb9h182RbB4O4CTxwIw',
//            $user,
//            'drumeo_app_1_month_2021',
//            'android',
//            '29.99',
//            'USD',
//            'Drumeo'
//        );
       // dd($res);


        $this->info('Done.');
    }
}
