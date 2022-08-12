<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\NullModel;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Actions\Users\RoleDelete;

use App\Actions\Users\RoleUpdate;
use App\Actions\Users\RoleRestore;
use App\Http\Requests\RoleSaveRequest;
use App\Http\Requests\RoleBulkDestroyRequest;
use App\Http\Requests\RoleBulkRestoreRequest;
use App\Http\Requests\RoleMassDestroyRequest;
use App\Http\Requests\RoleMassRestoreRequest;
use Symfony\Component\HttpFoundation\Response;


class RolesController extends Controller
{
    public function index()
    {

        // dd( cache()->get('spatie.permission.cache') );
        self::checkAccess(__FUNCTION__);

        return view('roles.index', [
            'models'        => Role::with('permissions')->filter()->order()->paginate( session()->get('itemsPerIndexPage', $this -> paginate_size) ),
            'sortOptions'   => Role::getSortOptions(),
        ]);
    }

    public function trash()
    {
        self::checkAccess(__FUNCTION__);

        return view('roles.index', [
            'models'        => Role::with('permissions')->onlyTrashed()->filter()->order()->paginate( session()->get('itemsPerIndexPage', $this -> paginate_size) ),
            'sortOptions'   => Role::getSortOptions(),
        ]);
    }

    public function create()
    {
        self::checkAccess(__FUNCTION__);

        return view('layouts.module-create', [
            'model'         => new NullModel,
            'permissions'   => Permission::forSelectWithTranslations('name', 'id', 'permissions.descriptions.'),
            'action'        => 'create',
        ]);
    }

    public function store(RoleSaveRequest $request)
    {
        self::checkAccess(__FUNCTION__);

        $role = Role::create( $request->all() );
        $role -> permissions() -> sync( $request->input('permissions', []) );

        // -- forget cache for select
        Role::forgetForSelect();

        return redirect()->route( controllerRoute('index') );
    }

    public function edit(Role $role)
    {
        self::checkAccess(__FUNCTION__);

        return view('layouts.module-edit', [
            'model'         => $role -> load('permissions'),
            'permissions'   => Permission::forSelectWithTranslations('name', 'id', 'permissions.descriptions.'),
            'action'        => 'edit',
        ]);
    }

    public function update(RoleSaveRequest $request, Role $role)
    {
        self::checkAccess(__FUNCTION__);

        RoleUpdate::run($role);

        return redirect()->route( controllerRoute('show'), [$role->id] );
    }

    public function show(Role $role)
    {
        self::checkAccess(__FUNCTION__);

        return view('layouts.module-show', [
            'model'         => $role -> load('permissions'),
            'permissions'   => Permission::all()->pluck('name', 'id'),
            'action'        => 'show',
        ]);
    }

    public function destroy(Role $role)
    {
        self::checkAccess(__FUNCTION__);

        RoleDelete::run($role);

        return redirect() -> back() -> with('message', 'deleted successfully');
    }

    public function bulkDestroy(RoleBulkDestroyRequest $request)
    {
        self::checkAccess(__FUNCTION__);

        Role::whereIn('id', request('bulkIds')) -> delete();

        // -- forget cache for select
        Role::forgetForSelect();

        return redirect()->back(); // back();
        // return response(null, Response::HTTP_NO_CONTENT);
    }

    public function restore(Role $role)
    {
        self::checkAccess(__FUNCTION__);

        RoleRestore::run($role);

        return redirect()->back(); // back();
    }

    public function bulkRestore(RoleBulkRestoreRequest $request)
    {
        self::checkAccess(__FUNCTION__);

        Role::whereIn('id', request('bulkIds')) -> restore();

        // -- forget cache for select
        Role::forgetForSelect();

        return redirect()->back(); // back();
        // return response(null, Response::HTTP_NO_CONTENT);
    }
}
