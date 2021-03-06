<?php

namespace Vitorbar\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:pkg_users',
            'role_id' => 'required|exists:pkg_users_roles,id',
            'phone_prefix' => 'required|min:2|max:2',
            'phone_number' => 'required|min:8|max:15',
            'password' => 'required|min:8|max:15'
        ];
    }
}
