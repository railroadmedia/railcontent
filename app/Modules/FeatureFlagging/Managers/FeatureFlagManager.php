<?php

namespace App\Modules\FeatureFlagging\Managers;

use App\Modules\EventTracking\Avo\AvoHelper;
use App\Modules\FeatureFlagging\Contracts\FeatureFlagsContract;
use App\Modules\FeatureFlagging\Models\Branch;
use App\Modules\FeatureFlagging\Models\Experiment;
use App\Modules\FeatureFlagging\Models\Feature;
use App\Modules\FeatureFlagging\Models\Tracking;
use Avo;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class FeatureFlagManager implements FeatureFlagsContract
{
    public function __construct(protected Container $container, protected Dispatcher $dispatcher)
    {
    }

    public function allBranches(User $user) : array
    {
        $experiments = Experiment::all();
        $allowedBranches = [];
        foreach($experiments as $experiment) {
            $allowedBranches[$experiment->name] = $this->branch($experiment->name, $user);
        }
        return $allowedBranches;
    }


    public function allowedFeatures(User $user) : array
    {
        $features = Feature::all();
        $allowedFeatures = [];
        foreach($features as $feature) {
            if ($this->accessible($feature->name, $user)) {
                $allowedFeatures[] = $feature->name;
            }
        }
        return $allowedFeatures;
    }

    public function accessible(string $featureName, User $user=null): bool
    {
        $feature = $this->getFeature($featureName);
        if (!$feature) {
            return true;
        }
        if (!$user) {
            $user = auth()->user();
        }
        if ($user &&
            ($this->doesUserMatchFilter($feature->allow_filter, $user)
                || $this->doesUserMatchUserList($feature->userid_list, $user))) {
            return true;
        }
        return Carbon::parse($feature->active_at)->isPast();
    }

    public function branch(string $experimentName, User $user=null): string
    {
        $experiment = $this->getExperiment($experimentName);
        if (!$experiment) {
            throw new \InvalidArgumentException("Invalid Experiment Name: $experiment");
        }
        if (!$experiment->enabled) {
            return $experiment->default_value;
        }
        $branches = $experiment->branches;
        if (!$user) {
            $id = auth()->id();
            $user = User::whereId($id)->first();
        }
        $existingBranch = $this->getAssignedBranch($experiment, $user);
        // TODO handle anonymous users
        if ($existingBranch) {
            $branch = $existingBranch;
        } else {
            $branch = $this->selectBranch($branches, $user);
            if ($branch) {
                $this->trackBranchSelectedEvent($branch, $experiment, $user);
            }
        }
        return $branch?->content ?? $experiment->default_value ?? '';
    }

    /**
     * @param Collection<Branch> $branches
     * @param User|null $user
     * @return \Closure|mixed|null
     */
    private function selectBranch(Collection $branches, ?User $user)
    {
        if (!$branches) {
            return null;
        }
        $selectedBranch = null;
        if ($user) {
            foreach ($branches as $branch) {
                if ($this->doesUserMatchUserList($branch->userid_list, $user)
                    ||$this->doesUserMatchFilter($branch->allow_filter, $user)) {
                    $selectedBranch = $branch;
                    Log::debug('short circuit: ' . $branch->name);
                    break;
                }
            }
        }
        if (!$selectedBranch) {
            //weighted random of available branches
            $weights = [];
            // we don't have to worry about sorting weights for performance as the number of branches will always be small
            foreach ($branches as $branch) {
                if ($branch->weight > 0) {
                    $weights[$branch->name] = $branch->weight;
                }
            }
            $selected = $this->getRandomWeightedElement($weights);
            $selectedBranch = $branches->where('name', $selected)->first();
        }
        return $selectedBranch;
    }

    private function getRandomWeightedElement(array $weightedValues)
    {
        $sum = array_sum($weightedValues);
        if ($sum == 0) {
            return array_key_first($weightedValues);
        }
        $rand = mt_rand(1, (int) $sum);

        foreach ($weightedValues as $key => $value) {
            $rand -= $value;
            if ($rand <= 0) {
                return $key;
            }
        }
    }

    private function doesUserMatchUserList($userid_list, User $user) : bool
    {
        if ($userid_list) {
            $ids = explode(',', $userid_list);
            if (in_array(strval($user->id), $ids)) {
                return true;
            }
        }
        return false;
    }

    private function doesUserMatchFilter($allow_filter, User $user) : bool
    {
        if ($allow_filter) {
            $filters = explode(',', $allow_filter);
            foreach($filters as $filter) {
                if ($this->isUserAllowMatch($filter, $user)) {
                    return true;
                }
            }
        }
        return false;
    }

    private function isUserAllowMatch(string $filter, User $user) : bool
    {
        $isMatch = match(true) {
            $filter == 'admin' => $user->isAdmin(),
            $filter == 'musora' => $user->isMusoraAccount(),
            str_starts_with($filter, 'older_than') => $this->doesUserMatchOlderThanFilter($filter, $user),
            default => false
        };
        return $isMatch;
    }

    private function doesUserMatchOlderThanFilter(string $filter, User $user) : bool
    {
        $sections = explode('_', $filter);
        if (count($sections) != 4) {
            return false;
        }
        $unit = $sections[3];
        $count = intval($sections[2]);
        $createdTime = $user->created_at;
        $now = Carbon::now();
        $earliestAllowedTime = match(strtolower($unit)) {
            'day', 'days' => $now->subDays($count),
            'month', 'months' => $now->subMonths($count),
            'year', 'years' => $now->subYears($count),
            default => $now
        };
        return $createdTime <= $earliestAllowedTime;
    }

    /**
     * @param array|string $allow_filter
     * @return bool
     */
    public static function isValidFilter(array|string|null $allow_filter) {
        $validFilters = ['admin', 'musora'];
        $filters = is_array($allow_filter) ? $allow_filter : explode(',', $allow_filter);
        foreach($filters as $filter) {
            if (!in_array($filter, $validFilters)
                && !str_starts_with($filter, 'older_than')) {
                return false;
            }
        }
        return true;
    }

    private function trackBranchSelectedEvent(Branch $branch, Experiment $experiment, User $user=null, ?string $anonymous_user_id = null) : bool
    {

        Tracking::create([
            'user_id' => $user?->id,
            'experiment_id' => $experiment->id,
            'branch_id' => $branch->id,
            'anonymous_user_id' => $anonymous_user_id
        ]);
        try {
            Avo::experimentation_branch_assigned(
                AvoHelper::defaultEventProperties([
                    'experiment_id' => $experiment->id,
                    'experiment_name' => $experiment->name,
                    'branch_id' => $branch->id,
                    'branch_name' => $branch->name,
                    'anonymous_user_id' => $anonymous_user_id
                ],
                    $user
                )
            );
        } catch (Exception $e) {
            // Do not block user flow if event tracking fails
            Log::error($e->getMessage());
        }
        return true;
    }

    private function getAssignedBranch(Experiment $experiment, ?User $user) : Branch | null
    {
        if (!$user) {
            return null;
        }
        $tracking = Tracking::where(['user_id' => $user->id, 'experiment_id' => $experiment->id])->first();
        return $tracking?->branch ?? null;
    }

    private function getFeature($featureName) : Feature | null
    {
        return Feature::whereName($featureName)->first();
    }

    private function getExperiment($experiment) : Experiment | null
    {
        return Experiment::whereName($experiment)->first();
    }
}
