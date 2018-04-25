<?php

namespace Railroad\Railcontent\Tests\Feature;

use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Validator;
use Railroad\Railcontent\Factories\ContentFactory;
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

    private function createContent(...$arg){
        $content = $this->contentFactory->create(...$arg);

        if(is_null($content)){
            $this->fail('Failed to generate mock content.');
        }

        return $content;
    }

    /**
     * Put a description here maybe?
     *
     * @return void
     */
    public function test_pass()
    {
        $typeOne = $this->faker->word;
        $contentOne = $this->createContent($this->faker->word, $typeOne);
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
        $contentOne = $this->createContent($this->faker->word, $typeOne);

        $typeTwo = $this->faker->word;
        $this->createContent($this->faker->word, $typeTwo);

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
        $type = $this->faker->word;
        $content = $this->createContent('testslug', $type);

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
            'or:' . // <-- note this here... it makes all the difference
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

        $validationResult = $validator->validate()['id'];

        $this->assertEquals('1', $validationResult);
    }

    /**
     * Put a description here maybe?
     *
     * @return void
     */
    public function test_or_case_fail()
    {
        $type = $this->faker->word;
        $typeForFailOne = $this->faker->word;
        $typeForFailTwo = $this->faker->word;

        $content = $this->createContent('testslug', $type);

        $connectionName = RailcontentTestCase::getConnectionType();

        $rule = 'exists_multiple_columns:' .

            $connectionName . ',' .
            'railcontent_content,' .
            'id' .

            '&' .
            $connectionName . ',' .
            'railcontent_content,' .
            'type,' .
            $typeForFailOne .

            '&' .
            'or:' . // <-- note this here... it makes all the difference
            $connectionName . ',' .
            'railcontent_content,' .
            'type,' .
            $typeForFailTwo;

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

    /**
     * Put a description here maybe?
     *
     * @return void
     */
    public function test_extreme()
    {
        $type = $this->faker->word;
        $slug = $this->faker->word;
        $status = $this->faker->word;

        $content = $this->createContent($slug, $type, $status);

        $this->createContent($type, $this->faker->word, $this->faker->word);
        $this->createContent($type, $this->faker->word, $this->faker->word);
        $this->createContent($type, $this->faker->word, $this->faker->word);
        $this->createContent($type, $this->faker->word, $this->faker->word);
        $this->createContent($this->faker->word, $slug, $this->faker->word);
        $this->createContent($this->faker->word, $slug, $this->faker->word);
        $this->createContent($this->faker->word, $slug, $this->faker->word);
        $this->createContent($this->faker->word, $slug, $this->faker->word);
        $this->createContent($this->faker->word, $this->faker->word, $status);
        $this->createContent($this->faker->word, $this->faker->word, $status);
        $this->createContent($this->faker->word, $this->faker->word, $status);
        $this->createContent($this->faker->word, $this->faker->word, $status);
        $this->createContent($this->faker->word, $this->faker->word, $this->faker->word);
        $this->createContent($this->faker->word, $this->faker->word, $this->faker->word);
        $this->createContent($this->faker->word, $this->faker->word, $this->faker->word);
        $this->createContent($this->faker->word, $this->faker->word, $this->faker->word);

        $connectionName = RailcontentTestCase::getConnectionType();

        $rule = 'exists_multiple_columns:' .

            $connectionName . ',' .
            'railcontent_content,' .
            'id' .

            // ------------------------------------------------------------------------

            '&' .
            $connectionName . ',' .
            'railcontent_content,' .
            'type,' .
            $type.

            '&' .
            'or:' . // <-- note this here... it makes all the difference
            $connectionName . ',' .
            'railcontent_content,' .
            'type,' .
            $this->faker->word .

            // ------------------------------------------------------------------------

            '&' .
            $connectionName . ',' .
            'railcontent_content,' .
            'slug,' .
            $slug.

            '&' .
            'or:' . // <-- note this here... it makes all the difference
            $connectionName . ',' .
            'railcontent_content,' .
            'slug,' .
            $this->faker->word .

            // ------------------------------------------------------------------------

            '&' .
            $connectionName . ',' .
            'railcontent_content,' .
            'status,' .
            $status.

            '&' .
            'or:' . // <-- note this here... it makes all the difference
            $connectionName . ',' .
            'railcontent_content,' .
            'status,' .
            $this->faker->word;



        /**
         * @var $validator Validator
         */
        $validator = Validator::make(
            ['id' => $content['id']],
            ['id' => $rule]
        );

        $validationResult = $validator->validate()['id'];

        $this->assertEquals('1', $validationResult);
    }
}
