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
     * Put a description here maybe?
     *
     * @return void
     */
    public function test_pass()
    {
        $typeOne = $this->faker->word;
        $contentOne = $this->contentFactory->create($this->faker->word, $typeOne);
        $connectionName = RailcontentTestCase::getConnectionType();
        $rule = 'exists_multiple_columns:' . $connectionName . ',' . 'railcontent_content,' . 'id' . '&' .
            $connectionName . ',' . 'railcontent_content,' . 'type,' . $typeOne;
        /** @var $validator Validator */
        $validator = Validator::make(['id' => $contentOne['id']],['id' => $rule]);
        $this->assertEquals('1', $validator->validate()['id']);
    }

    /**
     * Put a description here maybe?
     *
     * @return void
     */
    public function test_pass_and_fail()
    {
        $typeOne = $this->faker->word;
        $contentOne = $this->contentFactory->create($this->faker->word, $typeOne);

        $typeTwo = $this->faker->word;
        $this->contentFactory->create($this->faker->word, $typeTwo);

        $connectionName = RailcontentTestCase::getConnectionType();

        $rule = 'exists_multiple_columns:' .

            $connectionName . ',' .
            'railcontent_content,' .
            'id' .

            '&' .
            $connectionName . ',' .
            'railcontent_content,' .
            'type,' .
            $typeOne;

        /**
         * @var $validator Validator
         */
        $validator = Validator::make(
            ['id' => $contentOne['id']],
            ['id' => $rule]
        );

        $this->assertEquals('1', $validator->validate()['id']);

        $ruleAgain = 'exists_multiple_columns:' .

            $connectionName . ',' .
            'railcontent_content,' .
            'id' .

            '&' .
            $connectionName . ',' .
            'railcontent_content,' .
            'type,' .
            $typeTwo;

        /**
         * @var $validator Validator
         */
        $validatorAgain = Validator::make(
            ['id' => $contentOne['id']],
            ['id' => $ruleAgain]
        );

        $this->expectException('Illuminate\Validation\ValidationException');

        $validatorAgain->validate()['id'];
    }

    /**
     * Put a description here maybe?
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
     * Put a description here maybe?
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
            'or:' . // ============= <--- OR (!!!) =============
            $connectionName . ',' .
            'railcontent_content,' .
            'type,' .
            $this->faker->word;

        /**
         * @var $validator Validator
         */
        $validator = Validator::make(
            ['id' => $content['id']],
            ['id' => $rule]
        );

        $this->expectException('Illuminate\Validation\ValidationException');

        $validator->validate()['id'];
    }
}
