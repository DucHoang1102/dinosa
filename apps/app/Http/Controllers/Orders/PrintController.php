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
             if($id_order == "all" && $id_product="all") return view('orders.prints.products');

            else{
                foreach ( OrdersHandling::getByStatus(2) as $order ) {
                    if ( $order->id == $id_order ) {
                        foreach ( $order->products as $product ) {
                            if ( $product->id == $id_product ) {
                                $order->products  = [$product];

                                $orders_daXacNhan = [$order];

                                return view('orders.prints.products', compact('orders_daXacNhan'));
                            }
                        }
                    }
                }
                return view('orders.prints.products');
            }
        }
    }
}
