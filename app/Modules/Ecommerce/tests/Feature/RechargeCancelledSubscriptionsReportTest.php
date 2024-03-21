<?php

namespace App\Modules\Ecommerce\tests\Feature;

use App\Modules\Ecommerce\Jobs\Recharge\CancelledSubscriptionsReport;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Tests\traits\CreatesReflectionProperty;

class RechargeCancelledSubscriptionsReportTest extends TestCase
{
    use CreatesReflectionProperty;

    public function test_command_creates_proper_date_range(): void
    {
        Queue::fake();
        $this->artisan("ecommerce:report-cancelled-subscriptions foo@bar.baz")
            ->assertSuccessful();

        // defaults to 14 days ago - today
        $today = CarbonImmutable::today();
        Queue::assertPushedOn('command', function (CancelledSubscriptionsReport $report) use ($today) {
            return $today->isSameDay($this->getReflectionProperty($report, 'createdAtMax')) &&
                $today->subDays(14)->isSameDay($this->getReflectionProperty($report, 'createdAtMin'));
        });

        // setting only the max, defaults min to 14 days before
        $max = CarbonImmutable::create(2024, 1, 1);
        $this->artisan("ecommerce:report-cancelled-subscriptions foo@bar.baz --created_at_max={$max->toDateString()}")
            ->assertSuccessful();

        Queue::assertPushedOn('command', function (CancelledSubscriptionsReport $report) use ($max) {
            return $max->isSameDay($this->getReflectionProperty($report, 'createdAtMax')) &&
                $max->subDays(14)->isSameDay($this->getReflectionProperty($report, 'createdAtMin'));
        });

        // setting both dates creates that range
        $max = CarbonImmutable::create(2024, 1, 1);
        $min = CarbonImmutable::create(2023, 1, 1);
        $this->artisan(
            "ecommerce:report-cancelled-subscriptions foo@bar.baz --created_at_min={$min->toDateString()} --created_at_max={$max->toDateString()}"
        )
            ->assertSuccessful();

        Queue::assertPushedOn('command', function (CancelledSubscriptionsReport $report) use ($max, $min) {
            return $max->isSameDay($this->getReflectionProperty($report, 'createdAtMax')) &&
                $min->isSameDay($this->getReflectionProperty($report, 'createdAtMin'));
        });
    }

    public function test_command_creates_recipients_list(): void
    {
        Queue::fake();
        $to = 'foo@bar.baz';
        $this->artisan("ecommerce:report-cancelled-subscriptions $to")
            ->assertSuccessful();

        Queue::assertPushedOn('command', function (CancelledSubscriptionsReport $report) use ($to) {
            return $this->getReflectionProperty($report, 'to') === [$to] &&
                is_null($this->getReflectionProperty($report, 'cc'));
        });

        $to = ['foo@bar.baz', 'test@mail.com', 'mail@test.com'];
        $cc = ['bar@foo.baz', 'cc@mail.com', 'cc@test.com'];

        $commandString = 'ecommerce:report-cancelled-subscriptions';
        foreach ($to as $toAddress) {
            $commandString .= " $toAddress";
        }
        foreach ($cc as $ccAddress) {
            $commandString .= " --cc=$ccAddress";
        }

        $this->artisan($commandString)
            ->assertSuccessful();

        Queue::assertPushedOn('command', function (CancelledSubscriptionsReport $report) use ($to, $cc) {
            return $this->getReflectionProperty($report, 'to') === $to &&
                $this->getReflectionProperty($report, 'cc') === $cc;
        });
    }

    /*
    // DEV NOTE: these tests reflect how the job could be tested, if we were using Guzzle/HTTP facade, instead of cURL

    public function test_job_logs_and_returns_when_no_cancelled_subscriptions(): void
    {
        $createdAtMin = Carbon::today()->subWeeks(2);
        $createdAtMax = Carbon::today();
        $to = ['foo@bar.baz', 'test@mail.com', 'mail@test.com'];

        // set up the http faking, to emulate the process with Recharge
        Http::fake([
            // call to get the subscriptions: return an empty list
            "https://api.rechargeapps.com/subscriptions" => Http::response(
                json_encode('{"subscriptions":[]}')
            ),
        ]);

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($createdAtMin, $createdAtMax) {
                return $message === sprintf('CancelledSubscriptionsReport: No cancelled subscriptions for %s - %s.',
                    $createdAtMin->toDateString(),
                    $createdAtMax->toDateString()
                    );
            });

        CancelledSubscriptionsReport::dispatchSync($createdAtMin, $createdAtMax, $to);
        Mail::assertNothingSent();
    }

    public function test_job_sends_email_with_each_customers_information(): void
    {
        $createdAtMin = Carbon::create(2024, 1, 1);
        $createdAtMax = Carbon::create(2024, 1, 30);
        $to = ['foo@bar.baz', 'test@mail.com', 'mail@test.com'];

        // create user1, but not user2, so we can test both scenarios
        User::factory()->create(['email' => 'user1@test.com']);
        // set up the http faking, to emulate the process with Recharge
        Http::fake([
            // call to get the subscriptions: return a (stripped down) list of subscriptions
            "https://api.rechargeapps.com/subscriptions" => Http::response(
                json_encode('
                {
                  "subscriptions": [
                    {
                      "cancellation_reason": "Other reason",
                      "cancellation_reason_comments": "testing",
                      "cancelled_at": "2024-01-15T16:08:49",
                      "created_at": "2024-01-01T09:54:56",
                      "customer_id": 111111111,
                      "email": "user1@test.com",
                      "status": "CANCELLED",
                      "updated_at": "2024-01-15T16:08:48",
                    },
                    {
                      "cancellation_reason": "Other reason",
                      "cancellation_reason_comments": "testing",
                      "cancelled_at": "2024-01-18T16:08:49",
                      "created_at": "2024-01-03T09:54:56",
                      "customer_id": 111111112,
                      "email": "user2@test.com",
                      "status": "CANCELLED",
                      "updated_at": "2024-01-18T16:08:48",
                    }
                  ]
                }')
            ),
        ]);


        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($createdAtMin, $createdAtMax, $to) {
                return $message === sprintf('CancelledSubscriptionsReport: Report sent to: %s.',
                        implode(', ', $to),
                    );
            });

        CancelledSubscriptionsReport::dispatchSync($createdAtMin, $createdAtMax, $to);

        Mail::assertSent(General::class, function(General $mail) use ($createdAtMin, $createdAtMax, $to) {
            $mail->build();
               return
                   collect($mail->to)->pluck('address')->toArray() === $to &&
                   empty($mail->cc) &&
                    $mail->hasSubject(sprintf('Cancelled Recharge Subscriptions %s - %s.',
                        $createdAtMin->toDateString(),
                        $createdAtMax->toDateString()
                   )) &&
                   $mail->from[0] === ['name' => 'Musora System', 'address' => 'system@musora.com'] &&

                   array_keys($mail->input) === ['user1@test.com', 'user2@test.com']
                   // and more could be done to check the values for each customer ...
                   ;
        });
    }
    */
}
