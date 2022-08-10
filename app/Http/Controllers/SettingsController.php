<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        abort_unless(auth()->check(), 403, 'Only Logged In Users');

        return view('settings.index', [
            'models'    => [],
        ]);
    }

    public function update(Request $request)
    {
        self::checkAccess(__FUNCTION__);

        return redirect()->back();
    }

}
