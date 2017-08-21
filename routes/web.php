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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'/user'],function(){

    Route::get('view/categories','CategoryController@viewCats')->name('user.viewCats');

    Route::group(['middleware'=>'guest'],function(){

        Route::get('/login','UserController@getLogin');
        Route::get('/register','UserController@getRegister');
        Route::post('/registered','UserController@Register')->name('user.register');
        Route::post('/login/attempt','UserController@attemptLogin')->name('user.login');
    });

    Route::group(['middleware'=>'auth.check'],function() {

        Route::get('welcome', 'UserController@getWelcome');
        Route::get('logout', 'UserController@getLogout')->name('user.logout');
        Route::get('add_to_cart/{item_id}/{cart_id}', 'ItemController@addToCart');
        Route::get('view_profile', 'UserController@getProfile')->name('user.profile');
        Route::get('make_order','OrderController@getOrder')->name('user.getOrder');
        Route::post('item/ordered','OrderController@makeOrder')->name('user.makeOrder');
        Route::group(['prefix' => '/dashboard'], function () {

            Route::get('/', 'ItemController@getDashboard')->name('dashboard');
            Route::get('sort_by_price', 'ItemController@sortByPrice')->name('item.sortByPrice');
            Route::post('search', 'ItemController@searchByName');
            Route::get('search_not_found','ItemController@searchNotFound');
        });
    });

});

Route::group(['prefix'=>'/admin','middleware'=>'auth.check'],function (){
    Route::get('panel','AdminController@getPanel')->name('admin.panel');

    Route::get('manage/categories','AdminController@getCategories')->name('manage.categories');
    Route::post('add/category','AdminController@addCat')->name('add.cat');
    Route::get('update/category/{id}','AdminController@getUpdateCat');
    Route::post('category/updated','AdminController@updateCat')->name('update.cat');
    Route::get('delete/category/{id}','AdminController@deleteCat');

    Route::get('manage/items','AdminController@getItems')->name('manage.items');
    Route::get('add/item','AdminController@getAddItem')->name('get.addItem');
    Route::post('item/added','AdminController@addItem')->name('admin.addItem');
    Route::get('update/item/{id}','AdminController@getUpdateItem');
    Route::post('item/updated','AdminController@updateItem')->name('admin.updateItem');
    Route::get('delete/item/{id}','AdminController@deleteItem');

    Route::get('manage/users','AdminController@getUsers')->name('manage.users');
    Route::get('make/admin/{id}','AdminController@makeAdmin');
    Route::get('delete/user/{id}','AdminController@deleteUser');

    Route::get('login','AdminController@getLogin')->name('admin.getLogin');
    Route::post('login/attempt','AdminController@attemptLogin')->name('admin.login');


});


