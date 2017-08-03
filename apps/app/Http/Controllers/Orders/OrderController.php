<?php

namespace App\Http\Controllers\Orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\functions\orders\thuxem;

use View;
use DB;
use App\functions\OrdersHandling;

class OrderController extends Controller
{
    function __construct() {
        View::share([
            'count_donMoi'          => OrdersHandling::count(1),
            'count_daXacNhan'       => OrdersHandling::count(2),
            'count_daInXong'        => OrdersHandling::count(3),
            'count_dangChuyen'      => OrdersHandling::count(4),
            'count_chuyenThanhCong' => OrdersHandling::count(5,6),
            'count_chuyenThatBai'   => OrdersHandling::count(7,8),
            'count_thungRac'        => OrdersHandling::count(9),
            //----------------------------------------------------------
            'orders_donMoi'          => OrdersHandling::get(1), 
            'orders_daXacNhan'       => OrdersHandling::get(2),
            'orders_daInXong'        => OrdersHandling::get(3),
            'orders_dangChuyen'      => OrdersHandling::getByGroupDate(4),
            'orders_chuyenThanhCong' => OrdersHandling::getByGroupDate(5,6),
            'orders_chuyenThatBai'   => OrdersHandling::getByGroupDate(7,8),
            'orders_thungRac'        => OrdersHandling::get(9),
        ]);
    }
    function index () {
    	return view('bill.base');
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
    }

    function getPrintOrders() {
        return view('bill.print.orders');
    }

    function getPrintProducts($id_order="all", $id_product="all") {
        if($id_order == "all" && $id_product="all") return view('bill.print.products');

        else{
            $orders_daXacNhan = OrdersHandling::get(2, 0, $id_order, $id_product);
            return view('bill.print.products', compact('orders_daXacNhan'));
        }
    }
}
