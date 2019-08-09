<?php

Route::post('/register', 'UserController@register');
Route::post('/logout', 'AuthController@logout');
Route::post('/login', 'AuthController@login');