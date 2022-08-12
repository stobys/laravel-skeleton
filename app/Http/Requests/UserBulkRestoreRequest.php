<?php

namespace App\Http\Requests;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\User;
use Gate;

class UserBulkRestoreRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('users.restore');
    }

    public function rules()
    {
        return [
            'bulkIds'   => 'required|array',
            'bulkIds.*' => 'exists:users,id',
        ];
    }
}
