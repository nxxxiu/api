<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->get('firm','CheckController@firm');//展示
    $router->get('yes','CheckController@yes');//通过
    $router->get('no','CheckController@no');//驳回

    $router->resource('user',FirmController::class);
});
