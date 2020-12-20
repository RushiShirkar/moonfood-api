<?php

namespace fashiostreet\product;

use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('fashiostreet\product\ProductController');
        $this->app->make('fashiostreet\product\CityController');
        $this->app->make('fashiostreet\product\ShopController');
        $this->app->make('fashiostreet\product\FilterController');
        $this->app->make('fashiostreet\product\ViewController');
        $this->app->make('fashiostreet\product\CartController');

        $this->loadViewsFrom(__DIR__.'/views', 'fashiostreet_client');
        \App::bind('FS_Auth',function (){
            return new \fashiostreet\product\Auth\User();
        });
        \App::bind('FS_Response',function (){
            return new \fashiostreet\product\Response\ResponseRepository;
        });
        \App::bind('Validate',function (){
            return new \knicklab\php_formvalidation\BasicValidation;
        });
    }
}
