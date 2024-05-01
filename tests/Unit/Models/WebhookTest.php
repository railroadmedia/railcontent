<?php

namespace Tests\Unit\Models;

use App\Jobs\WebhookChildJob;
use App\Jobs\WebhookJob;
use App\Models\Webhook;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class WebhookTest extends TestCase
{
    public function test_create_and_run_webhook_job()
    {
        $source_id = $this->faker->unique()->word;
        $this->assertDatabaseMissing(
            'webhooks',
            [ 'source_id' => $source_id,
            ]
        );
        $data = [
            'key1' => 'val1'
        ];
        $source = 'test';
        $parent = new WebhookJob($source, $source_id, $data, [
                new TestWebhookChildJobPass(),
                new TestWebhookChildJobPassOrException(),
            ]);
        $this->assertDatabaseHas(
            'webhooks',
            [ 'source_id' => $source_id,
            ]
        );
        $webhookData = Webhook::where(['source_id' => $source_id])->first();
        $this->assertFalse($webhookData->allComplete());
        $this->assertEquals($webhookData->source, $source);
        $this->assertEqualsCanonicalizing($data, $webhookData->contents);
        $expectedJobCount = $parent->countChildren() + 1;
        $dbCount = count($webhookData->job_details);
        $this->assertEquals($expectedJobCount, $dbCount);

        dispatch($parent);
        $webhookData->refresh();
        $this->assertTrue($webhookData->allComplete());
    }

    public function test_create_delayed_children()
    {
        $source_id = $this->faker->unique()->word;
        $this->assertDatabaseMissing(
            'webhooks',
            [ 'source_id' => $source_id,
            ]
        );
        $parent = new WebhookJob(
            'test',
            $source_id,
            [],
            [
            new TestWebhookChildJobPassOrException(),
            new TestWebhookChildJobPass()
        ],
            [2, 1]
        );
        $beforeDispatch = time();
        dispatch($parent);
        $afterDispatch = time();
        $this->assertGreaterThanOrEqual($afterDispatch, $beforeDispatch + 2, "$beforeDispatch $afterDispatch");
    }

    public function test_creating_invalid_delayed()
    {
        $this->expectException(\InvalidArgumentException::class);
        $source_id = $this->faker->unique()->word;
        $this->assertDatabaseMissing(
            'webhooks',
            [ 'source_id' => $source_id,
            ]
        );
        $parent = new WebhookJob(
            'test',
            $source_id,
            [],
            [
            new TestWebhookChildJobPassOrException(),
            new TestWebhookChildJobPass()
        ],
            [1]
        );
    }

    public function test_child_job_failing_causes_parent_failure()
    {
        $source_id = $this->faker->unique()->word;
        $this->assertDatabaseMissing(
            'webhooks',
            [ 'source_id' => $source_id,
            ]
        );
        $parent = new WebhookJob('test', $source_id, [], [
            new TestWebhookChildJobPassOrException(true),
        ]);
        $this->assertDatabaseHas(
            'webhooks',
            [ 'source_id' => $source_id,
            ]
        );
        $webhookData = Webhook::where(['source_id' => $source_id])->first();
        try {
            dispatch($parent);
            $this->fail("expected to throw exception in job");
        } catch (\InvalidArgumentException $ex) {
        }
        $webhookData->refresh();
        $this->assertFalse($webhookData->allComplete());
    }

    public function test_only_valid_childen_allowed()
    {
        $source_id = $this->faker->unique()->word;
        $this->assertDatabaseMissing(
            'webhooks',
            [ 'source_id' => $source_id,
            ]
        );
        try {
            $parent = new WebhookJob('test', $source_id, [], [
                new TestWebhookNotChildJob(),
            ]);
            $this->fail("Expected to throw exception on invalid Child");
        } catch (\InvalidArgumentException $ex) {
        }
        $source_id = $this->faker->unique()->word;
        $parent = new WebhookJob('test', $source_id, [], [
            new TestWebhookHasSerializablePropertyJob(),
        ]);
        $this->assertDatabaseHas(
            'webhooks',
            [ 'source_id' => $source_id,
            ]
        );
    }

    public function test_queue_parameter_correctly_sets_queue()
    {
        $source_id = $this->faker->unique()->word;
        $queue_name = $this->faker->unique()->word;
        $data = [
            'key1' => 'val1'
        ];
        $source = 'test';
        Queue::fake([TestWebhookChildJobPass::class]);
        $parent = new WebhookJob($source, $source_id, $data, [new TestWebhookChildJobPass()], queue: $queue_name);
        dispatch($parent);
        Queue::assertPushedOn($queue_name, TestWebhookChildJobPass::class);
    }
}

/**
 * A simple class extending the WebhookChildJob that will optionally pass or throw an exception, used for testing
 */
class TestWebhookChildJobPassOrException extends WebhookChildJob
{
    public function __construct(private readonly bool $throwException = false)
    {
    }

    /**
     * @throws Exception
     */
    public function handle()
    {
        if ($this->throwException) {
            throw new \InvalidArgumentException("Test Job failed");
        }
    }
}

/**
 * A simple class extending the WebhookChildJob that will pass, used for testing
 */
class TestWebhookChildJobPass extends WebhookChildJob
{
    public function __construct()
    {
    }
    public function handle()
    {
    }
}

/**
 * A simple class implementing ShouldQueue but not the necessary $webhookJobInfo parameter, used for testing
 */
class TestWebhookNotChildJob implements ShouldQueue
{
    public function __construct()
    {
    }
    public function handle()
    {
    }
}

/**
 * A simple class implementing ShouldQueue and the $webhookJobInfo parameter, used for testing
 */
class TestWebhookHasSerializablePropertyJob implements ShouldQueue
{
    public array $webhookJobInfo;
    public function __construct()
    {
    }
    public function handle()
    {
    }

}
