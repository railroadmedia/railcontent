<?php

namespace App\Modules\UserManagementSystem\Services;

use App\Modules\Brand\Enums\Brand;
use Exception;
use Modules\UserManagementSystem\Events\OnboardingInstrumentUpdated;
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

        return $this->getBrandFromInstrument($instrumentAnswer);
    }

    public function saveInstrument(string $instrument): void
    {
        OnboardingAnswerHistory::create([
            'onboarding_question' => OnboardingAnswerHistory::QUESTION_INSTRUMENT,
            'onboarding_answer' => $instrument,
            'user_id' => user()->id
        ]);
        event(new OnboardingInstrumentUpdated(user()->id));
    }

    public function getBrandFromInstrument(string $instrument): string
    {
        switch ($instrument) {
            case 'drums':
                return Brand::Drumeo->value;
            case 'piano':
                return Brand::Pianote->value;
            case 'singing':
                return Brand::Singeo->value;
            case 'guitar':
                return Brand::Guitareo->value;
        }
        throw new Exception("Unable to determine brand from instrument onboarding answer '$instrument'");
    }


    public function getInstrumentFromBrand(string $brand): string
    {
        switch ($brand) {
            case Brand::Drumeo->value:
                return 'drums';
            case Brand::Pianote->value:
                return 'piano';
            case Brand::Singeo->value:
                return 'singing';
            case Brand::Guitareo->value:
                return 'guitar';
        }
        throw new Exception("Unable to determine instrument onboarding answer from brand '$brand'");
    }
}
