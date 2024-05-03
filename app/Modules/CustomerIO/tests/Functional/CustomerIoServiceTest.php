<?php

namespace App\Modules\CustomerIO\tests\Functional;

use App\Modules\CustomerIO\ApiGateways\CustomerIoApiGateway;
use App\Modules\CustomerIO\Events\CustomerCreated;
use App\Modules\CustomerIO\Events\CustomerUpdated;
use App\Modules\CustomerIO\Models\Customer;
use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\CustomerIO\tests\CustomerIoTestCase;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Throwable;

class CustomerIoServiceTest extends CustomerIoTestCase
{
    /**
     * @var CustomerIoService
     */
    private CustomerIoService $customerIoService;

    /**
     * @var CustomerIoApiGateway
     */
    private CustomerIoApiGateway $customerIoApiGateway;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customerIoService = app()->make(CustomerIoService::class);
        $this->customerIoApiGateway = app()->make(CustomerIoApiGateway::class);
        Event::fake(CustomerCreated::class);
    }

    public function test_get_customer_by_id()
    {
        $email = $this->faker->email;
        $accountName = 'musora';
        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);

        $createdCustomer = $this->customerIoService->createCustomer(
            $email,
            $accountName
        );

        Event::assertDispatched(CustomerCreated::class);

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(20);

        $fetchedCustomer = $this->customerIoService->getCustomerById($accountName, $createdCustomer->uuid);

        $this->assertEquals($fetchedCustomer->uuid, $createdCustomer->uuid);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['id'], $createdCustomer->uuid);

        $this->assertEquals($fetchedCustomer->email, $email);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['email'], $email);

        $this->assertEquals($fetchedCustomer->workspace_name, $accountConfigData['workspace_name']);
        $this->assertEquals($fetchedCustomer->workspace_id, $accountConfigData['workspace_id']);
        $this->assertEquals($fetchedCustomer->site_id, $accountConfigData['site_id']);

        $this->assertEquals(
            $fetchedCustomer->created_at,
            Carbon::now()
                ->toDateTimeString()
        );
        $this->assertEquals(
            $fetchedCustomer->updated_at,
            Carbon::now()
                ->toDateTimeString()
        );
        $this->assertEquals($fetchedCustomer->deleted_at, null);
    }

    public function test_get_customer_by_user_id()
    {
        $email = $this->faker->email;
        $userId = rand();
        $accountName = 'musora';
        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);

        $createdCustomer = $this->customerIoService->createCustomer(
            $email,
            $accountName,
            [],
            null,
            $userId
        );

        Event::assertDispatched(CustomerCreated::class);

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(4);

        $fetchedCustomer = $this->customerIoService->getCustomerByUserId($accountName, $userId);

        $this->assertEquals($fetchedCustomer->uuid, $createdCustomer->uuid);

        $this->assertEquals($fetchedCustomer->email, $email);

        $this->assertEquals($fetchedCustomer->workspace_name, $accountConfigData['workspace_name']);
        $this->assertEquals($fetchedCustomer->workspace_id, $accountConfigData['workspace_id']);
        $this->assertEquals($fetchedCustomer->site_id, $accountConfigData['site_id']);

        $this->assertEquals(
            $fetchedCustomer->created_at,
            Carbon::now()
                ->toDateTimeString()
        );
        $this->assertEquals(
            $fetchedCustomer->updated_at,
            Carbon::now()
                ->toDateTimeString()
        );
        $this->assertEquals($fetchedCustomer->deleted_at, null);
    }

    public function test_get_customer_by_id_not_found_in_database()
    {
        $email = $this->faker->email;
        $accountName = 'musora';
        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);

        $this->expectExceptionMessage('No query results for model [App\Modules\CustomerIO\Models\Customer]');

        $fetchedCustomer = $this->customerIoService->getCustomerById($accountName, rand() . '_404');
    }

    public function test_get_customer_by_id_found_in_database_but_not_from_api()
    {
        $email = $this->faker->email;
        $accountName = 'musora';
        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);

        $customer = new Customer();
        $customer->generateUUID();
        $customer->email = $this->faker->email;
        $customer->workspace_name = $accountConfigData['workspace_name'];
        $customer->workspace_id = $accountConfigData['workspace_id'];
        $customer->site_id = $accountConfigData['site_id'];

        $customer->save();

        $this->expectExceptionCode(404);

        $fetchedCustomer = $this->customerIoService->getCustomerById($accountName, $customer->uuid);
    }

    public function test_create_customer_without_attributes_or_existing_id_or_created_at()
    {
        $email = $this->faker->email;
        $accountName = 'musora';
        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);

        $createdCustomer = $this->customerIoService->createCustomer(
            $email,
            $accountName
        );

        Event::assertDispatched(CustomerCreated::class);

        $data = [
            'email' => $email,
            'workspace_name' => $accountConfigData['workspace_name'],
            'workspace_id' => $accountConfigData['workspace_id'],
            'site_id' => $accountConfigData['site_id'],
            'created_at' => Carbon::now()
                ->toDateTimeString(),
            'updated_at' => Carbon::now()
                ->toDateTimeString(),
            'deleted_at' => null,
        ];

        $this->assertDatabaseHas('customer_io_customers', $data);

        $this->assertNotEmpty(
            Customer::query()
                ->find(1)->uuid
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(20);

        $fetchedCustomer = $this->customerIoService->getCustomerById($accountName, $createdCustomer->uuid);

        $this->assertEquals($fetchedCustomer->uuid, $createdCustomer->uuid);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['id'], $createdCustomer->uuid);

        $this->assertEquals($fetchedCustomer->email, $email);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['email'], $email);

        $this->assertEquals($fetchedCustomer->workspace_name, $accountConfigData['workspace_name']);
        $this->assertEquals($fetchedCustomer->workspace_id, $accountConfigData['workspace_id']);
        $this->assertEquals($fetchedCustomer->site_id, $accountConfigData['site_id']);

        $this->assertEquals(
            $fetchedCustomer->created_at,
            Carbon::now()
                ->toDateTimeString()
        );
        $this->assertEquals(
            $fetchedCustomer->updated_at,
            Carbon::now()
                ->toDateTimeString()
        );
        $this->assertEquals($fetchedCustomer->deleted_at, null);
    }

    public function test_create_customer_with_attributes_and_created_at()
    {
        $email = $this->faker->email;
        $accountName = 'musora';
        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);
        $createdAt =
            Carbon::now()
            ->subDays(1)->timestamp;

        $customAttributes = [
            'my_string_1' => $this->faker->text(),
            'my_bool_1' => true,
            'my_bool_2' => false,
            'my_integer_1' => 5,
            'my_integer_2' => 5937653,
            'my_timestamp_1' => Carbon::now()
                ->subDays(100)->timestamp,
            'my_timestamp_2' => Carbon::now()
                ->addDays(100)->timestamp,
        ];

        $createdCustomer = $this->customerIoService->createCustomer(
            $email,
            $accountName,
            $customAttributes,
            null,
            null,
            $createdAt
        );

        Event::assertDispatched(CustomerCreated::class);

        $data = [
            'uuid' => $createdCustomer->uuid,
            'email' => $email,
            'workspace_name' => $accountConfigData['workspace_name'],
            'workspace_id' => $accountConfigData['workspace_id'],
            'site_id' => $accountConfigData['site_id'],
            'created_at' => Carbon::createFromTimestamp($createdAt)
                ->toDateTimeString(),
            'updated_at' => Carbon::createFromTimestamp($createdAt)
                ->toDateTimeString(),
            'deleted_at' => null,
        ];

        $this->assertDatabaseHas('customer_io_customers', $data);

        $this->assertNotEmpty(
            Customer::query()
                ->find(1)->uuid
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(10);

        $data = array_merge($data, $customAttributes);

        $fetchedCustomer = $this->customerIoService->getCustomerById($accountName, $createdCustomer->uuid);

        $this->assertEquals($fetchedCustomer->uuid, $createdCustomer->uuid);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['id'], $createdCustomer->uuid);

        $this->assertEquals($fetchedCustomer->email, $email);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['email'], $email);

        $this->assertEquals($fetchedCustomer->getExternalAttributes()['created_at'], $createdAt);

        $this->assertEquals($fetchedCustomer->workspace_name, $accountConfigData['workspace_name']);
        $this->assertEquals($fetchedCustomer->workspace_id, $accountConfigData['workspace_id']);
        $this->assertEquals($fetchedCustomer->site_id, $accountConfigData['site_id']);

        $this->assertEquals(
            $fetchedCustomer->created_at,
            Carbon::createFromTimestamp($createdAt)
                ->toDateTimeString()
        );
        $this->assertEquals(
            $fetchedCustomer->updated_at,
            Carbon::createFromTimestamp($createdAt)
                ->toDateTimeString()
        );
        $this->assertEquals($fetchedCustomer->deleted_at, null);

        foreach ($customAttributes as $customAttributeName => $customAttributeValue) {
            $this->assertEquals(
                $data[$customAttributeName],
                $fetchedCustomer->getExternalAttributes()[$customAttributeName]
            );
        }
    }

    public function test_create_customer_with_user_id_and_attributes_and_created_at()
    {
        $email = $this->faker->email;
        $accountName = 'musora';
        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);
        $userId = rand();
        $createdAt =
            Carbon::now()
            ->subDays(1)->timestamp;

        $customAttributes = [
            'my_string_1' => $this->faker->text(),
            'my_bool_1' => true,
            'my_bool_2' => false,
            'my_integer_1' => 5,
            'my_integer_2' => 5937653,
            'my_timestamp_1' => Carbon::now()
                ->subDays(100)->timestamp,
            'my_timestamp_2' => Carbon::now()
                ->addDays(100)->timestamp,
        ];

        $createdCustomer = $this->customerIoService->createCustomer(
            $email,
            $accountName,
            $customAttributes,
            null,
            $userId,
            $createdAt
        );

        Event::assertDispatched(CustomerCreated::class);

        $data = [
            'uuid' => $createdCustomer->uuid,
            'email' => $email,
            'workspace_name' => $accountConfigData['workspace_name'],
            'workspace_id' => $accountConfigData['workspace_id'],
            'site_id' => $accountConfigData['site_id'],
            'created_at' => Carbon::createFromTimestamp($createdAt)
                ->toDateTimeString(),
            'updated_at' => Carbon::createFromTimestamp($createdAt)
                ->toDateTimeString(),
            'deleted_at' => null,
        ];

        $this->assertDatabaseHas('customer_io_customers', $data);

        $this->assertNotEmpty(
            Customer::query()
                ->find(1)->uuid
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(20);

        $data = array_merge($data, $customAttributes);

        $fetchedCustomer = $this->customerIoService->getCustomerById($accountName, $createdCustomer->uuid);

        $this->assertEquals($fetchedCustomer->uuid, $createdCustomer->uuid);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['id'], $createdCustomer->uuid);

        $this->assertEquals($fetchedCustomer->email, $email);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['email'], $email);

        $this->assertEquals($fetchedCustomer->user_id, $userId);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['musora_user_id'], $userId);

        $this->assertEquals($fetchedCustomer->getExternalAttributes()['created_at'], $createdAt);

        $this->assertEquals($fetchedCustomer->workspace_name, $accountConfigData['workspace_name']);
        $this->assertEquals($fetchedCustomer->workspace_id, $accountConfigData['workspace_id']);
        $this->assertEquals($fetchedCustomer->site_id, $accountConfigData['site_id']);

        $this->assertEquals(
            $fetchedCustomer->created_at,
            Carbon::createFromTimestamp($createdAt)
                ->toDateTimeString()
        );
        $this->assertEquals(
            $fetchedCustomer->updated_at,
            Carbon::createFromTimestamp($createdAt)
                ->toDateTimeString()
        );
        $this->assertEquals($fetchedCustomer->deleted_at, null);

        foreach ($customAttributes as $customAttributeName => $customAttributeValue) {
            $this->assertEquals(
                $data[$customAttributeName],
                $fetchedCustomer->getExternalAttributes()[$customAttributeName]
            );
        }
    }

    public function test_create_or_update_customer_create()
    {
        $email = $this->faker->email;
        $accountName = 'musora';
        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);
        $userId = rand();
        $createdAt =
            Carbon::now()
            ->subDays(1)->timestamp;

        $customAttributes = [
            'my_string_1' => $this->faker->text(),
            'my_bool_1' => true,
            'my_bool_2' => false,
            'my_integer_1' => 5,
            'my_integer_2' => 5937653,
            'my_timestamp_1' => Carbon::now()
                ->subDays(100)->timestamp,
            'my_timestamp_2' => Carbon::now()
                ->addDays(100)->timestamp,
        ];

        $createdCustomer = $this->customerIoService->createOrUpdateCustomerByEmail(
            $email,
            $accountName,
            $customAttributes,
            $userId,
            $createdAt
        );

        Event::assertDispatched(CustomerCreated::class);

        $data = [
            'uuid' => $createdCustomer->uuid,
            'email' => $email,
            'user_id' => $userId,
            'workspace_name' => $accountConfigData['workspace_name'],
            'workspace_id' => $accountConfigData['workspace_id'],
            'site_id' => $accountConfigData['site_id'],
            'created_at' => Carbon::createFromTimestamp($createdAt)
                ->toDateTimeString(),
            'updated_at' => Carbon::createFromTimestamp($createdAt)
                ->toDateTimeString(),
            'deleted_at' => null,
        ];

        $this->assertDatabaseHas('customer_io_customers', $data);

        $this->assertNotEmpty(
            Customer::query()
                ->find(1)->uuid
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(4);

        $data = array_merge($data, $customAttributes);

        $fetchedCustomer = $this->customerIoService->getCustomerById($accountName, $createdCustomer->uuid);

        $this->assertEquals($fetchedCustomer->uuid, $createdCustomer->uuid);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['id'], $createdCustomer->uuid);

        $this->assertEquals($fetchedCustomer->email, $email);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['email'], $email);

        $this->assertEquals($fetchedCustomer->user_id, $userId);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['musora_user_id'], $userId);

        $this->assertEquals($fetchedCustomer->getExternalAttributes()['created_at'], $createdAt);

        $this->assertEquals($fetchedCustomer->workspace_name, $accountConfigData['workspace_name']);
        $this->assertEquals($fetchedCustomer->workspace_id, $accountConfigData['workspace_id']);
        $this->assertEquals($fetchedCustomer->site_id, $accountConfigData['site_id']);

        $this->assertEquals(
            $fetchedCustomer->created_at,
            Carbon::createFromTimestamp($createdAt)
                ->toDateTimeString()
        );
        $this->assertEquals(
            $fetchedCustomer->updated_at,
            Carbon::createFromTimestamp($createdAt)
                ->toDateTimeString()
        );
        $this->assertEquals($fetchedCustomer->deleted_at, null);

        foreach ($customAttributes as $customAttributeName => $customAttributeValue) {
            $this->assertEquals(
                $data[$customAttributeName],
                $fetchedCustomer->getExternalAttributes()[$customAttributeName]
            );
        }
    }

    public function test_create_or_update_customer_update()
    {
        $email = $this->faker->email;
        $accountName = 'musora';
        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);
        $userId = rand();
        $createdAt =
            Carbon::now()
            ->subDays(1)->timestamp;

        $customAttributes = [
            'my_string_1' => $this->faker->text(),
            'my_bool_1' => true,
            'my_bool_2' => false,
            'my_integer_1' => 5,
            'my_integer_2' => 5937653,
            'my_timestamp_1' => Carbon::now()
                ->subDays(100)->timestamp,
            'my_timestamp_2' => Carbon::now()
                ->addDays(100)->timestamp,
        ];

        $createdCustomer = $this->customerIoService->createOrUpdateCustomerByEmail(
            $email,
            $accountName,
            $customAttributes,
            $userId,
            $createdAt
        );

        Event::assertDispatched(CustomerCreated::class);

        $data = [
            'uuid' => $createdCustomer->uuid,
            'email' => $email,
            'user_id' => $userId,
            'workspace_name' => $accountConfigData['workspace_name'],
            'workspace_id' => $accountConfigData['workspace_id'],
            'site_id' => $accountConfigData['site_id'],
            'created_at' => Carbon::createFromTimestamp($createdAt)
                ->toDateTimeString(),
            'updated_at' => Carbon::createFromTimestamp($createdAt)
                ->toDateTimeString(),
            'deleted_at' => null,
        ];

        $this->assertDatabaseHas('customer_io_customers', $data);

        $this->assertNotEmpty(
            Customer::query()
                ->find(1)->uuid
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(4);

        // update
        $newCustomAttributes = [
            'my_string_1' => $this->faker->text(),
            'my_bool_1' => false,
            'my_bool_2' => true,
            'my_integer_1' => 5982,
            'my_integer_2' => 583,
            'my_timestamp_1' => Carbon::now()
                ->subDays(3)->timestamp,
            'my_timestamp_2' => Carbon::now()
                ->addDays(3)->timestamp,
        ];
        $newUserId = rand();
        $newCreatedAt =
            Carbon::now()
            ->subDays(1)->timestamp;

        Event::fake([CustomerUpdated::class]);
        $updatedCustomer = $this->customerIoService->createOrUpdateCustomerByEmail(
            $email,
            $accountName,
            $newCustomAttributes,
            $newUserId,
            $newCreatedAt
        );

        Event::assertDispatched(CustomerUpdated::class);

        $data = array_merge($data, $customAttributes);

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(4);

        $fetchedCustomer = $this->customerIoService->getCustomerById($accountName, $updatedCustomer->uuid);

        $this->assertEquals($fetchedCustomer->uuid, $updatedCustomer->uuid);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['id'], $updatedCustomer->uuid);

        $this->assertEquals($fetchedCustomer->email, $email);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['email'], $email);

        $this->assertEquals($fetchedCustomer->user_id, $newUserId);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['musora_user_id'], $newUserId);

        $this->assertEquals($fetchedCustomer->getExternalAttributes()['created_at'], $newCreatedAt);

        $this->assertEquals($fetchedCustomer->workspace_name, $accountConfigData['workspace_name']);
        $this->assertEquals($fetchedCustomer->workspace_id, $accountConfigData['workspace_id']);
        $this->assertEquals($fetchedCustomer->site_id, $accountConfigData['site_id']);

        $this->assertEquals($fetchedCustomer->created_at, Carbon::createFromTimestamp($newCreatedAt));
        $this->assertEquals(Carbon::now(), $fetchedCustomer->updated_at);
        $this->assertEquals($fetchedCustomer->deleted_at, null);

        foreach ($newCustomAttributes as $customAttributeName => $customAttributeValue) {
            $this->assertEquals(
                $customAttributeValue,
                $fetchedCustomer->getExternalAttributes()[$customAttributeName]
            );
        }
    }

    public function test_process_form()
    {
        $this->markTestSkipped("Broken test - needs updates for form to process");
        $email = $this->faker->email;
        //TODO: there is no form called "Example Form Name". Should we add one???
        $formName = 'Example Form Name';
        $accountConfigData = $this->customerIoService->getAccountConfigData('musora');

        $customers = $this->customerIoService->processForm($email, $formName, []);
        $createdCustomer = $customers[0];

        $data = [
            'uuid' => $createdCustomer->uuid,
            'email' => $email,
            'workspace_name' => $accountConfigData['workspace_name'],
            'workspace_id' => $accountConfigData['workspace_id'],
            'site_id' => $accountConfigData['site_id'],
            'created_at' => Carbon::now()
                ->toDateTimeString(),
            'updated_at' => Carbon::now()
                ->toDateTimeString(),
            'deleted_at' => null,
        ];

        $this->assertDatabaseHas('customer_io_customers', $data);

        $this->assertNotEmpty(
            Customer::query()
                ->find(1)->uuid
        );

        sleep(5);

        $fetchedCustomer = $this->customerIoService->getCustomerById('musora', $createdCustomer->uuid);

        $this->assertEquals($fetchedCustomer->uuid, $createdCustomer->uuid);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['id'], $createdCustomer->uuid);

        $this->assertEquals($fetchedCustomer->email, $email);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['email'], $email);

        $this->assertEquals($fetchedCustomer->workspace_name, $accountConfigData['workspace_name']);
        $this->assertEquals($fetchedCustomer->workspace_id, $accountConfigData['workspace_id']);
        $this->assertEquals($fetchedCustomer->site_id, $accountConfigData['site_id']);

        $this->assertEquals(
            $fetchedCustomer->created_at,
            Carbon::now()
                ->toDateTimeString()
        );
        $this->assertEquals(
            $fetchedCustomer->updated_at,
            Carbon::now()
                ->toDateTimeString()
        );
        $this->assertEquals($fetchedCustomer->deleted_at, null);

        $this->assertEquals(
            'my attribute value 1',
            $fetchedCustomer->getExternalAttributes()['attribute_to_sync_1']
        );

        $this->assertEquals(
            'my attribute value 2',
            $fetchedCustomer->getExternalAttributes()['attribute_to_sync_2']
        );

        $fetchedCustomerActivities = $this->customerIoApiGateway->getCustomerActivities(
            $accountConfigData['app_api_key'],
            $createdCustomer->email,
            'event'
        );

        $fetchedEventNames = [];

        foreach ($fetchedCustomerActivities as $fetchedCustomerActivity) {
            $fetchedEventNames[] = $fetchedCustomerActivity['name'];
        }

        $this->assertContains('event_to_sync_1', $fetchedEventNames);
        $this->assertContains('event_to_sync_2', $fetchedEventNames);
    }

    public function test_create_event_all_data()
    {
        $email = $this->faker->email;
        $accountName = 'musora';
        $eventName = 'my_event_1';
        $eventType = 'my_event_type_1';
        $createdAt =
            Carbon::now()
            ->subDays(2)->timestamp;

        $createdCustomer = $this->customerIoService->createCustomer(
            $email,
            $accountName
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(4);

        $this->customerIoService->createEvent(
            $createdCustomer->email,
            $accountName,
            $eventName,
            ['data_point' => $eventType],
            $createdAt
        );

        sleep(10);

        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);

        $fetchedCustomerActivities = $this->customerIoApiGateway->getCustomerActivities(
            $accountConfigData['app_api_key'],
            $createdCustomer->email,
            'event'
        );

        $this->assertEquals($eventName, $fetchedCustomerActivities[0]['name']);
    }

    public function test_sync_user_device()
    {
        $email = $this->faker->email;
        $accountName = 'musora';
        $createdAt =
            Carbon::now()
            ->subDays(2)->timestamp;

        $createdCustomer = $this->customerIoService->createCustomer(
            $email,
            $accountName
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(4);

        $token = '749f535671cf6b34d8e794d212d00c703b96274e07161b18b082d0d70ef1052f';
        $platform = 'ios';

        $this->customerIoService->syncDeviceForUserId(
            $createdCustomer->user_id,
            $accountName,
            ['id' => $token, 'platform' => $platform],
            $createdAt
        );

        sleep(5);

        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);

        $fetchedCustomer = $this->customerIoApiGateway->getCustomer(
            $accountConfigData['app_api_key'],
            $createdCustomer->email
        );

        $this->assertEquals(1, count($fetchedCustomer['devices']));
        $this->assertEquals($token, $fetchedCustomer['devices'][0]['id']);
        $this->assertEquals($platform, $fetchedCustomer['devices'][0]['platform']);
    }

    public function test_merge_customers()
    {
        $accountName = 'musora';
        $email1 = $this->faker->email;
        $email2 = $this->faker->email;
        $createdAt1 =
            Carbon::now()
            ->subDays(2)->timestamp;
        $attributes1 = ['test1' => 'value-not-overwritten', 'test2' => 'new-value'];

        $createdCustomer1 = $this->customerIoService->createCustomer(
            $email1,
            $accountName,
            $attributes1
        );
        $attributes2 = ['test2' => 'value-is-overwritten', 'test3' => 'this-is-set'];

        $createdCustomer2 = $this->customerIoService->createCustomer(
            $email2,
            $accountName,
            $attributes2
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(4);

        $primaryCustomer = $this->customerIoService->mergeCustomers(
            $accountName,
            $createdCustomer1->uuid,
            $createdCustomer2->uuid
        );

        sleep(20);

        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);

        $fetchedCustomer = $this->customerIoApiGateway->getCustomer(
            $accountConfigData['app_api_key'],
            $primaryCustomer->email
        );

        // duplicate should now be missing
        try {
            $fetchedDuplicateCustomer = $this->customerIoApiGateway->getCustomer(
                $accountConfigData['app_api_key'],
                $createdCustomer2->uuid
            );
        } catch (Exception $exception) {
            $this->assertEquals(404, $exception->getCode());
        }

        $this->assertDatabaseMissing('customer_io_customers', ['uuid' => $createdCustomer2->uuid]);
        $this->assertDatabaseHas('customer_io_customers', ['uuid' => $primaryCustomer->uuid]);
        $this->assertEquals($primaryCustomer->email, $fetchedCustomer['attributes']['email']);
        $this->assertEquals($primaryCustomer->uuid, $fetchedCustomer['attributes']['id']);
        $this->assertEquals("value-not-overwritten", $fetchedCustomer['attributes']['test1']);
        $this->assertEquals("new-value", $fetchedCustomer['attributes']['test2']);
        $this->assertEquals("this-is-set", $fetchedCustomer['attributes']['test3']);
    }

    public function test_merge_customers_updated_created_at()
    {
        $accountName = 'musora';
        // CIO now uses email as IDs as well, so we need two different emails,
        // otherwise CIO will just update the primaryCustomer attributes
        $email1 = $this->faker->email;
        $email2 = $this->faker->email;
        $createdAt1 =
            Carbon::now()
            ->subDays(1)->timestamp;
        $attributes1 = ['test1' => 'value-not-overwritten', 'test2' => 'new-value'];

        $createdCustomer1 = $this->customerIoService->createCustomer(
            $email1,
            $accountName,
            $attributes1,
            null,
            null,
            $createdAt1
        );

        $attributes2 = ['test2' => 'value-is-overwritten', 'test3' => 'this-is-set'];
        $createdAt2 =
            Carbon::now()
            ->subDays(5)->timestamp;
        $createdCustomer2 = $this->customerIoService->createCustomer(
            $email2,
            $accountName,
            $attributes2,
            null,
            null,
            $createdAt2
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(20);

        $primaryCustomer = $this->customerIoService->mergeCustomers(
            $accountName,
            $createdCustomer1->uuid,
            $createdCustomer2->uuid
        );

        sleep(20);

        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);

        $fetchedCustomer = $this->customerIoApiGateway->getCustomer(
            $accountConfigData['app_api_key'],
            $primaryCustomer->email
        );

        // duplicate should now be missing
        try {
            $fetchedDuplicateCustomer = $this->customerIoApiGateway->getCustomer(
                $accountConfigData['app_api_key'],
                $createdCustomer2->email
            );
        } catch (Exception $exception) {
            $this->assertEquals(404, $exception->getCode());
        }

        $this->assertDatabaseMissing('customer_io_customers', ['uuid' => $createdCustomer2->uuid]);
        $this->assertDatabaseHas('customer_io_customers', ['uuid' => $primaryCustomer->uuid]);
        $this->assertDatabaseHas('customer_io_customers', [
            'uuid' => $primaryCustomer->uuid,
            'created_at' => Carbon::now()
                ->subDays(5)->toDateTimeString()
        ]);
        $this->assertEquals(Carbon::now()->subDays(5)->timestamp, $fetchedCustomer['attributes']['created_at']);
        $this->assertEquals($primaryCustomer->email, $fetchedCustomer['attributes']['email']);
        $this->assertEquals($primaryCustomer->uuid, $fetchedCustomer['attributes']['id']);
        $this->assertEquals("value-not-overwritten", $fetchedCustomer['attributes']['test1']);
        $this->assertEquals("new-value", $fetchedCustomer['attributes']['test2']);
        $this->assertEquals("this-is-set", $fetchedCustomer['attributes']['test3']);
    }

    public function test_merge_customers_failed_missing_from_db()
    {
        $accountName = 'musora';
        $email = $this->faker->email;
        $createdAt1 =
            Carbon::now()
            ->subDays(2)->timestamp;
        $attributes1 = ['test1' => 'value-not-overwritten', 'test2' => 'new-value', 'test3' => ''];

        $createdCustomer1 = $this->customerIoService->createCustomer(
            $email,
            $accountName,
            $attributes1
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(4);

        try {
            $primaryCustomer = $this->customerIoService->mergeCustomers(
                $accountName,
                $createdCustomer1->uuid,
                'test-fail-uuid'
            );
        } catch (Exception $exception) {
            $this->assertEquals(
                'Could not merge customer ids because one is missing from the database. $primaryCustomerId:' .
                    $createdCustomer1->uuid . ' - $secondaryCustomerId:test-fail-uuid - $accountName: musora',
                $exception->getMessage()
            );
        }

        sleep(20);

        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);

        $fetchedCustomer = $this->customerIoApiGateway->getCustomer(
            $accountConfigData['app_api_key'],
            $createdCustomer1->email
        );

        $this->assertDatabaseHas('customer_io_customers', ['uuid' => $createdCustomer1->uuid]);
        $this->assertEquals($createdCustomer1->email, $fetchedCustomer['attributes']['email']);
        $this->assertEquals($createdCustomer1->uuid, $fetchedCustomer['attributes']['id']);
    }

    public function test_create_event_for_email_or_id()
    {
        $accountName = 'musora';
        $email = $this->faker->email;

        $createdCustomer = $this->customerIoService->createCustomer(
            $email,
            $accountName
        );

        try {
            $customer = $this->customerIoService->createEventForEmailOrId(
                $createdCustomer->email,
                $createdCustomer->uuid,
                $accountName,
                'test',
            );
        } catch (Exception) {
            $this->fail('CustomerIoService::createEventForEmailOrId() should not throw an exception');
        }

        $this->assertNotNull($customer);
        $this->assertEquals($createdCustomer->email, $customer->email);
        $this->assertEquals($createdCustomer->uuid, $customer->uuid);
    }

    public function test_create_event_for_user_id()
    {
        $accountName = 'musora';
        $email = $this->faker->email;
        $userId = rand();

        $createdCustomer = $this->customerIoService->createCustomer(
            $email,
            $accountName,
            [],
            null,
            $userId
        );

        try {
            $customer = $this->customerIoService->createEventForUserId(
                $userId,
                $accountName,
                'test',
                ['email' => $email],
            );

            $this->assertNotNull($customer);
            $this->assertEquals($email, $customer->email);
            $this->assertEquals($userId, $customer->user_id);
        } catch (Exception) {
            $this->fail('CustomerIoService::createEventForUserId() should not throw an exception');
        }
    }

    public function test_delete_customer()
    {
        $accountName = 'musora';
        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);
        $email = $this->faker->email;
        $userId = rand();

        $createdCustomer = $this->customerIoService->createCustomer(
            $email,
            $accountName,
            [],
            null,
            $userId
        );

        $customer = null;
        try {
            $customer = $this->customerIoService->deleteCustomer($userId, $accountName);
        } catch (Throwable $t) {
            Log::error($t->getMessage());
            $this->fail('CustomerIoService::deleteCustomer() should not throw an exception');
        }

        try {
            $this->customerIoApiGateway->getCustomer(
                $accountConfigData['app_api_key'],
                $createdCustomer->uuid
            );
        } catch (Exception $exception) {
            $this->assertEquals(404, $exception->getCode());
        }
    }

    public function test_delete_customer_not_found()
    {
        $accountName = 'musora';
        $userId = rand();

        $customer = null;

        try {
            $customer = $this->customerIoService->deleteCustomer($userId, $accountName);
        } catch (Throwable $t) {
            Log::error($t->getMessage());
            $this->fail('CustomerIoService::deleteCustomer() should not throw an exception');
        }

        $this->assertNull($customer);
    }

    public function test_get_customer_events_by_user_id()
    {
        $accountName = 'musora';
        $email = $this->faker->email;
        $userId = rand();

        $createdCustomer = $this->customerIoService->createCustomer(
            $email,
            $accountName,
            [],
            null,
            $userId
        );

        $this->customerIoService->createEvent(
            $createdCustomer->email,
            $accountName,
            'test',
            ['data_point' => 'test'],
        );

        sleep(10);

        $activities = null;
        try {
            $activities = $this->customerIoService->getCustomerEventsByUserId($accountName, $userId);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            $this->fail('CustomerIoService::getCustomerEventsByUserId() should not throw an exception');
        }

        $this->assertNotNull($activities);
        $this->assertIsArray($activities);
        $this->assertNotEmpty($activities);
    }
}
