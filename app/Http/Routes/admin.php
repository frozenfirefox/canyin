<?php

Route::group(['middleware' => ['auth:admin']], function ($router) {
    $router->get('/', ['uses' => 'AdminController@index','as' => 'admin.index']);

    $router->resource('index', 'IndexController');

    //目录
    $router->resource('menus', 'MenuController');

    //后台用户
    $router->get('adminuser/ajaxIndex',['uses'=>'AdminUserController@ajaxIndex','as'=>'admin.adminuser.ajaxIndex']);
    // $router->get('adminuser/getAllUsers',['uses'=>'AdminUserController@getAllUsers','as'=>'admin.adminuser.getAllUsers']);
    $router->get('adminuser/ajaxGetUsers',['uses'=>'AdminUserController@ajaxGetUsers','as'=>'admin.adminuser.ajaxGetUsers']);
    $router->resource('adminuser', 'AdminUserController');

    //权限管理
    $router->get('permission/ajaxIndex',['uses'=>'PermissionController@ajaxIndex','as'=>'admin.permission.ajaxIndex']);
    $router->resource('permission', 'PermissionController');

    //角色管理
    $router->get('role/ajaxIndex',['uses'=>'RoleController@ajaxIndex','as'=>'admin.role.ajaxIndex']);
    $router->resource('role', 'RoleController');
    //消息管理

    $router->get('message/ajaxIndex',['uses'=>'MessageController@ajaxIndex','as'=>'admin.message.ajaxIndex']);
    $router->get('message/info/id/{id}',['uses'=>'MessageController@messageInfo','as'=>'admin.message.messageInfo']);
    $router->resource('message', 'MessageController');

    //优惠券管理
    $router->get('ticket/ajaxIndex',['uses'=>'TicketController@ajaxIndex','as'=>'admin.ticket.ajaxIndex']);
    $router->get('ticket/info/id/{id}',['uses'=>'TicketController@ticketInfo','as'=>'admin.ticket.ticketInfo']);
    $router->resource('ticket', 'TicketController');

    //用户优惠卷
    $router->get('userticket/ajaxIndex',['uses'=>'UserticketController@ajaxIndex','as'=>'admin.userticket.ajaxIndex']);
    $router->get('userticket/info/id/{id}',['uses'=>'UserticketController@userticketInfo','as'=>'admin.userticket.userticketInfo']);
    $router->resource('userticket', 'UserticketController');

    //文件管理
    $router->delete('filedash/{id}', ['uses'=>'FileController@destroy','as'=>'admin.file.destroy']);//删除文件
    $router->get('file/ajaxIndex',['uses'=>'FileController@ajaxIndex','as'=>'admin.file.ajaxIndex']);
    $router->get('file/info/id/{id}',['uses'=>'FileController@fileInfo','as'=>'admin.file.fileInfo']);
    $router->resource('file', 'FileController');

    //商品图片集

    $router->get('gallery/ajaxIndex',['uses'=>'GalleryController@ajaxIndex','as'=>'admin.gallery.ajaxIndex']);
    $router->resource('gallery', 'GalleryController');

    //商户管理
    $router->delete('busdash/{id}', ['uses'=>'BusinessesController@destroy','as'=>'admin.businesses.destroy']);//删除文件
    $router->post('businesses/updateSingle',['uses'=>'BusinessesController@updateSingle','as'=>'admin.businesses.updateSingle']);
    $router->get('businesses/ajaxIndex',['uses'=>'BusinessesController@ajaxIndex','as'=>'admin.businesses.ajaxIndex']);
    $router->get('businesses/info/id/{id}',['uses'=>'BusinessesController@info','as'=>'admin.businesses.info']);
    $router->resource('businesses', 'BusinessesController');


    //员工
    $router->delete('staffdash/{id}', ['uses'=>'StaffController@destroy','as'=>'admin.staff.destroy']);//删除文件
    $router->get('staff/ajaxIndex',['uses'=>'StaffController@ajaxIndex','as'=>'admin.staff.ajaxIndex']);
    $router->get('staff/create/bid/{bid}', ['uses'=>'StaffController@create', 'as'=>'admin.staff.create']);
    $router->resource('staff', 'StaffController');

    //产品
    $router->delete('goodsdash/{id}', ['uses'=>'GoodsController@destroy','as'=>'admin.goods.destroy']);//删除文件
    $router->get('goods/ajaxIndex',['uses'=>'GoodsController@ajaxIndex','as'=>'admin.goods.ajaxIndex']);
    $router->get('goods/create/bid/{bid}', ['uses'=>'GoodsController@create', 'as'=>'admin.goods.create']);
    $router->get('goods/info/id/{id}',['uses'=>'GoodsController@info','as'=>'admin.goods.info']);
    $router->resource('goods', 'GoodsController');

    //商品属性
    $router->delete('gattrdash/{id}', ['uses'=>'GoodsAttrController@destroy','as'=>'admin.gattr.destroy']);//删除文件
    $router->get('goodsattr/ajaxIndex',['uses'=>'GoodsAttrController@ajaxIndex','as'=>'admin.goodsattr.ajaxIndex']);
    $router->get('goodsattr/create/bid/{bid}', ['uses'=>'GoodsAttrController@create', 'as'=>'admin.goodsattr.create']);
    $router->get('goodsattr/info/id/{id}',['uses'=>'GoodsAttrController@info','as'=>'admin.goodsattr.info']);
    $router->resource('goodsattr', 'GoodsAttrController');

    //价格
    $router->get('goodsprice/ajaxIndex',['uses'=>'GoodsPriceController@ajaxIndex','as'=>'admin.goodsprice.ajaxIndex']);
    $router->get('goodsprice/create/gid/{gid}',['uses'=>'GoodsPriceController@create', 'as'=>'admin.goodsprice.create']);
    $router->get('goodsprice/info/id/{id}',['uses'=>'GoodsPriceController@info','as'=>'admin.goodsprice.info']);
    $router->resource('goodsprice', 'GoodsPriceController');


    //分类
    $router->delete('classesdash/{id}', ['uses'=>'ClassesController@destroy','as'=>'admin.classes.destroy']);//删除文件
    $router->get('classes/ajaxIndex',['uses'=>'ClassesController@ajaxIndex','as'=>'admin.classes.ajaxIndex']);
    $router->get('classes/type/{type}',['uses'=>'ClassesController@index','as'=>'admin.classes.index']);
    $router->get('classes/create/bid/{bid}/type/{type}', ['uses'=>'ClassesController@create', 'as'=>'admin.classes.create']);
    $router->resource('classes', 'ClassesController');


    //订单
    $router->delete('orderdash/{id}', ['uses'=>'OrderController@destroy','as'=>'admin.order.destroy']);//删除文件
    $router->get('order/ajaxIndex',['uses'=>'OrderController@ajaxIndex','as'=>'admin.order.ajaxIndex']);
    $router->get('order/create/bid/{bid}', ['uses'=>'OrderController@create', 'as'=>'admin.order.create']);
    $router->get('order/info/id/{id}',['uses'=>'OrderController@info','as'=>'admin.order.info']);
    $router->resource('order', 'OrderController');


    //订购产品
    $router->get('ordergoods/ajaxIndex',['uses'=>'OrderGoodsController@ajaxIndex','as'=>'admin.ordergoods.ajaxIndex']);
    $router->get('ordergoods/create/oid/{oid}', ['uses'=>'OrderGoodsController@create', 'as'=>'admin.ordergoods.create']);
    $router->get('ordergoods/info/id/{id}',['uses'=>'OrderGoodsController@info','as'=>'admin.ordergoods.info']);
    $router->resource('ordergoods', 'OrderGoodsController');


    //  评论

    $router->get('comment/ajaxIndex',['uses'=>'CommentController@ajaxIndex','as'=>'admin.comment.ajaxIndex']);
    $router->post('comment/pinglun',['uses'=>'CommentController@pinglun','as'=>'admin.comment.pinglun']);
    $router->resource('comment', 'CommentController');
    $router->post('comment/ajaxSweet',['uses'=>'CommentController@ajaxSweet','as'=>'admin.comment.ajaxSweet']);
    $router->post('comment/ajaxPage',['uses'=>'CommentController@ajaxPage','as'=>'admin.comment.ajaxPage']);
    $router->post('comment/goodspinglun',['uses'=>'CommentController@goodspinglun','as'=>'admin.comment.goodspinglun']);
    //统计
    $router->resource('statistics', 'StatisticsController');

    //回收站
    $router->get('dash/bus',['uses'=>'DashController@bus','as'=>'admin.dash.bus']);
    $router->get('dash/staff',['uses'=>'DashController@staff','as'=>'admin.dash.staff']);
    $router->get('dash/classes',['uses'=>'DashController@classes','as'=>'admin.dash.classes']);
    $router->get('dash/gattr',['uses'=>'DashController@gattr','as'=>'admin.dash.gattr']);
    $router->get('dash/goods',['uses'=>'DashController@goods','as'=>'admin.dash.goods']);
    $router->get('dash/order',['uses'=>'DashController@order','as'=>'admin.dash.order']);
    $router->resource('dash', 'DashController');


    //商品分类
    $router->get('goodscategory/ajaxIndex',['uses'=>'GoodsCateController@ajaxIndex','as'=>'admin.goodscategory.ajaxIndex']);
    $router->get('goodscategory/create/bid/{bid}', ['uses'=>'GoodsCateController@create', 'as'=>'admin.goodscategory.create']);
    $router->get('goodscategory/info/id/{id}',['uses'=>'GoodsCateController@info','as'=>'admin.goodscategory.info']);
    $router->resource('goodscategory', 'GoodsCateController');


    //产品分类
    $router->get('productcategory/ajaxIndex',['uses'=>'ProductCateController@ajaxIndex','as'=>'admin.productcategory.ajaxIndex']);
    $router->get('productcategory/create/bid/{bid}', ['uses'=>'ProductCateController@create', 'as'=>'admin.productcategory.create']);
    $router->get('productcategory/info/id/{id}',['uses'=>'ProductCateController@info','as'=>'admin.productcategory.info']);
    $router->resource('productcategory','ProductCateController');


    //商户打赏设置表
    $router->get('tipssetting/ajaxIndex',['uses'=>'TipsSettingController@ajaxIndex','as'=>'admin.tipssetting.ajaxIndex']);
    $router->get('tipssetting/create/bid/{bid}', ['uses'=>'TipsSettingController@create', 'as'=>'admin.tipssetting.create']);
    $router->get('tipssetting/info/id/{id}',['uses'=>'TipsSettingController@info','as'=>'admin.tipssetting.info']);
    $router->resource('tipssetting', 'TipsSettingController');

    //打赏
    $router->get('tips/ajaxIndex',['uses'=>'TipsController@ajaxIndex','as'=>'admin.tips.ajaxIndex']);
    $router->get('tips/info/id/{id}',['uses'=>'TipsController@info','as'=>'admin.tips.info']);
    $router->resource('tips', 'TipsController');

    //打赏排行
    $router->get('tipsranking/ajaxIndex',['uses'=>'TipsRankingController@ajaxIndex','as'=>'admin.tipsranking.ajaxIndex']);
    $router->get('tipsranking/ajaxtips',['uses'=>'TipsRankingController@ajaxtips','as'=>'admin.tipsranking.ajaxtips']);
    $router->get('tipsranking/info/id/{id}',['uses'=>'TipsRankingController@info','as'=>'admin.tipsranking.info']);
    $router->resource('tipsranking', 'TipsRankingController');

    //模拟打赏
    $router->get('tipssim/ajaxIndex',['uses'=>'TipsSimController@ajaxIndex','as'=>'admin.tipssim.ajaxIndex']);
    $router->get('tipssim/create/bid/{bid}', ['uses'=>'TipsSimController@create', 'as'=>'admin.tipssim.create']);
    $router->get('tipssim/info/id/{id}',['uses'=>'TipsSimController@info','as'=>'admin.tipssim.info']);
    $router->resource('tipssim', 'TipsSimController');


    //地区表管理
    $router->get('region/getStreet',['uses'=>'RegionController@getStreet','as'=>'admin.region.getStreet']);
    $router->get('region/ajaxIndex',['uses'=>'RegionController@ajaxIndex','as'=>'admin.region.ajaxIndex']);
    $router->resource('region', 'RegionController');


});

Route::get('login', ['uses' => 'AuthController@index','as' => 'admin.auth.index']);
Route::post('login', ['uses' => 'AuthController@login','as' => 'admin.auth.login']);

Route::get('logout', ['uses' => 'AuthController@logout','as' => 'admin.auth.logout']);

Route::get('register', ['uses' => 'AuthController@getRegister','as' => 'admin.auth.register']);
Route::post('register', ['uses' => 'AuthController@postRegister','as' => 'admin.auth.register']);

Route::get('password/reset/{token?}', ['uses' => 'PasswordController@showResetForm','as' => 'admin.password.reset']);
Route::post('password/reset', ['uses' => 'PasswordController@reset','as' => 'admin.password.reset']);
Route::post('password/email', ['uses' => 'PasswordController@sendResetLinkEmail','as' => 'admin.password.email']);
