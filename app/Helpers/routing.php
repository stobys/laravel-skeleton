<?php

// -- for general purpose functions

function controller($name = null, $return = null)
{
    if (empty($name) && empty($return)) {
        return null;
    }

    $route = request()->route();
    if (empty($route)) {
        return null;
    }

    $names = Arr::wrap($name);
    $result = false;

    foreach ($names as $name) {
        $actionName = strtolower($route -> getActionName());
        if ( ! Str::contains($actionName, '@') ) {
            $actionName = 'closure@closure';
        }

        list($controller, $action) = explode('@', $actionName);
        $controller = str_replace('controller', '', basename($controller));

        $name = strtolower($name);

        if (strpos($name, '@') !== false) {
            list($ifc, $ifa) = explode('@', $name);

            $result = $result || ($ifc == $controller) && ($ifa == $action);
        } else {
            $result = $result || ($name == $controller);
        }
    }

    if ($result && !is_null($return)) {
        return $return;
    }

    return $result;
}

function controllerName()
{
    $controller = str_replace([
            '\app\http\controllers\\',
            'app\http\controllers\\',
        ], '', strtolower(Route::currentRouteAction()));

    $controller = str_replace(['\\', 'controller'], ['.', ''], $controller);
    $controller = explode('@', $controller);

    return $controller[0] ?? null;

    // $controller2 = substr(strtolower(strrchr(Route::currentRouteAction(), '\\')), 1);

    // dd( $controller, $controller2 );

    // preg_match('/(.*?)controller/', $controller, $match);

    // return isset($match[1]) ? $match[1] : null;
}

function controllerRoute($action = 'index', $prefix = null, $separator = '.', $default = 'home')
{
    $base = ($prefix ? $prefix . $separator : '') . controllerName() . $separator;

    $actions = [
        'index'         => $base .'index',
        'access'        => $base .'index',
        'trash'         => $base .'trash',
        'create'        => $base .'create',
        'store'         => $base .'store',
        'show'          => $base .'show',
        'edit'          => $base .'edit',
        'update'        => $base .'update',
        'update-inline' => $base .'update-inline',
        'destroy'       => $base .'destroy',
        'delete'        => $base .'delete',
        'restore'       => $base .'restore',
        'bulkDestroy'   => $base .'bulkDestroy',
        'massDestroy'   => $base .'bulkDestroy',
        'bulkDelete'    => $base .'bulkDestroy',
        'massDelete'    => $base .'bulkDestroy',
        'bulkRestore'   => $base .'bulkRestore',
        'massRestore'   => $base .'bulkRestore',
    ];

    return $actions[$action] ?? $default;
}

function langField($field, $helper = false)
{
    $field = $helper ? $field .'_helper' : $field;

    return trans(controllerName() .'.fields.'. $field);
}

function langTitleSingular()
{
    return trans(controllerName() .'.title_singular');
}

function langTitlePlural()
{
    return trans(controllerName() .'.title_plural');
}

function langActionTitle($action)
{
    return trans(controllerName() .'.'. $action .'-title');
}

if (! function_exists('routes_path')) {
    function routes_path($path = '')
    {
        return ROUTES_PATH .($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('routeControllerAction')) {
    function routeControllerAction($action = 'index')
    {
        $route = request()->route();

        if (is_null($route)) {
            return url('/');
        }

        $routeName = $route->getAction();
        $routeName = explode('-', $routeName['as']);

        if (count($routeName) > 1) {
            array_pop($routeName);
            array_push($routeName, $action);
        }

        return route(implode('-', $routeName));
    }
}

function resourceRouteNames($name, $prefix = null, $separator = '.')
{
    $parts = [$prefix, $name, ''];
    if ( empty($prefix) )
    {
        array_shift($parts);
    }

    $prefix = implode($separator, $parts);

    return [
        'index'     => $prefix .'index',
        'create'    => $prefix .'create',
        'store'     => $prefix .'store',
        'show'      => $prefix .'show',
        'edit'      => $prefix .'edit',
        'update'    => $prefix .'update',
        'destroy'   => $prefix .'destroy',
        // 'bulkDestroy'   => $prefix .'bulkDestroy',
        // 'delete'    => $prefix .'delete',
        // 'bulkDelete'    => $prefix .'bulkDelete',
    ];
}
