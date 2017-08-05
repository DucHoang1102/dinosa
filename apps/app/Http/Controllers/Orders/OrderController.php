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

    function getMove ($status="", $id="", $no_update = false) {

        if (!empty($status) and !empty($id))
        {
            if ($no_update == true) {
                $update = [
                    'id_orders_status' => $status
                ];
            } else {
                $update = [
                    'id_orders_status' => $status,
                    'updated_at' => \Carbon\Carbon::now()
                ];
            }

            DB::table('orders')
            ->where('orders.id', $id)
            ->update($update);
        }

        return redirect(action('Orders\OrderController@index'));
        exit();
    }

    function getDeletePermanently($id_customer, $id_order)
    {
        if ($id_customer === 0 || $id_order === 0 || $id_customer === false || $id_order === false) {
            return redirect(action('Orders\OrderController@index'));
            exit();
        }

        $result = DB::table('orders')->where([
            ['orders.id_customers', $id_customer],
            ['orders.id'          , $id_order]
        ])->delete();

        return redirect(action('Orders\OrderController@index'));
        exit();
    }
}
