<?php

namespace App\Http\Controllers\Orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use View;
use DB;
use App\functions\OrdersHandling;

class OrderController extends BaseController
{
    function index () {
    	return view('orders.base');
    }

    function getMove ($status='0', $id='000', $no_update = false) {

        OrdersHandling::move($status, $id, $no_update = false);

        return redirect(action('Orders\OrderController@index'));
        exit();
    }

    function getDeletePermanently($id_customer='000', $id_order='000')
    {
        if ($id_customer === 0 || $id_order === 0 || $id_customer === false || $id_order === false) {
            return redirect(action('Orders\OrderController@index'));
            exit();
        }

        OrdersHandling::deletePermanently($id_customer, $id_order);

        return redirect(action('Orders\OrderController@index'));
        exit();
    }
}
