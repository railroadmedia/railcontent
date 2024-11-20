<?php

namespace App\Modules\Content\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddItemToPlaylistRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'playlist_id' => 'required|array',
            'content_id' => 'required|integer|exists:railcontent_content,id',
            'playlist_id.*' => 'exists:railcontent_user_playlists,id',
            'import_all_assignments' => 'boolean',
            'import_full_soundslice_assignment' => 'boolean',
            'import_instrumentless_soundslice_assignment' => 'boolean',
        ];
    }
}
