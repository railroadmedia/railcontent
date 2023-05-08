<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class ReCaptcha implements Rule
{
    public function __construct()
    {
    }

    public function passes($attribute, $value)
    {
        $response = Http::get("https://www.google.com/recaptcha/api/siteverify", [
            'secret' => config('recaptcha.secret'),
            'response' => $value
        ]);

        $json = $response->json();

        return $json["success"] && $json["score"] > 0.5;
    }

    public function message()
    {
        return 'Google recaptcha verification failed.';
    }
}
