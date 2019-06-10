<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
    public function __contruct()
    {
        $password = self::input('password');
        $password_confirm = self::input('password_confirmation');

        if (empty($password) && empty($password_confirm)) {
            $this->request->remove('password');
            $this->request->remove('password_confirmation');
        }

        parent::__construct();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return auth()->check();
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
            'username'              => 'required|unique:users,username,'. (optional($this->route('user'))->id ?: ''),
            'email'                 => 'email|unique:users,email,'. (optional($this->route('user'))->id ?: ''),
            'password'              => 'sometimes|nullable|min:6|confirmed',
            'password_confirmation' => 'sometimes|nullable|same:password',
        ];
    }
}
