<?php
use App\functions\OrdersHandling;
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

Route::group(['prefix'=>'orders'], function(){

	Route::get('', ['as' => 'indexOrders', 'uses' => 'Orders\OrderController@index']);

	Route::get('print/orders', ['as' => 'printOrders', 'uses' => 'Orders\OrderController@getPrintOrders']);

	Route::get('print/products/{id_order}/{id_product}', ['as' => 'printProducts', 'uses' => 'Orders\OrderController@getPrintProducts']);
	Route::get('sendmail', ['as' => 'sendMail', 'uses' => 'Orders\AjaxController@getSendMailAjax']); // Test

	Route::get('sendmail', ['as' => 'sendMail', 'uses' => 'Orders\AjaxController@getSendMailAjax']);

	Route::post('add', ['as' => 'addOrders', 'uses' => 'Orders\AjaxController@postAddOrdersAjax']);

	Route::post('addproduct', ['as' => 'addProductOrders', 'uses' => 'Orders\AjaxController@postAddProductsAjax']);

	Route::post('deleteproduct', ['as' => 'deleteProductOrders', 'uses' => 'Orders\AjaxController@postDeleteProductsAjax']);

	Route::get('delete-permanently/{id_customer}/{id_order}', ['as' => 'deletePermanentlyOrders', 'uses' => 'Orders\OrderController@getDeletePermanentlyOrders']);

	Route::post('autocomplete/{colum}', ['as' => 'autoCompleteOrders', 'uses' => 'Orders\AjaxController@postAutoCompleteAjax']);

	// Chuyển đơn qua lại giữa các trường;
	Route::get('move/status={status}+id={id}+no_update={no_update}', ['as' => 'moveOrders', 'uses' => 'Orders\OrderController@getMove']);
});