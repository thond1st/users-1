<?php

Route::group(['namespace'  => 'Vitorbar\Users'], function() {
    Route::resource('user', 'UserController');
});
