<?php

namespace Railroad\Railcontent\Requests;

class RequestSongRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'song_name' => 'required|string',
            'artist_name' => 'required|string',
        ];
    }
}