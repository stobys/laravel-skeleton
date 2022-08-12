<?php

namespace App\Http\Requests;

use App\Rules\NotCoreUsername;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UserSaveRequest extends FormRequest
{
    public function authorize()
    {
        switch( $this -> getMethod() )
        {
            // -- store action
            case 'PUT':
                return Gate::allows('users.create');
            break;

            // -- update action
            case 'PATCH':
                return Gate::allows('users.edit');
            break;
        }

        return false;
    }

    public function rules()
    {
        $rules = [
            'username'     => [
                new NotCoreUsername,
                'unique:users,username',
                'required',
            ],
            'personal_no'     => [
                'unique:users,personal_no',
                'nullable',
                'integer',
            ],
            'password' => [
                // 'required',
                // 'sometimes'
            ],
            'email'         => [
                'nullable',
                'email',
            ],
            'roles'    => [
                'array',
            ],
            'roles.*'  => [
                'integer',
            ],
        ];

        switch( $this -> getMethod() )
        {
            // -- store action
            case 'PUT':
                // -- nothing to change, default rules for store
            break;

            // -- update action
            case 'PATCH':
                $rules['username'][1] = 'unique:users,username,'. request()->route('user')->id;
                $rules['personal_no'][0] = 'unique:users,personal_no,' . request()->route('user')->id;
            break;
        }

        return $rules;
    }
}
