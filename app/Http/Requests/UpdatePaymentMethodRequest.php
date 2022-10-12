<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Railroad\Ecommerce\Entities\PaymentMethod;
use Railroad\Location\Services\CountryListService;

class UpdatePaymentMethodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'method_type' => 'required|max:255|in:paypal,credit_card',
            'card_token' => 'required_if:method_type,credit_card',
            'token' => 'required_if:method_type,paypal',
            'gateway' => 'required',
            'billing_country' => 'string|required|in:' . implode(',', CountryListService::all()),
        ];

        if ($this->get('method_type') == PaymentMethod::TYPE_PAYPAL && empty($this->get('token'))) {
            unset($rules['token']);
        }

        if (strtolower($this->get('billing_country')) == 'canada') {
            $rules += [
                'billing_region' => 'string|required|regex:/^[0-9a-zA-Z-_ ]+$/',
            ];
        }

        return $rules;
    }

    /**
     * @return Validator
     */
    public function getValidatorInstance()
    {
        // if this request is from a paypal redirect we must merge in the old input
        if (!empty($this->get('token'))) {

            $orderFormInput = session()->get(brand() . '-payment-method-update-input', []);
            unset($orderFormInput['token']);
            session()->forget(brand() . '-payment-method-update-input');
            $this->merge($orderFormInput);
        }

        return parent::getValidatorInstance();
    }

    /** Get the failed validation response in json format
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = [];

        foreach ($validator->errors()
                     ->getMessages() as $key => $value) {
            $errors[] = [
                "title" => 'Validation failed.',
                "source" => $key,
                "detail" => $value[0],
            ];
        }

        throw new HttpResponseException(
            response()->json(['errors' => $errors], 422)
        );
    }
}
