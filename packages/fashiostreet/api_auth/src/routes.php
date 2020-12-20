<?php
Route::group(['middleware' => 'checkAuthIn'],function () {
    Route::prefix('api/auth')->group(function () {

        Route::get('login', 'fashiostreet\api_auth\Controllers\LoginController@loginview');

        Route::post(
            'login',
            'fashiostreet\api_auth\Controllers\LoginController@login'
        );

        Route::post(
            'login1',
            'fashiostreet\api_auth\Controllers\LoginController@login1'
        );

        Route::get(
            'getToken/{mobile}',
            'fashiostreet\api_auth\Controllers\LoginController@getToken'
        );

        Route::post(
            'sendOtp',
            'fashiostreet\api_auth\Controllers\LoginController@sendOtp'
        );

        Route::post(
            'checkOtp',
            'fashiostreet\api_auth\Controllers\LoginController@checkOtp'
        );

        Route::get('register', 'fashiostreet\api_auth\Controllers\RegisterController@registerview');

        Route::post(
            'register',
            'fashiostreet\api_auth\Controllers\RegisterController@Register'
        );
        Route::post('completeRegister_ResendOTP','fashiostreet\api_auth\Controllers\RegisterController@resendOTP'); 
        Route::get('completeRegister', 'fashiostreet\api_auth\Controllers\RegisterController@completeregister');

        Route::post(
            'completeRegister',
            'fashiostreet\api_auth\Controllers\RegisterController@CompleteRegistration'
        );

        Route::get('forgetpassword', 'fashiostreet\api_auth\Controllers\ForgetPasswordController@forgetview');

        Route::post(
            'forgetpassword',
            'fashiostreet\api_auth\Controllers\ForgetPasswordController@forgetpassword'
        );
        Route::post('completeForgetpassword_resendOTP','fashiostreet\api_auth\Controllers\ForgetPasswordController@resendOTP');
        Route::get('completeForgetpassword', 'fashiostreet\api_auth\Controllers\ForgetPasswordController@completeforgetview');
        Route::post(
            'completeForgetpassword',
            'fashiostreet\api_auth\Controllers\ForgetPasswordController@CompletedForgetPassword'
        );
        Route::post(
            'completeForgetpassword1',
            'fashiostreet\api_auth\Controllers\ForgetPasswordController@CompletedForgetPassword1'
        );
    });
});
