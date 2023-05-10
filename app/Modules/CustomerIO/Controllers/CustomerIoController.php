<?php

namespace App\Modules\CustomerIO\Controllers;

use App\Rules\ReCaptcha;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Modules\CustomerIO\Services\CustomerIoService;
use Throwable;

class CustomerIoController extends Controller
{
    use ValidatesRequests;

    /**
     * @var CustomerIoService
     */
    private $customerIoService;

    public function __construct(CustomerIoService $customerIoService)
    {
        $this->customerIoService = $customerIoService;
    }

    public function submitEmailForm(Request $request)
    {
        $allConfiguredFormNames = array_keys(config('customer-io.forms.' . config('customer-io.brand'), []));

        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'form_name' => 'required|in:'.implode(',', $allConfiguredFormNames),
            ]
        );

        try {
            $customers = $this->customerIoService->processForm($request->get('email'), $request->get('form_name'), $request->all());
        } catch (Throwable $exception) {
            if (request()->expectsJson()) {
                return response()->json(
                    ['error' => $exception->getMessage()],
                    500
                );
            } elseif ($request->has('error_redirect')) {
                return redirect()
                    ->away($request->input('error_redirect'))
                    ->with(['error' => $exception->getMessage()]);
            } else {
                return redirect()
                    ->back()
                    ->with(['error' => $exception->getMessage()]);
            }
        }

        if (request()->expectsJson()) {
            return response('', 201); // Just a successfully created response
        }

        if ($request->has('success_redirect')) {
            $response = redirect()->away($request->input('success_redirect'));
        } else {
            $response = redirect()->back();
        }

        return $response->with(['success' => true]);
    }
    public function submitEmailFormRC(Request $request)
    {
        $allConfiguredFormNames = array_keys(config('customer-io.forms.' . config('customer-io.brand'), []));

        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'form_name' => 'required|in:'.implode(',', $allConfiguredFormNames),
                'g-recaptcha-response' => ['required', new ReCaptcha]
            ]
        );

        try {
            $customers = $this->customerIoService->processForm($request->get('email'), $request->get('form_name'), $request->all());
        } catch (Throwable $exception) {
            if (request()->expectsJson()) {
                return response()->json(
                    ['error' => $exception->getMessage()],
                    500
                );
            } elseif ($request->has('error_redirect')) {
                return redirect()
                    ->away($request->input('error_redirect'))
                    ->with(['error' => $exception->getMessage()]);
            } else {
                return redirect()
                    ->back()
                    ->with(['error' => $exception->getMessage()]);
            }
        }

        if (request()->expectsJson()) {
            return response('', 201); // Just a successfully created response
        }

        if ($request->has('success_redirect')) {
            $response = redirect()->away($request->input('success_redirect'));
        } else {
            $response = redirect()->back();
        }

        return $response->with(['success' => true]);
    }
}
