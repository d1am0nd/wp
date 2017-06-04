<?php

namespace App\Http\Requests\Videos;

use App\Http\Requests\Request;

class StoreVideosRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:40|unique:pages,title',
            'description' => 'required|min:15|max:120',
            'url' => 'unique:videos,url|youtube',
            'tag_id' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'tag_id.required' => 'The tags field is required',
            'url.youtube' => 'URL is not a valid youtube link'
        ];
    }
}
