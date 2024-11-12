<?php

namespace App\Modules\RailTracker\Requests;

use App\Modules\Content\Models\Content;
use Illuminate\Foundation\Http\FormRequest;

class MediaSessionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content_id' => 'required|integer|exists:' . Content::class . ',id',
            'media_type_id' => 'required|integer',
            'media_length_seconds' => 'required|integer',
            'current_second' => 'required|numeric',
            'seconds_played' => 'required|numeric',
            'session_id' => 'required|uuid'
        ];
    }
}
