<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Requests\SessionBulkDestroyRequest;

class SessionsController extends Controller
{
    public function index()
    {
        abort_unless(auth()->check() && auth()->user()->isSuperAdmin(), 404);

        return view('sessions.index', [
            'sessions'    => Session::filter()->order()->get(),
            'sortOptions' => Session::getSortOptions(),
        ]);
    }

    public function destroy(Session $session, Request $request)
    {
        // self::checkAccess(__FUNCTION__);

        $session->delete();

        return redirect()->route('sessions.index');
    }

    public function bulkDestroy(SessionBulkDestroyRequest $request)
    {
        Session::whereIn('id', request('bulkIds'))->delete();

        return redirect()->route('sessions.index');
    }
}
