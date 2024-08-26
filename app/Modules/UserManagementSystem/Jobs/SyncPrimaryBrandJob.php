<?php

namespace App\Modules\UserManagementSystem\Jobs;

use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\UserManagementSystem\Services\OnboardingService;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Modules\UserManagementSystem\Models\User;

class SyncPrimaryBrandJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Batchable;

    private int $skip;
    private int $take;
    private CustomerIoService $customerIoService;
    private OnboardingService $onboardingService;

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    public function __construct(private readonly int $firstId, private readonly int $lastId)
    {
    }

    public function handle(): void
    {
        $this->customerIoService = app(CustomerIoService::class);
        $this->onboardingService = app(OnboardingService::class);

        $users = User::query()
            ->whereHas('onboardingAnswerHistory', function ($query) {
                $query->where('onboarding_question', 'instrument');
            })
            ->whereNull('primary_brand')
            ->whereBetween('id', [$this->firstId, $this->lastId])
            ->get();

        foreach ($users as $user) {
            $instrument = $user->onboardingAnswerHistory()
                                        ->where('onboarding_question', 'instrument')
                                        ->orderBy('created_at', 'desc')
                                        ->first()
                                        ->onboarding_answer;

            $user->primary_brand = $this->onboardingService->getBrandFromInstrument($instrument);
            $user->save();

            $this->customerIoService->createOrUpdateCustomerByEmail(
                $user->email,
                'musora',
                [
                    'primary_brand' => $user->primary_brand,
                ],
            );
        }
    }
}
