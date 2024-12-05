<?php

namespace App\Modules\Content\tests\Unit;

use App\Modules\Content\Resources\Algolia\Enum\Facet;
use App\Modules\Content\Resources\Algolia\Enum\Index;
use Tests\TestCase;

class FacetEnumTest extends TestCase
{
    public function test_is_in_index_works_for_facet_in_only_specific_index(): void
    {
        $album = Facet::Album;
        $songIndex = Index::Song;
        $allIndex = Index::All;
        $this->assertTrue($album->isInIndex($songIndex));
        $this->assertFalse($album->isInIndex($allIndex));
    }
}
