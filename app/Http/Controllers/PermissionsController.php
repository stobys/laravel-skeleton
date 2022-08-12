<?php

namespace App\Http\Controllers;

use App\Models\NullModel;

use App\Models\Permission;
use App\Models\PermissionGroup;

use App\Actions\Users\PermissionDelete;
use App\Actions\Users\PermissionUpdate;
use App\Http\Requests\PermissionSaveRequest;
use App\Http\Requests\PermissionBulkDestroyRequest;
use App\Http\Requests\PermissionBulkRestoreRequest;

class PermissionsController extends Controller
{
    public function index()
    {
        self::checkAccess(__FUNCTION__);

        return view('permissions.index', [
            'models'    => Permission::with('group') -> filter() -> order()
                            -> paginate( session()->get('itemsPerIndexPage', $this -> paginate_size) ),
            'groups'     => PermissionGroup::forSelect(),
            'sortOptions'   => Permission::getSortOptions(),
        ]);
    }

    public function trash()
    {
        self::checkAccess(__FUNCTION__);

        return view('permissions.index', [
            'models'   => Permission::with('group') -> filter() -> order()
                            ->onlyTrashed()
                            ->paginate( session()->get('itemsPerIndexPage', $this -> paginate_size) ),
            'sortOptions'   => Permission::getSortOptions(),
        ]);
    }

    public function create()
    {
        self::checkAccess(__FUNCTION__);

        return view('layouts.module-create', [
            'model'     => new NullModel,
            'groups'    => PermissionGroup::all()->pluck('name', 'id'),
            'action'    => 'create',
        ]);
    }

    public function store(PermissionSaveRequest $request)
    {
        self::checkAccess(__FUNCTION__);

        Permission::create( $request->all() );
        Permission::forgetForSelect();

        return redirect()->route( controllerRoute('index') );
    }

    public function edit(Permission $permission)
    {
        self::checkAccess(__FUNCTION__);

        return view('layouts.module-edit', [
            'model'    => $permission,
            'groups'   => PermissionGroup::all()->pluck('name', 'id'),
            'action'   => 'edit',
        ]);
    }

    public function update(PermissionSaveRequest $request, Permission $permission)
    {
        self::checkAccess(__FUNCTION__);

        PermissionUpdate::run($permission, $request);

        return redirect()->route( controllerRoute('show'), [$permission->id] );
    }

    public function show(Permission $permission)
    {
        self::checkAccess(__FUNCTION__);

        return view('layouts.module-show', [
            'model'         => $permission,
            'groups'   => PermissionGroup::all()->pluck('name', 'id'),
            'action'        => 'show',
        ]);
    }

    public function destroy(Permission $permission)
    {
        self::checkAccess(__FUNCTION__);

        PermissionDelete::run($permission);

        return redirect() -> back();
    }

    public function bulkDestroy(PermissionBulkDestroyRequest $request)
    {
        self::checkAccess(__FUNCTION__);

        Permission::whereIn('id', request('bulkIds')) -> delete();
        Permission::forgetForSelect();

        return redirect()->back();
    }

    public function restore($id)
    {
        self::checkAccess(__FUNCTION__);

        Permission::onlyTrashed()->findOrFail($id)->restore();
        Permission::forgetForSelect();

        return redirect()->back(); // back();
    }

    public function bulkRestore(PermissionBulkRestoreRequest $request)
    {
        self::checkAccess(__FUNCTION__);

        Permission::whereIn('id', request('bulkIds')) -> restore();
        Permission::forgetForSelect();
        
        return redirect()->back(); // back();
        // return response(null, Response::HTTP_NO_CONTENT);
    }

}
