<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {

    // 授权组
    $api->group(['middleware' => 'jwt.auth', 'providers' => 'jwt'], function ($api) {
        // $api->post('register', 'AuthenticateController@register')->name('auth.register');
        $api->get('users', 'UserController@show');
    });

    // $api->get('users', 'UserController@show');
});