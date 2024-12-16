<?php

namespace App\Modules\RailTracker\tests\Integration;

use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\StreamHandler;
use App\Modules\RailTracker\Services\IpDataApiSdkService;
use App\Modules\RailTracker\tests\RailtrackerTestCase;

class CharsetTest extends RailtrackerTestCase
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject $ipDataApiSdkServiceMock
     */
    public $ipDataApiSdkServiceMock;



    public function test_fails_as_expected()
    {
        $this->markTestSkipped('Not working after update and migration to MWP.');
        config()->set('railtracker.charset', 'utf8');
        config()->set('railtracker.collation', 'utf8_unicode_ci');

        $outputBase = [
            [
                'is_eu' => false,
                'region' => '',
                'region_code' => '',
                'country_name' => 'Australia',
                'country_code' => 'AU',
                'continent_name' => 'Oceania',
                'continent_code' => 'OC',
                'latitude' => -33.493999999999999772626324556767940521240234375,
                'longitude' => 143.21039999999999281499185599386692047119140625,
                'asn' => 'AS13335',
                'organisation' => 'Cloudflare Inc',
                'postal' => '',
                'calling_code' => '61',
                'flag' => 'https://ipdata.co/flags/au.png',
                'emoji_flag' => '🇦🇺',
                'emoji_unicode' => 'U+1F1E6 U+1F1FA',
                'languages' =>
                    (object) array(
                        0 =>
                            array(
                                'name' => 'English',
                                'native' => 'English',
                            ),
                    ),
                'currency' =>
                    (object) array(
                        'name' => 'Australian Dollar',
                        'code' => 'AUD',
                        'symbol' => 'AU$',
                        'native' => '$',
                        'plural' => 'Australian dollars',
                    ),
                'time_zone' =>
                    (object) array(
                        'name' => '',
                        'abbr' => '',
                        'offset' => '',
                        'is_dst' => '',
                        'current_time' => '',
                    ),
                'threat' =>
                    (object) array(
                        'is_tor' => false,
                        'is_proxy' => false,
                        'is_anonymous' => false,
                        'is_known_attacker' => false,
                        'is_known_abuser' => true,
                        'is_threat' => true,
                        'is_bogon' => false,
                    ),
                'count' => '695',
            ]
        ];

        $outputOne = [array_merge($outputBase[0], ['ip' => '1.1.1.1', 'city' => 'Los Ángeles'])];
        $outputTwo = [array_merge($outputBase[0], ['ip' => '2.2.2.2', 'city' => 'Los Angeles'])];

        $this->ipDataApiSdkServiceMock
            ->expects($this->at(0))
            ->method('bulkRequest')
            ->willReturn($outputOne);

        $this->ipDataApiSdkServiceMock
            ->expects($this->at(1))
            ->method('bulkRequest')
            ->willReturn($outputTwo);


        $request = $this->randomRequest('1.1.1.1');
        $this->sendRequest($request);

        try{
            $this->processTrackings();
        }catch(\Exception $exception){
            $this->fail($exception->getMessage());
        }

        $this->assertDatabaseHas(
            config('railtracker.table_prefix') . 'requests',
            [
                'ip_city' => 'Los Ángeles',
            ]
        );


        $this->assertDatabaseHas(
            config('railtracker.table_prefix') . 'ip_cities',
            [
                'ip_city' => 'Los Ángeles',
            ]
        );

        // request with non-accent-having value

        $request = $this->randomRequest('2.2.2.2');
        $this->sendRequest($request);

//        $messageQueryFailureExpected = '"Error while writing to association tables ("SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`railtracker_test`.`railtracker4_requests`, CONSTRAINT `railtracker4_requests_ip_city_foreign` FOREIGN KEY (`ip_city`) REFERENCES `railtracker4_ip_cities` (`ip_city`)) (SQL: insert into `railtracker4_ip_cities` (`ip_city`) values (Los Angeles) on duplicate key update `ip_city`=values(`ip_city`))")"';

        try{
            $this->processTrackings();
        }catch(\Exception $exception){
            $this->fail('Exception thrown');
        }

//        $this->assertDatabaseMissing(
//            config('railtracker.table_prefix') . 'ip_cities',
//            [
//                'ip_city' => 'Los Angeles',
//            ]
//        );
    }

    public function test_dont_see_error()
    {
        $this->markTestSkipped('Not working after update and migration to MWP.');
        config()->set('railtracker.charset', 'utf8mb4');
        config()->set('railtracker.collation', 'utf8mb4_unicode_ci');

        $outputBase = [
            [
                'is_eu' => false,
                'region' => '',
                'region_code' => '',
                'country_name' => 'Australia',
                'country_code' => 'AU',
                'continent_name' => 'Oceania',
                'continent_code' => 'OC',
                'latitude' => -33.493999999999999772626324556767940521240234375,
                'longitude' => 143.21039999999999281499185599386692047119140625,
                'asn' => 'AS13335',
                'organisation' => 'Cloudflare Inc',
                'postal' => '',
                'calling_code' => '61',
                'flag' => 'https://ipdata.co/flags/au.png',
                'emoji_flag' => '🇦🇺',
                'emoji_unicode' => 'U+1F1E6 U+1F1FA',
                'languages' =>
                    (object) array(
                        0 =>
                            array(
                                'name' => 'English',
                                'native' => 'English',
                            ),
                    ),
                'currency' =>
                    (object) array(
                        'name' => 'Australian Dollar',
                        'code' => 'AUD',
                        'symbol' => 'AU$',
                        'native' => '$',
                        'plural' => 'Australian dollars',
                    ),
                'time_zone' =>
                    (object) array(
                        'name' => '',
                        'abbr' => '',
                        'offset' => '',
                        'is_dst' => '',
                        'current_time' => '',
                    ),
                'threat' =>
                    (object) array(
                        'is_tor' => false,
                        'is_proxy' => false,
                        'is_anonymous' => false,
                        'is_known_attacker' => false,
                        'is_known_abuser' => true,
                        'is_threat' => true,
                        'is_bogon' => false,
                    ),
                'count' => '695',
            ]
        ];

        $outputOne = [array_merge($outputBase[0], ['ip' => '1.1.1.1', 'city' => 'Los Ángeles'])];
        $outputTwo = [array_merge($outputBase[0], ['ip' => '2.2.2.2', 'city' => 'Los Angeles'])];

        $this->ipDataApiSdkServiceMock
            ->expects($this->at(0))
            ->method('bulkRequest')
            ->willReturn($outputOne);

        $this->ipDataApiSdkServiceMock
            ->expects($this->at(1))
            ->method('bulkRequest')
            ->willReturn($outputTwo);


        $request = $this->randomRequest('1.1.1.1');
        $this->sendRequest($request);

        try{
            $this->processTrackings();
        }catch(\Exception $exception){
            $this->fail($exception->getMessage());
        }

        $this->assertDatabaseHas(
            config('railtracker.table_prefix') . 'requests',
            [
                'ip_city' => 'Los Ángeles',
            ]
        );


        $this->assertDatabaseHas(
            config('railtracker.table_prefix') . 'ip_cities',
            [
                'ip_city' => 'Los Ángeles',
            ]
        );

        // request with non-accent-having value

        $request = $this->randomRequest('2.2.2.2');
        $this->sendRequest($request);

//        $messageQueryFailureExpected = '"Error while writing to association tables ("SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`railtracker_test`.`railtracker4_requests`, CONSTRAINT `railtracker4_requests_ip_city_foreign` FOREIGN KEY (`ip_city`) REFERENCES `railtracker4_ip_cities` (`ip_city`)) (SQL: insert into `railtracker4_ip_cities` (`ip_city`) values (Los Angeles) on duplicate key update `ip_city`=values(`ip_city`))")"';

        try{
            $this->processTrackings();
        }catch(\Exception $exception){
            $this->fail('Exception thrown');
        }

//        $this->assertDatabaseMissing(
//            config('railtracker.table_prefix') . 'ip_cities',
//            [
//                'ip_city' => 'Los Angeles',
//            ]
//        );
    }

//    public function test_passes()
//    {
//        // *DO* run migration to update charset to utf8mb4
//
//        // DB records with accent-having value
//
//        // request with non-accent-having value
//
//        // process that request
//
//        // pass
//    }
}
