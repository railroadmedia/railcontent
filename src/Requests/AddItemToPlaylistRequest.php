<?php

namespace Railroad\Railcontent\Requests;

use Railroad\Railcontent\Services\ConfigService;

class AddItemToPlaylistRequest extends FormRequest
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
            'playlist_id' => 'required|array',
            'content_id' => 'required|integer|exists:'.
                ConfigService::$databaseConnectionName.
                '.'.
                ConfigService::$tableContent.
                ',id',
            'brand' => 'required',
            'import_all_assignments' => 'boolean',
            'import_full_soundslice_assignment' => 'boolean',
            'import_instrumentless_soundslice_assignment' => 'boolean',
        ];
    }

}