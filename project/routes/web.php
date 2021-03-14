<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'MainController@index')->name('index');

Route::get('/categories', 'MainController@categories')->name('categories');

Auth::routes([
    'reset'=>false,
    'confirm'=>false,
    'verify'=>false
]);

Route::get('/reset', 'ResetController@reset')->name('reset_db');

Route::get('/logout', 'Auth\LoginController@logout')->name('get-logout');
//Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::middleware(['auth'])->group(
    function () {
        Route::group([
            'prefix' => 'person',
            'namespace' => 'Person',
            'as' => 'person.'
        ],function (){
            Route::get('/orders', 'OrderController@index')->name('orders.index');
            Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
        });

        Route::group([
            'namespace' => 'Admin',
            'prefix' => 'admin'
        ], function () {
            Route::group(['middleware' => 'is_admin'], function () {
                Route::get('/orders', 'OrderController@index')->name('home');
                Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
                Route::resource('categories', 'CategoryController');
                Route::resource('products', 'ProductsController');
            });


        });
    });



Route::group(['prefix'=>'basket'], function (){
    Route::group([
        'middleware'=>'basket_not_empty',
    ], function (){
        Route::get('/', 'BasketController@basket')->name('basket');
        Route::get('/place', 'BasketController@basketPlace')->name('basket-place');
        Route::post('/place/', 'BasketController@basketConfirm')->name('basket-confirm');
        Route::post('/remove/{id}','BasketController@basketRemove')->name('basket-remove');

    });
    Route::post('basket/add/{id}','BasketController@basketAdd')->name('basket-add');
});





Route::get('/{category}', 'MainController@category')->name('category');
Route::get('/{category}/{product}', 'MainController@products')->name('detail');





