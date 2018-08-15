<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

//前台信息
Route::get('/', ['middleware' => 'web', function () {
    return redirect('admin');
}]);

// Route::get('internet', ['uses'=>'AdminUserController@getAllUsers','as'=>'admin.adminuser.getAllUsers']);

// Route::get('datatalk', ['middleware' => 'web', function () {
//     $title = '数据慧说话-沃天科技';
//     return view('datatalk', compact('title'));
// }]);

// Route::get('ecology', ['middleware' => 'web', function () {
//     $title = '沃天生态链-沃天科技';
//     return view('ecology', compact('title'));
// }]);

// Route::get('about', ['middleware' => 'web', function () {
//     $title = '关于我们-沃天科技';
//     return view('about', compact('title'));
// }]);


//上传图片的路由
Route::post('base/upload_file', ['uses'=>'Common\FileController@uploadFile','as'=>'common.file.uploadFile']);
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
 */
Route::group(['middleware' => ['web']], function () {

    Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
        require app_path('Http/Routes/user.php');
    });

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        require app_path('Http/Routes/admin.php');
    });
});

/**
 * api 路由
 *
 */
require app_path('Http/Routes/api.php');

/**
 * 测试路由
 * 这个东西只在本地测试开启
 */
require app_path('Http/Routes/test.php');



