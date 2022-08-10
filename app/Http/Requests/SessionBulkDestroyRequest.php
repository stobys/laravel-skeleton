<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class SessionBulkDestroyRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() && auth()->user()->isSuperAdmin();
    }

    public function rules()
    {
        return [
            'bulkIds'   => 'required|array',
            // 'ids.*' => 'exists:sessions,id',
        ];
    }
}
