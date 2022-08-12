<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class RoleSaveRequest extends FormRequest
{
    public const VALIDATION_RULES = [
        'name'         => [
            'unique:auth_roles,name',
            'required',
        ],
        'permissions.*' => [
            'integer',
        ],
        'permissions'   => [
            'required',
            'array',
        ],
    ];

    public function authorize()
    {
        switch( $this -> getMethod() )
        {
            // -- store action
            case 'PUT':
                return Gate::allows('roles.create');
            break;

            // -- update action
            case 'PATCH':
                return Gate::allows('roles.edit');
            break;
        }

        return false;
    }

    public function rules()
    {
        $rules = self::VALIDATION_RULES;

        switch( $this -> getMethod() )
        {
            // -- store action
            case 'PUT':
                // -- nothing to change, default rules for store
            break;

            // -- update action
            case 'PATCH':
                $rules['name'][0] = 'unique:auth_roles,name,'. request()->route('role')->id;
            break;
        }

        return $rules;
    }
}
