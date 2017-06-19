<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;

/**
 * Class CategoryRepository
 *
 * For explanation on the 'nested set model' see:
 * http://mikehillyer.com/articles/managing-hierarchical-data-in-mysql/
 *
 * @package Railroad\Railcontent\Repositories
 */
class CategoryRepository extends RepositoryBase
{
    public function create($slug, $parentId, $position, array $fields, array $data)
    {
        $categoryId = null;

        $this->transaction(
            function () use ($slug, $parentId, $position, $fields, $data, &$categoryId) {
                $categoryId = $this->query()->insertGetId(
                    [
                        'slug' => $slug,
                        'parent_id' => $parentId,
                        'lft' => 0,
                        'rgt' => 0,
                        'position' => $position,
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString(),
                    ]
                );

                $this->repositionCategoryPositions($categoryId, $preferredPosition);
                $this->repositionTree();
            }
        );

        return $categoryId;
    }

    public function updatePosition($id, $left, $right, $parentId)
    {

    }

    public function updateOrCreateField($id, $key, $value)
    {

    }

    public function updateOrCreateDatum($id, $key, $value)
    {

    }

    public function delete($id, $deleteChildren = false)
    {

    }

    public function deleteField($id, $key)
    {

    }

    public function deleteDatum($id, $key)
    {

    }

    public function getById($id)
    {

    }

    public function getBySlug($slug)
    {

    }

    public function getBetween($lft, $rgt)
    {

    }

    public function repositionTree()
    {
        $this->repositionSubTree(null, 1);
    }

    public function repositionSubTree($categoryId, $start)
    {
        $childCategories =
            $this->query()->where('parent_id', $categoryId)->orderBy('position')->get()->toArray();

        $end = $start + 1;

        foreach ($childCategories as $index => $childCategory) {
            $end =
                $this->repositionSubTree(
                    $childCategory->id,
                    is_null($categoryId) ? $start : $end
                ) + 1;
        }

        if (!is_null($categoryId)) {
            $this->query()->where('id', $categoryId)->update(['lft' => $start, 'rgt' => $end]);
        }

        return $end;
    }

    public function repositionCategoryPositions($categoryId, $childCategoryId, $preferredChildPosition)
    {

    }

    /**
     * @return Builder
     */
    public function query()
    {
        return parent::connection()->table(ConfigService::$tableCategories);
    }
}