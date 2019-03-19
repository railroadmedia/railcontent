<?php

namespace Railroad\Railcontent\Tests\Feature;

use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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

    private function createContent($type, $slug){
        $content = $this->fakeContent(1,[
            'type' => $type,
            'slug' => $slug
        ]);

        if(is_null($content)){
            $this->fail('Failed to generate mock content.');
        }

        return $content[0];
    }

    /**
     * Put a description here maybe?
     *
     * @return void
     */
    public function test_pass()
    {
        $typeOne = $this->faker->word;
        $contentOne = $this->createContent($typeOne, $this->faker->word);
        $connectionName = RailcontentTestCase::getConnectionType();
        $rule = 'exists_multiple_columns:' . $connectionName . ',' . 'railcontent_content,' . 'id' . '&' .
            $connectionName . ',' . 'railcontent_content,' . 'type,' . $typeOne;
        /** @var $validator Validator */
        $validator = Validator::make(['id' => $contentOne->getId()],['id' => $rule]);
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
        $contentOne = $this->createContent($typeOne, $this->faker->word);

        $typeTwo = $this->faker->word;
        $this->createContent($typeTwo, $this->faker->word);
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
            ['id' => $contentOne->getId()],
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
            ['id' => $contentOne->getId()],
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
        $slug = $this->faker->word;
        $type = $this->faker->word;

        $content = $this->createContent($type, $slug);

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
            ['id' => $content->getId()],
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

        $content = $this->createContent($type, 'testslug');

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
            ['id' => $content->getId()],
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
    public function test_multiple_or_clauses()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;

        $content = $this->createContent($type, $slug);

        $this->createContent($type, $this->faker->word);
        $this->createContent($type, $this->faker->word);
        $this->createContent($type, $this->faker->word);
        $this->createContent($type, $this->faker->word);

        $this->createContent($this->faker->word, $slug);
        $this->createContent($this->faker->word, $slug);
        $this->createContent($this->faker->word, $slug);
        $this->createContent($this->faker->word, $slug);

        $this->createContent($this->faker->word, $this->faker->word);
        $this->createContent($this->faker->word, $this->faker->word);
        $this->createContent($this->faker->word, $this->faker->word);
        $this->createContent($this->faker->word, $this->faker->word);

        do {
            $slugToNotFind = $this->faker->word;
        } while ($slugToNotFind === $slug || $slugToNotFind === $slug);
        do {
            $typeToNotFind = $this->faker->word;
        } while ($typeToNotFind === $type || $typeToNotFind === $type);

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
            $typeToNotFind .

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
            $slugToNotFind;

        /**
         * @var $validator Validator
         */
        $validator = Validator::make(
            ['id' => $content->getId()],
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
    public function test_multiple_or_clauses_fail(){
        /*
         * I was having issue with this test failing - inconsistantly - because of collisions from $this->faker-word
         * products. So, there's some stringent checking before calling the system under test, and we run it bunch
         * of times to increase the odds of triggering an edge case. 25 runs takes about 25s.
         *
         * * Jonathan, April 2018
         */
        for ($i = 1; $i <= 25; $i++) {
            $this->run_multiple_or_clauses_fail();
        }
    }


    public function run_multiple_or_clauses_fail()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;

        $content = $this->createContent($type, $slug);

        $this->createContent($type, $this->faker->word);
        $this->createContent($type, $this->faker->word);
        $this->createContent($type, $this->faker->word);
        $this->createContent($type, $this->faker->word);

        $this->createContent($this->faker->word, $slug);
        $this->createContent($this->faker->word, $slug);
        $this->createContent($this->faker->word, $slug);
        $this->createContent($this->faker->word, $slug);

        $this->createContent($this->faker->word, $this->faker->word);
        $this->createContent($this->faker->word, $this->faker->word);
        $this->createContent($this->faker->word, $this->faker->word);
        $this->createContent($this->faker->word, $this->faker->word);

        $oldSlug = $slug;
        $oldType = $type;

        if(rand(0,1)){ // randomly pick one to not match
            do {
                $slugForFail = $this->faker->word;
                // $slugForFail = rand(0,10) < 1 ? $this->faker->word : $slug; // confirm works has expected
            } while ($slugForFail === $slug);
            $slug = $slugForFail;
        }else{
            do {
                $typeForFail = $this->faker->word;
            } while ($typeForFail === $type);
            $type = $typeForFail;
        }

        do {
            $slugToNotFind = $this->faker->word;
        } while ($slugToNotFind === $oldSlug || $slugToNotFind === $slug);
        do {
            $typeToNotFind = $this->faker->word;
        } while ($typeToNotFind === $oldType || $typeToNotFind === $type);

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
            $typeToNotFind .

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
            $slugToNotFind;

        /**
         * @var $validator Validator
         */
        $validator = Validator::make(
            ['id' => $content->getId()],
            ['id' => $rule]
        );

        /*
         * This was fine except when calling this test a bunch of times in a loop, it would fail on the last call.
         * Was very weird, so I just commented it out and replaced it with the try-catch below.
         *
         * Jonathan, April 2018
         */
        //$this->expectException('Illuminate\Validation\ValidationException');

        try{
            $validator->validate()['id'];
        }catch(ValidationException $exception){
            $this->assertTrue(true);
            return true;
        }

        $this->fail('yup, failed');
    }
}
