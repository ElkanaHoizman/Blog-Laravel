<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/about', function () {
//     return view ('pages.about');
    
// });
Route::get('/','pagescontroller@index');
Route::get('/about','pagescontroller@about');
Route::get('/servces','pagescontroller@servces');
Route::resource('/posts','postController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
