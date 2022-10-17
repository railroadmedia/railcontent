<?php

namespace App\Modules\UserManagementSystem\Services;

use App\Modules\Brand\Enums\Brand;
use Exception;
use Modules\UserManagementSystem\Models\OnboardingAnswerHistory;

class OnboardingService
{

    public function getBrand(int $userId): ?string
    {
        $instrumentAnswer = OnboardingAnswerHistory::query()->select('onboarding_answer')->where(
            'user_id',
            '=',
            $userId
        )->where(
            'onboarding_question',
            '=',
            'instrument'
        )->orderByDesc('created_at')->first()?->onboarding_answer;

        if (!$instrumentAnswer) {
            return null;
        }

        switch ($instrumentAnswer) {
            case 'drums':
                return Brand::Drumeo->value;
            case 'piano':
                return Brand::Pianote->value;
            case 'singing':
                return Brand::Singeo->value;
            case 'guitar':
                return Brand::Guitareo->value;
        }
        throw new Exception("Unable to determine brand from instrument onboarding answer '$instrumentAnswer'");
    }
}
