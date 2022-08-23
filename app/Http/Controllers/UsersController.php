<?php

namespace App\Http\Controllers;

use Gate;
use App\Models\Role;

use App\Models\User;
use App\Models\NullModel;
use Illuminate\Support\Arr;

use App\Actions\Users\UserDelete;

use App\Actions\Users\UserUpdate;
use App\Actions\Users\UserRestore;
use Illuminate\Filesystem\Filesystem;
use App\Http\Requests\UserSaveRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserBulkDestroyRequest;
use App\Http\Requests\UserBulkRestoreRequest;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function index()
    {
        self::checkAccess(__FUNCTION__);

        return view('users.index', [
            'models'        => User::with('roles')->withoutInternal()->filter()->order()->paginate(session()->get('itemsPerIndexPage', $this->paginate_size)),
            'selectedRoles' => session()->get('filters.users.roles', []),
            'roles'         => Role::forSelect(),

            'sortOptions'   => User::getSortOptions(),
        ]);
    }
    
    public function trash()
    {
        self::checkAccess(__FUNCTION__);

        return view('users.index', [
            'models'    => User::with('roles') -> withoutInternal() -> onlyTrashed()->filter()->order()->paginate( session()->get('itemsPerIndexPage', $this -> paginate_size) ),
            'selectedRoles' => session()->get('filters.users.roles', []),
            'roles'         => Role::forSelect(),

            'sortOptions'   => User::getSortOptions(),
        ]);
    }

    public function create()
    {
        self::checkAccess(__FUNCTION__);
        
        return view('layouts.module-create', [
            'model'         => new NullModel,
            'roles'         => Role::forSelect(),
            'action'        => 'create',
        ]);
    }

    public function store(UserSaveRequest $request)
    {
        self::checkAccess(__FUNCTION__);

        $user = User::create( $request->all() );
        // $user -> changePassword( $request->get('password') );

        $user -> roles() -> sync( $request->input('roles', []) );

        return redirect()->route( controllerRoute('index') );
    }

    public function edit(User $user)
    {
        self::checkAccess(__FUNCTION__);

        return view('layouts.module-edit', [
            'model'         => $user -> load('roles'),
            'roles'         => Role::forSelect(),
            'action'        => 'edit',
        ]);
    }

    public function update(UserSaveRequest $request, User $user)
    {
        self::checkAccess(__FUNCTION__);

        UserUpdate::run($user);

        return redirect()->route( controllerRoute('show'), [$user->id] );
    }

    public function show(User $user)
    {
        self::checkAccess(__FUNCTION__);

        return view('layouts.module-show', [
            'model'         => $user -> load('roles'),
            'roles'         => Role::remember(60 * 60)->get()->pluck('name', 'id'),
            'action'        => 'show',
        ]);
    }

    public function versions(User $user)
    {
        // self::checkAccess(__FUNCTION__);

        return view('users.versions', [
            'model'         => $user,
        ]);
    }

    public function destroy(User $user)
    {
        self::checkAccess(__FUNCTION__);

        UserDelete::run($user);
        
        return redirect() -> back();
    }

    public function bulkDestroy(UserBulkDestroyRequest $request)
    {
        self::checkAccess(__FUNCTION__);

        User::whereIn('id', request('bulkIds')) -> delete();

        if ($request->ajax()) {
            return response()->json($request->all(), 200);
        }
        else {
            return redirect() -> back();
        }

        // return response(null, Response::HTTP_NO_CONTENT);
    }

    public function restore(User $user)
    {
        self::checkAccess(__FUNCTION__);

        UserRestore::run($user);

        return redirect() -> back();
    }

    public function bulkRestore(UserBulkRestoreRequest $request)
    {
        self::checkAccess(__FUNCTION__);

        User::whereIn('id', request('bulkIds')) -> restore();

        return redirect()->back(); // back();
        // return response(null, Response::HTTP_NO_CONTENT);
    }

    public function profile()
    {
        abort_unless(auth()->check(), Response::HTTP_UNAUTHORIZED, '401 Unauthorized');

        return view('users.profile', [
            'user'         => auth()->user(),
            'action'        => 'profile',
        ]);
    }

    public function avatar(User $user)
    {
        $avatars = Storage::disk('avatars');
        $file = $user->avatar ?? 'default.jpg';

        // -- Check if the file exist
        if ($avatars->missing($file)) {
            $file = 'default.jpg';
        }

        $headers = [
            // 'Content-Disposition'   => 'inline; filename="' . basename($file) . '"',
            'Content-Disposition'   => 'inline',
            'Content-Length'        => $avatars->size($file),
            'Content-Type'          => $avatars->mimeType($file),
            'Pragma'                => 'public',
            'Etag'                  => md5($avatars->lastModified($file) . basename($file)),
        ];

        return response()->file($avatars->path($file), $headers);
    }

    public function badge(User $user)
    {
        return view('users.badge', compact('user'));
    }
}
