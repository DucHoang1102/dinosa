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

Route::get('test', function () {
	return var_dump(OrdersHandling::getByStatus(1,2));
});


Route::group(['prefix'=>'orders'], function(){
	// Index Default
	Route::get('', ['as' => 'indexOrders', 'uses' => 'Orders\OrderController@index']);

	// Gửi mail
	Route::get('send-mail', ['as' => 'sendMail', 'uses' => 'Orders\AjaxController@getSendMailAjax']);

	// Thêm orders
	Route::post('add', ['as' => 'addOrders', 'uses' => 'Orders\AjaxController@postAddOrdersAjax']);

	// Thêm sản phẩm
	Route::post('add-product', ['as' => 'addProductOrders', 'uses' => 'Orders\AjaxController@postAddProductsAjax']);

	// Xóa sản phẩm
	Route::post('delete-product', ['as' => 'deleteProductOrders', 'uses' => 'Orders\AjaxController@postDeleteProductsAjax']);

	// Xóa vĩnh viễn
	Route::get('delete-permanently/{id_customer}/{id_order}', ['as' => 'deletePermanentlyOrders', 'uses' => 'Orders\OrderController@getDeletePermanently']);

	// Autocomplete: Phone
	Route::post('autocomplete/{colum}', ['as' => 'autoCompleteOrders', 'uses' => 'Orders\AjaxController@postAutoCompleteAjax']);

	// Get Move
	Route::get('move/status={status}+id={id}+no_update={no_update}', ['as' => 'moveOrders', 'uses' => 'Orders\OrderController@getMove']);

	// Prints
	Route::group(['prefix'=>'print'], function(){
		Route::get('orders', ['as' => 'printOrders', 'uses' => 'Orders\PrintController@getPrintOrders']);
		Route::get('products/{id_order}/{id_product}', ['as' => 'printProducts', 'uses' => 'Orders\PrintController@getPrintProducts']);
	});
});