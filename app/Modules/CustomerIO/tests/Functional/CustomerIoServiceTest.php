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
use Modules\UserManagementSystem\Models\User;
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

        $fetchedCustomer = $this->customerIoService->getCustomerByEmail($accountName, $createdCustomer->email);

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

        $this->customerIoService->createCustomer(
            $email,
            $accountName,
            [],
            $userId
        );

        Event::assertDispatched(CustomerCreated::class);

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(4);

        $fetchedCustomer = $this->customerIoService->getCustomerByUserId($accountName, $userId);

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
        $accountName = 'musora';

        $this->assertNull($this->customerIoService->getCustomerByEmail($accountName, rand() . '_404'));
    }

    public function test_get_customer_by_id_found_in_database_but_not_from_api()
    {
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

        $this->assertNotNull($this->customerIoService->getCustomerByEmail($accountName, $customer->email));
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
                ->find(1)->email
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(20);

        $fetchedCustomer = $this->customerIoService->getCustomerByEmail($accountName, $createdCustomer->email);

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
            $createdAt
        );

        Event::assertDispatched(CustomerCreated::class);

        $data = [
            'email' => $createdCustomer->email,
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
                ->find(1)->email
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(10);

        $data = array_merge($data, $customAttributes);

        $fetchedCustomer = $this->customerIoService->getCustomerByEmail($accountName, $createdCustomer->email);

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
            $userId,
            $createdAt
        );

        Event::assertDispatched(CustomerCreated::class);

        $data = [
            'email' => $createdCustomer->email,
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
                ->find(1)->email
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(20);

        $data = array_merge($data, $customAttributes);

        $fetchedCustomer = $this->customerIoService->getCustomerByEmail($accountName, $createdCustomer->email);

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
            'email' => $createdCustomer->email,
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
                ->find(1)->email
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(4);

        $data = array_merge($data, $customAttributes);

        $fetchedCustomer = $this->customerIoService->getCustomerByEmail($accountName, $createdCustomer->email);

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
            'email' => $createdCustomer->email,
            'user_id' => $createdCustomer->user_id,
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
                ->find(1)->email
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(40);

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
        sleep(40);

        $fetchedCustomer = $this->customerIoService->getCustomerByEmail($accountName, $updatedCustomer->email);

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
        $email = $this->faker->email;
        $formName = 'Blog Signup';
        config(['customer-io.forms.brand' => 'singeo']);
        $eventName = config('customer-io.forms.' . config('customer-io.forms.brand') . '.' . $formName . '.events')[0];
        $accountConfigData = $this->customerIoService->getAccountConfigData('singeo');

        $customers = $this->customerIoService->processForm($email, $formName, []);
        sleep(20);
        $createdCustomer = $customers[0];

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
                ->find(1)->email
        );

        sleep(5);

        $fetchedCustomer = $this->customerIoService->getCustomerByEmail('singeo', $createdCustomer->email);

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

        $fetchedCustomerActivities = $this->customerIoApiGateway->getCustomerActivities(
            $accountConfigData['app_api_key'],
            $createdCustomer->email,
            'event'
        );

        $fetchedEventNames = [];

        foreach ($fetchedCustomerActivities as $fetchedCustomerActivity) {
            $fetchedEventNames[] = $fetchedCustomerActivity['name'];
        }

        $this->assertContains($eventName, $fetchedEventNames);
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
        $user = User::factory()->create();
        $email = $this->faker->email;
        $accountName = 'musora';
        $createdAt =
            Carbon::now()
            ->subDays(2)->timestamp;

        $createdCustomer = $this->customerIoService->createCustomer(
            $email,
            $accountName,
            userId: $user->id
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
        sleep(20);

        $primaryCustomer = $this->customerIoService->mergeCustomers(
            $accountName,
            $createdCustomer1->email,
            $createdCustomer2->email
        );

        sleep(20);

        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);

        $fetchedCustomer = $this->customerIoApiGateway->getCustomer(
            $accountConfigData['app_api_key'],
            $primaryCustomer->email
        );

        // duplicate should now be missing
        try {
            $this->customerIoApiGateway->getCustomer(
                $accountConfigData['app_api_key'],
                $createdCustomer2->email
            );
        } catch (Exception $exception) {
            $this->assertEquals(404, $exception->getCode());
        }

        $this->assertDatabaseMissing('customer_io_customers', $createdCustomer2->attributesToArray());
        $this->assertEquals($primaryCustomer->email, $fetchedCustomer['attributes']['email']);
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
            $createdAt2
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(20);

        $primaryCustomer = $this->customerIoService->mergeCustomers(
            $accountName,
            $createdCustomer1->email,
            $createdCustomer2->email
        );

        sleep(20);

        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);

        $fetchedCustomer = $this->customerIoApiGateway->getCustomer(
            $accountConfigData['app_api_key'],
            $primaryCustomer->email
        );

        // duplicate should now be missing
        try {
            $this->customerIoApiGateway->getCustomer(
                $accountConfigData['app_api_key'],
                $createdCustomer2->email
            );
        } catch (Exception $exception) {
            $this->assertEquals(404, $exception->getCode());
        }

        $this->assertDatabaseMissing('customer_io_customers', ['email' => $createdCustomer2->email]);
        $this->assertDatabaseHas('customer_io_customers', ['email' => $primaryCustomer->email]);
        $this->assertDatabaseHas('customer_io_customers', [
            'email' => $primaryCustomer->email,
            'created_at' => Carbon::now()
                ->subDays(5)->toDateTimeString()
        ]);
        $this->assertEquals(Carbon::now()->subDays(5)->timestamp, $fetchedCustomer['attributes']['created_at']);
        $this->assertEquals($primaryCustomer->email, $fetchedCustomer['attributes']['email']);
        $this->assertEquals("value-not-overwritten", $fetchedCustomer['attributes']['test1']);
        $this->assertEquals("new-value", $fetchedCustomer['attributes']['test2']);
        $this->assertEquals("this-is-set", $fetchedCustomer['attributes']['test3']);
    }

    public function test_merge_customers_failed_missing_from_db()
    {
        $accountName = 'musora';
        $email = $this->faker->email;
        $attributes1 = ['test1' => 'value-not-overwritten', 'test2' => 'new-value', 'test3' => ''];

        $createdCustomer1 = $this->customerIoService->createCustomer(
            $email,
            $accountName,
            $attributes1
        );

        // for some reason the fetch API needs some time to update otherwise we always get 404
        sleep(4);

        try {
            $this->customerIoService->mergeCustomers(
                $accountName,
                $createdCustomer1->email,
                'test-fail-email'
            );
        } catch (Exception $exception) {
            $this->assertEquals(
                'Could not merge customer ids because one is missing from the database. $primaryCustomerId:' .
                    $createdCustomer1->email . ' - $secondaryCustomerId:test-fail-email - $accountName: musora',
                $exception->getMessage()
            );
        }

        sleep(20);

        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);

        $fetchedCustomer = $this->customerIoApiGateway->getCustomer(
            $accountConfigData['app_api_key'],
            $createdCustomer1->email
        );

        $this->assertDatabaseHas('customer_io_customers', ['email' => $createdCustomer1->email]);
        $this->assertEquals($createdCustomer1->email, $fetchedCustomer['attributes']['email']);
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
                $accountName,
                'test',
            );
        } catch (Exception) {
            $this->fail('CustomerIoService::createEventForEmailOrId() should not throw an exception');
        }

        $this->assertNotNull($customer);
        $this->assertEquals($createdCustomer->email, $customer->email);
    }

    public function test_create_event_for_user_id()
    {
        $accountName = 'musora';
        $email = $this->faker->email;
        $userId = rand();

        $this->customerIoService->createCustomer(
            $email,
            $accountName,
            [],
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
            $userId
        );

        try {
            $this->customerIoService->deleteCustomer($userId, $accountName);
        } catch (Throwable $t) {
            Log::error($t->getMessage());
            $this->fail('CustomerIoService::deleteCustomer() should not throw an exception');
        }

        try {
            $this->customerIoApiGateway->getCustomer(
                $accountConfigData['app_api_key'],
                $createdCustomer->email
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

    public function test_update_customer_email()
    {
        $newEmail = $this->faker->email;
        $oldEmail = $this->faker->email;
        $accountName = 'musora';

        $user = User::factory()->create(['email' => $oldEmail]);
        $this->customerIoService->createCustomer($oldEmail, $accountName, [], $user->id);

        sleep(80);

        $this->customerIoService->updateCustomerEmail($accountName, $newEmail, $oldEmail);

        sleep(80);

        $newCustomer = $this->customerIoService->getCustomerByEmail($accountName, $newEmail);

        $oldCustomer = $this->customerIoService->getCustomerByEmail($accountName, $oldEmail, false);

        $this->assertNull($oldCustomer);

        $this->assertEquals($newCustomer->email, $newEmail);
        $this->assertEquals($newCustomer->getExternalAttributes()['email'], $newEmail);

        $this->assertEquals($newCustomer->user_id, $user->id);
        $this->assertEquals($newCustomer->getExternalAttributes()['musora_user_id'], $user->id);
    }

    public function test_create_or_update_customer_create_prospect_workspace()
    {
        $email = $this->faker->email;
        $accountName = 'musora_prospects';
        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);
        $userId = rand();
        $createdAt = Carbon::now()->timestamp;

        Event::fake();

        $this->customerIoService->createCustomer(
            $email,
            $accountName,
            userId: $userId,
            createdAtTimestamp: $createdAt
        );

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

        Event::assertDispatched(CustomerUpdated::class);

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

        $this->assertNotEmpty(Customer::query()->firstWhere('email', $email)->uuid);
    }

    public function test_create_or_update_customer_update_not_sync_prospect_workspace()
    {
        $email = $this->faker->email;
        $accountName = 'musora';
        $accountConfigData = $this->customerIoService->getAccountConfigData($accountName);
        $userId = rand();
        $createdAt = Carbon::now()->timestamp;

        Event::fake();

        $customAttributes = [
            'my_string_1' => $this->faker->text(),
            'my_bool_1' => true,
            'my_integer_1' => 5,
            'my_timestamp_1' => Carbon::now()
                ->subDays(100)->timestamp,
        ];

        $createdCustomer = $this->customerIoService->createOrUpdateCustomerByEmail(
            $email,
            $accountName,
            $customAttributes,
            $userId,
            $createdAt
        );

        Event::assertNotDispatched(CustomerUpdated::class);

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
        $this->assertNotEmpty(Customer::query()->firstWhere('email', $email)->uuid);
    }

    public function test_customer_email_changed()
    {
        $oldEmail = $this->faker->email;
        $newEmail = $this->faker->email;
        $accountName = 'musora';
        $userId = rand();
        $createdAt = Carbon::now()->timestamp;

        Event::fake();

        $this->customerIoService->createOrUpdateCustomerByEmail(
            $oldEmail,
            $accountName,
            [],
            $userId,
            $createdAt
        );

        sleep(20);

        Event::assertNotDispatched(CustomerUpdated::class);

        $this->assertNotEmpty(Customer::query()->firstWhere('email', $oldEmail)->uuid);

        $this->customerIoService->updateCustomerEmail($accountName, $newEmail, $oldEmail);

        sleep(20);

        $fetchedCustomer = $this->customerIoService->getCustomerByEmail($accountName, $newEmail);

        $this->assertEquals($fetchedCustomer->email, $newEmail);
        $this->assertEquals($fetchedCustomer->getExternalAttributes()['email'], $newEmail);
    }
}
