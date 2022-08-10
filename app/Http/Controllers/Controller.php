<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
    // -- default items per page
    public $paginate_size = 10;

    protected $ajax_result = [
        'errno'     => 0,
        'errmsg'    => '',
        'html'      => '',
        'growl'     => [
            'error'     => [],
            'warning'   => [],
            'success'   => [],
            'notice'    => []
        ]
    ];

    // -- constructor.
    public function __construct()
    {
        // $this->middleware('auth');
        app()->setLocale( session()->pull('locale', config('app.locale')) );
    }

    public static function getControllerBaseName()
    {
        $class = str_replace('app\http\controllers\\', '', strtolower(get_called_class()));
        return str_replace(['\\', 'controller'], ['.', ''], $class);
    }

    public static function checkAuth()
    {
        abort_unless(auth()->check(), Response::HTTP_UNAUTHORIZED, '401 Unauthorized');
    }

    public static function checkPermission($permission)
    {
        abort_unless(Gate::allows($permission), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public static function checkAccess($function = null, $controller = null)
    {
        self::checkAuth();

        $controller = $controller ?: self::getControllerBaseName();

        switch ($function) {
            case 'access':
            case 'index':
                $method = 'index';
            break;

            case 'create':
            case 'store':
                $method = 'create';
            break;

            case 'edit':
            case 'update':
                $method = 'edit';
            break;

            case 'delete':
            case 'bulk_delete':
            case 'bulkDelete':
            case 'massDelete':
            case 'destroy':
            case 'bulk_destroy':
            case 'bulkDestroy':
            case 'massDestroy':
                $method = 'delete';
            break;

            case 'restore':
            case 'bulk_restore':
            case 'bulkRestore':
            case 'massRestore':
                $method = 'restore';
            break;

            case 'trash':
                $method = 'trash';
            break;

            case 'show':
                $method = 'show';
            break;

            default:
                $method = 'non-exists';
            break;
        }

        abort_unless(Gate::allows( $controller .'.'. $method), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

}
