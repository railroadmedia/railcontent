<?php


use App\Modules\Content\Resources\Algolia\Enum\Index;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class IndexEnumTest extends TestCase
{
    public function test_value_for_environment_works(): void
    {
        $environment = 'foo';
        Config::set('algolia.environment', $environment);
        $index = Index::All;
        $this->assertEquals("{$environment}_{$index->value}", $index->valueForEnvironment());
    }
}
