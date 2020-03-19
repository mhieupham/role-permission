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

use App\Http\Controllers\Backend\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('api','UserController');

Route::middleware(['auth'])->group(function () {

    //module user
    Route::prefix('users')->group(function () {
        //list user
        Route::get('/',[
            'as' =>'user.index',
            'uses' => 'UserController@index',
            'middleware'=>'checkacl:user_list'
        ]);
        //create user
        Route::get('/create',[
            'as' =>'user.add',
            'uses'=>'UserController@create',
            'middleware'=>'checkacl:user_add'
        ]);
        Route::post('/create','UserController@store')->name('user.store');
        //edit user
        Route::get('/edit/{id}',[
            'as' =>'user.edit',
            'uses'=>'UserController@edit',
            'middleware'=>'checkacl:user_edit'
        ]);
        Route::post('/edit/{id}','UserController@update')->name('user.update');
//        delete user
        Route::get('/delete/{id}',[
            'as' =>'user.destroy',
            'uses'=>'UserController@destroy',
            'middleware'=>'checkacl:user_delete'
        ]);


    });
    Route::prefix('roles')->group(function () {
        //list role
        Route::get('/',[
            'as' =>'role.index',
            'uses'=>'RoleController@index',
            'middleware'=>'checkacl:role_list'
        ]);
        //create role
        Route::get('/create',[
            'as' =>'role.add',
            'uses'=>'RoleController@create',
            'middleware'=>'checkacl:role_add'
        ]);
        Route::post('/create','RoleController@store')->name('role.store');
        //edit role
        Route::get('/edit/{id}','RoleController@edit')->name('role.edit');
        Route::get('/edit/{id}',[
            'as' =>'role.edit',
            'uses'=>'RoleController@edit',
            'middleware'=>'checkacl:role_edit'
        ]);
        Route::post('/edit/{id}','RoleController@update')->name('role.update');
//        delete role
        Route::get('/delete/{id}','RoleController@destroy')->name('role.destroy');
        Route::get('/delete/{id}',[
            'as' =>'role.destroy',
            'uses'=>'RoleController@destroy',
            'middleware'=>'checkacl:role_delete'
        ]);
    });
});
