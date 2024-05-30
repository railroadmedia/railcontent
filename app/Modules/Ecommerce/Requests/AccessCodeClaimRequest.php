<?php

namespace App\Modules\Ecommerce\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AccessCodeClaimRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function getValidatorInstance(): Validator
    {
        // necessary to handle ajax requests
        if (!empty($this->getContent())) {
            $jsonData = json_decode($this->getContent(), true);
            $this->merge($jsonData ?? []);
        }

        if (empty($this->get('access_code'))) {
            $code =
                $this->get('code1')
                . $this->get('code2')
                . $this->get('code3')
                . $this->get('code4')
                . $this->get('code5')
                . $this->get('code6');

            $code = strtoupper(preg_replace("/[^A-Za-z0-9]/", '', $code));

            $this->merge([
                'access_code' => $code
            ]);
        }

        return parent::getValidatorInstance();
    }

    public function rules(): array
    {
        $rules = [
            'access_code' => [
                'required',
                'max:24',
                'exists:' . config('ecommerce.database_connection_name') . '.ecommerce_access_codes,code,is_claimed,0'
            ],
            'context' => ['string', 'nullable'],
        ];

        if (!auth()->check()) {
            $rules['email'] = [
                'required',
                'email:strict,dns',
                'max:32',
                'not_regex:/[ÄäÜüÖö]/',
                'unique:' .
                    config('ecommerce.database_info_for_unique_user_email_validation.database_connection_name') .
                    '.' .
                    config('ecommerce.database_info_for_unique_user_email_validation.table') .
                    ',' .
                    config('ecommerce.database_info_for_unique_user_email_validation.email_column'),
            ];
            $rules['password'] = ['required', config('ecommerce.password_creation_rules', 'confirmed|min:8|max:128')];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'access_code.max' => 'The access code is invalid',
            'access_code.exists' => 'The access code is invalid',
            'user_email.required_if' => 'The existing user email field is required',
            'user_password.required_if' => 'The existing user password field is required',
            'email.required_if' => 'The email field is required',
            'password.required_if' => 'The password field is required',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        if ($this->wantsJson()) {
            throw new HttpResponseException(response()->json([
                'errors' => $validator->errors(),
                'status' => true
            ], 422));
        }

        parent::failedValidation($validator);
    }
}
