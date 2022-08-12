<?php

namespace App\Http\Requests;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Permission;

use Gate;

class PermissionSaveRequest extends FormRequest
{
    public const VALIDATION_RULES = [
        'name' => [
            'unique:auth_permissions',
            'required',
        ],
    ];

    public function authorize()
    {
        switch( $this -> getMethod() )
        {
            // -- store action
            case 'PUT':
                return Gate::allows('permissions.create');
            break;

            // -- update action
            case 'PATCH':
                return Gate::allows('permissions.edit');
            break;
        }

        return false;
    }

    public function rules()
    {
        $rules = self::VALIDATION_RULES;

        $table = (new Permission)->table;
        $model_id = $this->route('permission')->id ?? 0;

        switch( $this -> getMethod() )
        {
            // -- store action
            case 'PUT':
                // -- nothing to change, default rules for store
            break;

            // -- update action
            case 'PATCH':
                $rules['name'][0] = 'unique:'. $table .',name,'. $model_id;
            break;
        }

        return $rules;
    }
}
