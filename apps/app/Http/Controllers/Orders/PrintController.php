<?php

namespace App\Http\Controllers\Orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\functions\OrdersHandling;

class PrintController extends BaseController
{
    function getPrintOrders() {
        return view('orders.prints.orders');
    }

    function getPrintProducts($id_order="all", $id_product="all") {
        if($id_order == "all" && $id_product="all") return view('orders.prints.products');

        else{
            $orders_daXacNhan = OrdersHandling::get(2, 0, $id_order, $id_product);
            return view('orders.prints.products', compact('orders_daXacNhan'));
        }
    }
}
