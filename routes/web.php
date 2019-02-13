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



Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('content');
    })->name('home');

    Route::get('/my_posts','UserController@my_posts')->name('my_posts');
    Route::get('/add_posts','UserController@my_posts')->name('add_posts');
    Route::post('/add_new_posts','PostContoller@add_posts')->name('add.new.posts');
    Route::post('/update_password','UserController@update_password')->name('update.password');
    Route::post('/update_profile_pics','UserController@update_profile_pics')->name('update.profile_pics');
    Route::get('/edit_post/{post_id}','PostContoller@edit_user_post')->name('edit_users_post');  
    Route::post('/update_post/{post_id}','PostContoller@update_user_post')->name('update_users_post'); 
    Route::get('/delete/{post_id}','PostContoller@delete_post')->name('user.delete.post');  
    Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){  
    Route::get('/admin_dashboard', 'UserController@admin_dashboard')->name('admin.dashboard');
    Route::get('/admin_dashboard/delete_user/{user_id}','UserController@delete_user')->name('delete.user');
    
    Route::get('/admin_dashboard/view_users_post/{user_id}','UserController@view_users_post')->name('view.user.posts');
    Route::get('/admin_dashboard/delete_post/{post_id}','UserController@delete_post')->name('delete.post');   

    });
});
 

