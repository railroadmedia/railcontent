<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class ReCaptcha implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $response = Http::get("https://www.google.com/recaptcha/api/siteverify", [
            'secret' => config('recaptcha.secret'),
            'response' => $value
        ]);

        $json = $response->json();

        if (!$json["success"] || $json["score"] < 0.5) {
            $fail('Recaptcha validation failed. Please try again.');
        }
    }
}
