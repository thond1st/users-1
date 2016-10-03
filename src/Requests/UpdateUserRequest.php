<?php

namespace Vitorbar\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateUserRequest extends FormRequest
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
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $id = $request->segment(2);

        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:pkg_users,id,'.$id,
            'role_id' => 'required|exists:pkg_users_roles,id',
            'phone_prefix' => 'required|min:2|max:2',
            'phone_number' => 'required|min:8|max:15',
        ];
    }
}
