<?php

namespace App\Http\Controllers\Orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use View;
use DB;
use App\functions\OrdersHandling;
use App\functions\CustomerHandling;

class OrderController extends BaseController
{
    function index () {
    	return view('orders.index');
    }

    function getMove ($status, $id, $no_update = false) {

        OrdersHandling::move($status, $id, $no_update);

        return redirect(action('Orders\OrderController@index'));
        exit();
    }

    // Xóa vĩnh viễn đơn hàng
    function getDeletePermanently($id_order=0 )
    {
        // Xóa toàn bộ - dọn dẹp khách hàng lỗi
        if ($id_order == 'all')
        {
            OrdersHandling::deleteAll();
            CustomerHandling::clear();
        }

        else {
            if ( OrdersHandling::is_order_of_thungrac($id_order) ) {
                OrdersHandling::delete( $id_order );
            }
        }

        return redirect(action('Orders\OrderController@index'));
        exit();
    }
}
