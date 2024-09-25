<?php

namespace App\Modules\CustomerIO\Models;

use App\Rules\ReCaptcha;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerIoFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $forms = config('customer-io.forms.' . config('customer-io.forms.brand'), []);
        $allConfiguredFormNames = array_keys($forms);

        $customAttributeRules = $forms[$this->input('form_name')]['custom_attributes'] ?? [];
        $customEventAttributes = $forms[$this->input('form_name')]['custom_event_attributes'] ?? [];

        $rules = array_merge([
            'email' => 'required|email',
            'form_name' => 'required|in:' . implode(',', $allConfiguredFormNames),
            'g-recaptcha-response' => [Rule::requiredIf(function () {
                return $this->route()->getName() === 'customer-io.submit-email-form-rc';
            }), new ReCaptcha()]
        ], $customAttributeRules, $customEventAttributes);

        return $rules;
    }

    public function attributes()
    {
        $forms = config('customer-io.forms.' . config('customer-io.forms.brand'), []);
        return $forms[$this->input('form_name')]['attributes'] ?? [];
    }
}
