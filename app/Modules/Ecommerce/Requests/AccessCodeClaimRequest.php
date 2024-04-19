<?php

namespace App\Modules\Ecommerce\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AccessCodeClaimRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function getValidatorInstance(): Validator
    {
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
        return [
            'access_code' => 'required|max:24|exists:' .
                config('ecommerce.database_connection_name') .
                '.' .
                'ecommerce_access_codes' .
                ',code,is_claimed,0',
            'credentials_type' => 'required|in:new,existing',
            'user_email' => 'required_if:credentials_type,existing|email:strict,dns|not_regex:/[ÄäÜüÖö]|max:255|exists:' .
                config('ecommerce.database_info_for_unique_user_email_validation.database_connection_name') .
                '.' .
                config('ecommerce.database_info_for_unique_user_email_validation.table') .
                ',' .
                config('ecommerce.database_info_for_unique_user_email_validation.email_column'),
            'user_password' => 'required_if:credentials_type,existing',
            'email' => 'required_if:credentials_type,new|email:strict,dns|not_regex:/[ÄäÜüÖö]|max:255|unique:' .
                config('ecommerce.database_info_for_unique_user_email_validation.database_connection_name') .
                '.' .
                config('ecommerce.database_info_for_unique_user_email_validation.table') .
                ',' .
                config('ecommerce.database_info_for_unique_user_email_validation.email_column'),
            'password' => 'required_if:credentials_type,new|' . config('ecommerce.password_creation_rules', 'confirmed|min:8|max:128'),
            'context' => 'string|nullable',
        ];
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
}
