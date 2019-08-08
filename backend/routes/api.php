<?php

Route::post('/register', 'AuthController@register');
Route::post('/logout', 'AuthController@logout');
Route::post('/login', 'AuthController@login');