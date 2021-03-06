<?php

get_route_middleware();

Route::get('/home', Loid\Frame\Controllers\IndexController::class.'@index')->middleware('web')->name('manage');

Route::get('/', Loid\Frame\Controllers\LoginController::class.'@showLoginForm')->middleware('web');


Route::group(['prefix'=>'manage', 'middleware'=>['web', 'auth', \Loid\Frame\Middleware\MoudleInit::class]], function () {
    
    Route::get('/', Loid\Frame\Controllers\IndexController::class.'@index')->name('manage');
    
    Route::get('panel.html', Loid\Frame\Controllers\IndexController::class.'@panel')->name('manage.panel');
    
    /*登出*/
    Route::post('logout.html', Loid\Frame\Controllers\IndexController::class.'@logout')->name('manage.logout');
    
    /*清除缓存*/
    Route::post('clear.html', Loid\Frame\Controllers\IndexController::class.'@clear')->name('manage.clear');
    
    /*上传文件*/
    Route::post('upload.html', Loid\Frame\Controllers\IndexController::class.'@_upload')->name('manage.upload');
});