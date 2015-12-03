<?php

namespace PHPHub\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $controllerNamespace = 'PHPHub\Http\Controllers';

    protected $apiControllerNamespace = 'PHPHub\Http\ApiControllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function map(Router $router)
    {
        $this->configureAPIRoute();

        $router->group(['namespace' => $this->controllerNamespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }

    /**
     * 配置 API 路由.
     */
    public function configureAPIRoute()
    {
        $api = app('Dingo\Api\Routing\Router');
        $api->group([
            'version'   => env('API_PREFIX'),
            'namespace' => $this->apiControllerNamespace,
        ], function ($router) {
            require app_path('Http/api_routes.php');
        });
    }
}
