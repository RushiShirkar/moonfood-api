<?php
namespace fashiostreet\api_auth;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class Api_authServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'api_auth');
        $this->app->make('fashiostreet\api_auth\Controllers\LoginController');
        $this->app->make('fashiostreet\api_auth\Controllers\RegisterController');
        $this->app->make('fashiostreet\api_auth\Controllers\ForgetPasswordController');
        $this->app->make('fashiostreet\api_auth\Controllers\AuthController');

        $this->app->make('fashiostreet\api_auth\UserController');

        //api_auth facade binding
        App::bind('api_auth',function (){
            return new \fashiostreet\api_auth\Controllers\AuthController;
        });


        App::bind('Verification',function (){
            return new \fashiostreet\api_auth\Verification\VerificationController;
        });

        App::bind('User',function (){
            return new \fashiostreet\api_auth\UserController;
        });

        App::bind('ResetPassword',function (){
            return new \fashiostreet\api_auth\ResetPassword\ResetPasswordController;
        });




    }
}
