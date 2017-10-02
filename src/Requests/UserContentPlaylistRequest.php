<?php

namespace Railroad\Railcontent\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Railroad\Railcontent\Services\ConfigService;

class UserContentPlaylistRequest extends FormRequest
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
        return [
            'content_id' => 'required|numeric|exists:' . ConfigService::$tableContent . ',id',
            'playlist_id' => 'required|numeric|exists:' . ConfigService::$tablePlaylists . ',id'
        ];
    }
}