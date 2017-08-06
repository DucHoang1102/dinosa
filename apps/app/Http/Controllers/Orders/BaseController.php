<?php

namespace App\Http\Controllers\Orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use View;
use App\functions\OrdersHandling;

class BaseController extends Controller
{
    function __construct()
    {
    	View::share([
            'count_donMoi'          => OrdersHandling::count(1),
            'count_daXacNhan'       => OrdersHandling::count(2),
            'count_daInXong'        => OrdersHandling::count(3),
            'count_dangChuyen'      => OrdersHandling::count(4),
            'count_chuyenThanhCong' => OrdersHandling::count(5,6),
            'count_chuyenThatBai'   => OrdersHandling::count(7,8),
            'count_thungRac'        => OrdersHandling::count(9),
            //----------------------------------------------------------
            'orders_donMoi'          => OrdersHandling::getByStatus(1), 
            'orders_daXacNhan'       => OrdersHandling::getByStatus(2),
            'orders_daInXong'        => OrdersHandling::getByStatus(3),
            'orders_dangChuyen'      => OrdersHandling::getByDateStatus(4),
            'orders_chuyenThanhCong' => OrdersHandling::getByDateStatus(5,6),
            'orders_chuyenThatBai'   => OrdersHandling::getByDateStatus(7,8),
            'orders_thungRac'        => OrdersHandling::getByStatus(9),
        ]);
    }
}
