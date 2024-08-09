<?php

namespace App\Http\Controllers\Platform;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Railroad\Mailora\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class MailController extends Controller
{
    /**
     * @var MailService
     */
    private $mailService;
    //    /**
    //     * @var UserPointsService
    //     */
    //    private $userPointsService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
        //        $this->userPointsService = $userPointsService;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function sendFromMember(Request $request): RedirectResponse
    {
        $input = $request->all();

        $request->validate([
            'instructor_focus' => 'required',
            'improvement' => 'required',
            'weakness' => 'required',
            'goal' => 'required'
        ]);

        if ($input['brand'] == 'drumeo') {
            $request->validate(['experience' => 'required']);
        } else {
            $request->validate(['youtube_url' => 'required']);
        }

        $result = $this->mailService->sendStudentFocusApplicationEmail($input);

        if ($result === false) {
            $errorMessage =
                "Error while trying to send. Please send your request directly to support, and we'll " .
                "ensure it gets to the correct person.";

            return redirect()
                ->back()
                ->with('error-message', $errorMessage);
        }


        $successMessage = "Email sent";
        if ($input['success-message']) {
            $successMessage = $input['success-message'];
        }

        //todo
        //        if ($input['type'] == 'student-focus-application' && !empty(current_user())) {
        //            $this->userPointsService->setPoints(
        //                current_user()->getId(),
        //                [
        //                    'submitted_on' => Carbon::now()
        //                        ->toDateTimeString(),
        //                ],
        //                'student_focus_application_submitted',
        //                config('xp_ranks.student_focus_application_submitted'),
        //                'Awarded for submitting a student focus application.'
        //            );
        //        }

        return redirect()
            ->back()
            ->with('success-message', $successMessage);
    }

}
