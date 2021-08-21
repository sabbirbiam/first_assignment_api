<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|max:50',
            'email' => 'required|email',
            'type' => 'required|max:50',
            'username' => 'required|unique:registration,username|max:50|alpha',
            'password' => 'required|min:3|max:50',
            'cpassword' => 'required|same:password',
        ];
    }

    public function messages(){
        return [
            'name.required'=> '**Name is required**',
    
            'email.required'=> '**Email is required**',
            'email.email'=> '**Should be a Valid Email **',
    
            'username.required'=> '**User Name is required**',
            'username.unique'=> '**User Name should be unique**',
    
            'password.required'=> '**Password is required**',
            'password.min'=> '**Minimum 3 digit is required **',
    
            'cpassword.required'=> '**Confirm Password is required**',
            'cpassword.same'=> '**password dont match **',
           
            ];
    }
}
