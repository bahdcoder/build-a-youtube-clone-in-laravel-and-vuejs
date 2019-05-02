<?php

namespace Laratube\Http\Requests\Videos;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->id === $this->video->channel->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required', 
            'description' => 'required'
        ];
    }
}
