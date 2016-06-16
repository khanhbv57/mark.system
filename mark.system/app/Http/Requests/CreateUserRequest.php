<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'min:6'
        ];
    }

    public function messages(){

        return[
            'name.required' => 'Không được để trống Họ Tên',
            'email.required' => 'Không được để trống Email',
            'password.required' => 'Không được để trống Password',
            'min' => 'Password phải có ít nhất :min kí tự',
            'password.confirmed' => 'Nhập lại mật khẩu sai',

        ];
    }
}
