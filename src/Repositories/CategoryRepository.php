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
    /**
     * @param $slug
     * @param $parentId
     * @param $position
     * @return int
     */
    public function create($slug, $parentId, $position)
    {
        $categoryId = null;

        $this->transaction(
            function () use ($slug, $parentId, $position, &$categoryId) {
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

                $this->reposition($categoryId, $position);
                $this->regenerateTree();
            }
        );

        return $categoryId;
    }

    /** Update a category record, recalculate position, regenerate tree and return the category id
     * @param integer $categoryId
     * @param string $slug
     * @param integer $position
     * @return integer $categoryId
     */
    public function update($categoryId, $slug, $position)
    {
        $this->transaction(
            function () use ($slug,  $position, &$categoryId) {
                $this->query()->where('id', $categoryId)->update(
                    [
                        'slug' => $slug,
                        'position' => $position,
                        'updated_at' => Carbon::now()->toDateTimeString(),
                    ]
                );

                $this->reposition($categoryId, $position);
                $this->regenerateTree();
            }
        );

        return $categoryId;

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

    /** Return the category with the requested id from the database
     * @param integer $id
     * @return array
     */
    public function getById($id)
    {
        return $this->query()->where('id', $id)->get()->first();
    }

    public function getBySlug($slug)
    {

    }

    public function getBetween($lft, $rgt)
    {

    }

    /**
     * @return void
     */
    public function regenerateTree()
    {
        $this->regenerateSubTree(null, 0);
    }

    /**
     * @param int $categoryId
     * @param int $leftStart
     * @return int
     */
    public function regenerateSubTree($categoryId, $leftStart)
    {
        $childCategories =
            $this->query()->where('parent_id', $categoryId)->orderBy('position')->get()->toArray();

        $startRight = $leftStart + 1;
        $recursiveRight = $startRight;

        foreach ($childCategories as $index => $childCategory) {
            $recursiveRight =
                $this->regenerateSubTree(
                    $childCategory->id,
                    $recursiveRight
                );

            $recursiveRight++;
        }

        if ($categoryId != null) {
            $this->query()->where('id', $categoryId)->update(
                ['lft' => $leftStart, 'rgt' => $recursiveRight]
            );
        }

        return $recursiveRight;
    }

    /**
     * @param int $categoryId
     * @param int $position
     */
    public function reposition($categoryId, $position)
    {
        $parentCategoryId = $this->query()->where('id', $categoryId)->first(['parent_id'])->parent_id
            ?? null;
        $childCategoryCount = $this->query()->where('parent_id', $parentCategoryId)->count();

        if ($position < 1) {
            $position = 1;
        } elseif ($position > $childCategoryCount) {
            $position = $childCategoryCount;
        }

        $this->transaction(
            function () use ($categoryId, $position, $parentCategoryId) {
                $this->query()
                    ->where('id', $categoryId)
                    ->update(
                        ['position' => $position]
                    );

                $childCategories =
                    $this->query()
                        ->where('parent_id', $parentCategoryId)
                        ->orderBy('position')
                        ->get()
                        ->toArray();

                $start = 1;

                foreach ($childCategories as $childCategory) {
                    if ($childCategory->id == $categoryId) {
                        continue;
                    } elseif ($childCategory->position == $position) {
                        $start++;
                    }

                    $this->query()
                        ->where('id', $childCategory->id)
                        ->update(
                            ['position' => $start]
                        );

                    $start++;
                }
            }
        );
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return parent::connection()->table(ConfigService::$tableCategories);
    }
}