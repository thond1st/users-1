<?php

Route::group([
    'middleware' => 'web',
    'namespace'  => 'Vitorbar\Users\Controllers',
], function() {
    Route::resource('role', 'RoleController');
    Route::resource('user', 'UserController');
});
