<?php

namespace App\Http\Requests;

use App\Permission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class PermissionBulkRestoreRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('permissions.restore');
    }

    public function rules()
    {
        return [
            'bulkIds'   => 'required|array',
            'bulkIds.*' => 'exists:permissions,id',
        ];
    }
}
