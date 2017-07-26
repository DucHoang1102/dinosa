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

Route::get('/test', function () {
});

Route::group(['prefix'=>'orders'], function(){
	Route::get('', ['as' => 'indexOrders', 'uses' => 'Orders\OrderController@index']);

	Route::post('add', ['as' => 'addOrders', 'uses' => 'Orders\OrderController@postAddOrdersAjax']);

	Route::post('addproduct', ['as' => 'addproductOrders', 'uses' => 'Orders\OrderController@postAddProductsAjax']);

	Route::get('view', ['as' => 'viewOrders', 'uses' => 'Orders\OrderController@getView']);

	Route::post('autocomplete/{colum}', ['as' => 'autoCompleteOrders', 'uses' => 'Orders\OrderController@postAutoCompleteAjax']);
});