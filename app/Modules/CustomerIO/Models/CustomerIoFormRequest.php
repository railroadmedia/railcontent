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
        $forms = config('customer-io.forms.' . config('customer-io.brand'), []);
        $allConfiguredFormNames = array_keys($forms);

        $customAttributeRules = [];
        if (isset($forms[$this->input('form_name')])) {
            $customAttributeRules = $forms[$this->input('form_name')]['custom_attributes'];
        }

        $rules = array_merge([
            'email' => 'required|email',
            'form_name' => 'required|in:' . implode(',', $allConfiguredFormNames),
            'g-recaptcha-response' => [Rule::requiredIf(function () {
                return $this->route()->getName() === 'customer-io.submit-email-form-rc';
            }), new ReCaptcha()]
        ], $customAttributeRules);

        return $rules;
    }

    public function messages(): array
    {
        return [
            'email' => 'Email is required',
            'first_name' => 'First Name is required',
            'form_name' => 'Form name is required',
        ];
    }
}
