<?php

namespace App\Http\Controllers\Orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use View;
use App\functions\OrdersHandling;

class BaseController extends Controller
{
    function __construct () {
    	View::share([
    		'orders_donMoi'                       => OrdersHandling::get(1),
    		'orders_daXacNhan'                    => OrdersHandling::get(2),
    		'orders_daInXong'                     => OrdersHandling::get(3),
    		'orders_dangChuyen'                   => OrdersHandling::get(4),
    		'orders_chuyenThanhCongChuaThanhToan' => OrdersHandling::get(5),
    		'orders_chuyenThanhCongDaThanhToan'   => OrdersHandling::get(6),
    		'orders_chuyenThatBaiChuaTraHang'     => OrdersHandling::get(7),
    		'orders_chuyenThatBaiDaTraHang'       => OrdersHandling::get(8),
    		'orders_thungRac'                     => OrdersHandling::get(9),
    	]);
    }
}
