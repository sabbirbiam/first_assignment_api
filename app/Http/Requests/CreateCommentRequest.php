<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
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
            'comments' => 'required|max:100',
            'story_id' => 'required',
        ];
    }

    public function messages(){
        return [
            'comments.required'=> '**Comments is required**',
            'comments.max'=> '**Minimum 100 digit **',

            'story_id.required'=> '**Story is required**',
            ];
    }
}
