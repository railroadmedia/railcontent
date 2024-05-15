<?php

namespace App\Modules\FeatureFlagging\Services;

use App\Modules\FeatureFlagging\Managers\FeatureFlagManager;
use App\Modules\FeatureFlagging\Models\Branch;
use App\Modules\FeatureFlagging\Models\Experiment;
use App\Modules\FeatureFlagging\Models\Tracking;
use App\Modules\FeatureFlagging\Models\Feature;
use Carbon\Carbon;

class FeatureFlagService
{
    /**
     * @param string $name - Human readable name of feature
     * @param string|null $active_at - Timestamp when feature should be enabled
     * @param string|null $description - Human readable description of feature
     * @param array|string|null $allow_filter - Array or comma separated values for different pass-filters to apply to this feature
     * @param array|string|null $block_filter - Array or comma separated values for different block-filters to apply to this feature
     * @param array|string|null $userid_list -- Array or comma separated values for user ids
     * @return Feature
     */
    public function addFeature(string $name, string $active_at = null, string $description = null, array|string $allow_filter = null, array|string $block_filter = null, array|string $userid_list = null): Feature
    {
        $values = [
            'name' => $name,
            'active_at' => $active_at ?? Carbon::now(),
            'description' => $description,
            'allow_filter' => $allow_filter,
            'block_filter' => $block_filter,
            'userid_list' => $userid_list
        ];
        $values = $this->convertArrayParamsToString($values);
        return Feature::create($values);
    }

    /**
     * @param int $id - Id of the feature to update
     * @param array $attributesToUpdate - value array of columns to update. Array values will be transformed to comma separated strings
     * @return void
     */
    public function editFeature(int $id, array $attributesToUpdate)
    {
        $this->throwIfInvalidUpdate($attributesToUpdate, 'Feature');
        $attributesToUpdate = $this->convertArrayParamsToString($attributesToUpdate);
        Feature::updateOrCreate(['id' => $id], $attributesToUpdate);
    }

    public function deleteFeature(int $id)
    {
        Feature::destroy([$id]);
    }

    /**
     * @param string $name - Human readable name of Experiment
     * @param string|null $default_value - default string value to return if no branch selected, or experiment is disabled
     * @param bool $enabled - Toggle if experiment should use default values, or branch
     * @return Experiment
     */
    public function addExperiment(string $name, string $default_value = null, bool $enabled = true): Experiment
    {
        $values = [
            'name' => $name,
            'default_value' => $default_value,
            'enabled' => $enabled,
        ];
        $values = $this->convertArrayParamsToString($values);
        return Experiment::create($values);
    }

    public function deleteExperiment(int $id)
    {
        $trackings = Tracking::where(['experiment_id' => $id]);
        $branches = Branch::where(['experiment_id' => $id]);
        Tracking::destroy($trackings->select('id')->get());
        Branch::destroy($branches->select('id')->get());
        Experiment::destroy([$id]);
    }

    public function setExperimentEnabled(int $id, $enabled = true)
    {
        Experiment::updateOrCreate(['id' => $id], ['enabled' => $enabled]);
    }


    public function addBranch(string $name, string $content, int $experimentID, int $priority = null, array|string $allow_filter = null, int $weight = null, array|string $userid_list = null): Branch
    {
        if ($weight <= 0  && !FeatureFlagManager::isValidFilter($allow_filter)) {
            throw new \InvalidArgumentException('A Branch must have either a positive weight or a valid allow_filter');
        }
        $values = [
            'name' => $name,
            'content' => $content,
            'experiment_id' => $experimentID,
            'priority' => $priority,
            'allow_filter' => $allow_filter,
            'userid_list' => $userid_list,
            'weight' => $weight
        ];
        $values = $this->convertArrayParamsToString($values);
        return Branch::create($values);
    }

    public function editBranch(int $id, array $attributesToUpdate)
    {
        $this->throwIfInvalidUpdate($attributesToUpdate, 'Branch');
        $attributesToUpdate = $this->convertArrayParamsToString($attributesToUpdate);
        Branch::updateOrCreate(['id' => $id], $attributesToUpdate);
    }

    public function deleteBranch(int $id)
    {
        $trackings = Tracking::where(['branch_id' => $id]);
        Tracking::destroy($trackings->select('id')->get());
        Branch::destroy([$id]);
    }

    private function throwIfInvalidUpdate(array $attributesToUpdate, string $objectName)
    {
        $immutableProperties = ['name', 'experiment_id'];
        foreach($immutableProperties as $immutableProperty) {
            if (isset($attributesToUpdate[$immutableProperty])) {
                throw new \InvalidArgumentException('"' .$immutableProperty . '" is not an editable value of a(n) ' . $objectName);
            }
        }
    }

    private function convertArrayParamsToString(array $attributesToUpdate)
    {
        $attributesToCheck = ['userid_list', 'allow_filter', 'block_filter'];
        foreach($attributesToCheck as $attributeToCheck) {
            if (isset($attributesToUpdate[$attributeToCheck]) && is_array($attributesToUpdate[$attributeToCheck])) {
                $arrayValues = $attributesToUpdate[$attributeToCheck];
                $stringValue = implode(',', $arrayValues);
                $attributesToUpdate[$attributeToCheck] = $stringValue;
            }
        }
        return $attributesToUpdate;
    }



}
