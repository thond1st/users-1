<?php

Route::group([
    'prefix' => 'users',
    'middleware' => 'web',
    'namespace'  => 'Vitorbar\Users\Controllers',
], function() {
    Route::resource('role', 'RoleController');
    Route::resource('user', 'UserController');
    Route::get('/', function() {
        return redirect()->route('user.index');
    });
});
