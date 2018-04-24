<?php

namespace Railroad\Railcontent\Tests\Feature;

use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Validator;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class MultipleColumnExistsRuleTest extends RailcontentTestCase
{
    /**
     * @var DatabaseManager
     */
    protected $databaseManager;
    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * MultipleColumnExistsRuleTest constructor.
     */
    public function setUp()
    {
        parent::setUp();

        $this->databaseManager = app()->make(DatabaseManager::class);
        $this->contentFactory = app()->make(ContentFactory::class);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test()
    {
        //dd($this->app['config']['railcontent.validation'][ConfigService::$brand]);

        $type = 'test-type';
        $content = $this->contentFactory->create('testslug', $type);

        $connectionName = RailcontentTestCase::getConnectionType();

        $rule = 'exists_multiple_columns:' .

            $connectionName . ',' .
            'railcontent_content,' .
            'id' .

            '&' .
            $connectionName . ',' .
            'railcontent_content,' .
            'type,' .
            $type;

        /**
         * @var $validator Validator
         */
        $validator = Validator::make(
            ['id' => $content['id']],
            ['id' => $rule]
        );

        $this->assertEquals('1', $validator->validate()['id']);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_or_case()
    {
        //dd($this->app['config']['railcontent.validation'][ConfigService::$brand]);

        $type = $this->faker->word;
        $content = $this->contentFactory->create('testslug', $type);

        $connectionName = RailcontentTestCase::getConnectionType();

        $rule = 'exists_multiple_columns:' .

            $connectionName . ',' .
            'railcontent_content,' .
            'id' .

            '&' .
            $connectionName . ',' .
            'railcontent_content,' .
            'type,' .
            $type.

            '&' .
            $connectionName . ',' .
            'railcontent_content,' .
            'type,' .
            'or:' . $this->faker->word;

        /**
         * @var $validator Validator
         */
        $validator = Validator::make(
            ['id' => $content['id']],
            ['id' => $rule]
        );

        $this->assertEquals('1', $validator->validate()['id']);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_or_case_fail()
    {
        //dd($this->app['config']['railcontent.validation'][ConfigService::$brand]);

        $type = $this->faker->word;
        $content = $this->contentFactory->create('testslug', $type);

        $type = $this->faker->word; // below will eval with different than was used in create above, ergo will fail

        $connectionName = RailcontentTestCase::getConnectionType();

        $rule = 'exists_multiple_columns:' .

            $connectionName . ',' .
            'railcontent_content,' .
            'id' .

            '&' .
            $connectionName . ',' .
            'railcontent_content,' .
            'type,' .
            $type.

            '&' .
            $connectionName . ',' .
            'railcontent_content,' .
            'type,' .
            'or:' . $this->faker->word;

        /**
         * @var $validator Validator
         */
        $validator = Validator::make(
            ['id' => $content['id']],
            ['id' => $rule]
        );

        $this->expectException('Illuminate\Validation\ValidationException');
    }
}
