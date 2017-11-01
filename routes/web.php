<?php


Route::group(['prefix'=>'manage', 'middleware'=>['web', 'auth', \Loid\Frame\Middleware\MoudleInit::class]], function () {

    
    Route::get('/', Loid\Frame\Controllers\IndexController::class.'@index')->name('manage');
    
    Route::get('panel.html', Loid\Frame\Controllers\IndexController::class.'@panel')->name('manage.panel');
    
    /*系统用户*/
    Route::get('user.html', Loid\Frame\Controllers\UserController::class.'@index')->name('manage.user');
    Route::get('user/list.html', Loid\Frame\Controllers\UserController::class.'@getjQGridList')->name('manage.list');
    Route::match(['get', 'post'], 'user/add.html', Loid\Frame\Controllers\UserController::class . '@add')->name('manage.user.add');
    Route::match(['get', 'post'], 'user/modify.html', Loid\Frame\Controllers\UserController::class . '@modify')->name('manage.user.modify');
    
});