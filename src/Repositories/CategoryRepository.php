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
     * Insert a new category in the database, recalculate position and regenerate tree
     *
     * @param string $slug
     * @param integer $parentId
     * @param integer $position
     * @return int $categoryId
     */
    public function create($slug, $parentId, $position, $status, $type)
    {
        $categoryId = null;

        $this->transaction(
            function () use ($slug, $parentId, $position, &$categoryId, $status, $type) {

                $categoryId = $this->query()->insertGetId(
                    [
                        'slug' => $slug,
                        'parent_id' => $parentId,
                        'lft' => 0,
                        'rgt' => 0,
                        'position' => $position,
                        'status' => $status,
                        'type' => $type,
                        'published_on' => null,
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

    /**
     * Update a category record, recalculate position, regenerate tree and return the category id
     *
     * @param integer $categoryId
     * @param string $slug
     * @param integer $position
     * @return integer $categoryId
     */
    public function update($categoryId, $slug, $position, $status, $type)
    {
        $this->transaction(
            function () use ($slug,  $position, &$categoryId, $status, $type) {
                $this->query()->where('id', $categoryId)->update(
                    [
                        'slug' => $slug,
                        'position' => $position,
                        'status' => $status,
                        'type' => $type,
                        'updated_at' => Carbon::now()->toDateTimeString(),
                    ]
                );

                $this->reposition($categoryId, $position);
                $this->regenerateTree();
            }
        );

        return $categoryId;
    }

    /**
     * Delete category and children, recalculate position for other category with the same parent and regenerate tree
     * @param $categoryId
     * @param bool $deleteChildren
     */
    public function delete($categoryId, $deleteChildren = false)
    {
        $delete = false;

        $this->transaction(
            function () use (&$categoryId, &$deleteChildren, &$delete) {
                $category = $this->getById($categoryId);

                if(is_null($category))
                {
                    return $delete;
                }

                //unlink category content
                $this->unlinkCategoryContent($categoryId);

                if($deleteChildren)
                {
                    //delete category and children
                    $this->query()->whereBetween('lft',[$category->lft,$category->rgt])->delete();
                }
                else
                {
                    //delete category
                    $this->query()->where('lft',$category->lft)->delete();

                    //move children on category parent id
                    $this->query()->whereBetween('lft',[$category->lft,$category->rgt])->update(['parent_id'=>$category->parent_id]);
                }

                //reposition categories with the same parent id
                $this->otherChildrenRepositions($category->parent_id, $categoryId, 0);

                //regenerate tree
                $this->regenerateTree();

                $delete = true;
            }
        );

        return $delete;
    }

    /** Return the category with the requested id from the database
     * @param integer $id
     * @return array
     */
    public function getById($id)
    {
        return $this->query()->where('id',$id)->get()->first();
    }

    public function getBySlug($slug)
    {

    }

    public function getBetween($lft, $rgt)
    {

    }

    /**
     * Call regenerateSubTree function
     * @return void
     */
    public function regenerateTree()
    {
        $this->regenerateSubTree(null, 0);
    }

    /**
     * Regenerate lft and rgt value
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
     * Update category position and call function that recalculate position for other children
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

                $this->otherChildrenRepositions($parentCategoryId, $categoryId, $position);
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

    /**
     * @return Builder
     */
    public function contentCategoriesQuery()
    {
        return parent::connection()->table(ConfigService::$tableContentCategories);
    }

    /** Update position for other categories with the same parent id
     * @param integer $parentCategoryId
     * @param integer $categoryId
     * @param integer $position
     */
    function otherChildrenRepositions ($parentCategoryId, $categoryId, $position)
    {
        $childCategories =
            $this->query()
                ->where('parent_id', $parentCategoryId)
                ->where('id', '<>', $categoryId)
                ->orderBy('position')
                ->get()
                ->toArray();

        $start = 1;

        foreach ($childCategories as $childCategory) {
            if($start == $position)
            {
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

    /**
     * Delete the links between category and content
     * @param integer $categoryId
     */
    function unlinkCategoryContent ($categoryId)
    {
        $this->contentCategoriesQuery()->where('category_id', $categoryId)->delete();
    }

    /**
     * Get category data
     * @param integer $id
     * @return array
     */
    public function getCategory($id)
    {
        $category = $this->query()
            ->where('id', $id)
            ->get()->toArray();

        return $category;
    }

    /**
     * Get all categories order by parent and position
     * @return array
     */
    public function getAllCategories()
    {
        return $this->query()->orderBy('parent_id','asc')->orderBy('position','asc')->get()->toArray();
    }
}