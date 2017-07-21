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
    function index () {
    	View::share([
    		'orders_donMoi'                       => OrdersHandling::get(1), // Sửa lại sau
    		'orders_daXacNhan'                    => OrdersHandling::get(2),
    		'orders_daInXong'                     => OrdersHandling::get(3),
    		'orders_dangChuyen'                   => OrdersHandling::get(4),
    		'orders_chuyenThanhCongChuaThanhToan' => OrdersHandling::get(5),
    		'orders_chuyenThanhCongDaThanhToan'   => OrdersHandling::get(6),
    		'orders_chuyenThatBaiChuaTraHang'     => OrdersHandling::get(7),
    		'orders_chuyenThatBaiDaTraHang'       => OrdersHandling::get(8),
    		'orders_thungRac'                     => OrdersHandling::get(9),
    	]);
    	return view('bill.base');
    }

    function postAdd (Request $request) {
    	// Không validate dữ liệu chung, validate ở duy nhất mục sản phẩm
    	//
    	// Kiểm tra đối tượng đã tồn tại chưa
    	// Test sdt 
    	// Lưu khách hàng 
    	// Lấy id khách hàng lưu orders
    	// Lấy id orders lưu products_of_orders => Hàm phân tích sản phẩm => Tính tiền => Tổng tiền
    
    	$_action_order = isset($request->_action_order) ? $request->_action_order : 'view';

    	if ($_action_order === 'add') 
    	{
    		$name         = isset($request->name)         ? $request->name         : "";
	    	$phone        = isset($request->phone)        ? $request->phone        : ""; 
	    	$address      = isset($request->address)      ? $request->address      : ""; 
	    	$_id_customer = isset($request->_id_customer) ? $request->_id_customer : "";

    		if (!empty($_id_customer)) {
	    		DB::table('customers')
	    					->where('id', $_id_customer)
	    					->update([
	    						'name'    => $name,
	    						'phone'   => $phone,
	    						'address' => $address,
	    					]);
	    	}
	    	else {
	    		$_id_customer = DB::table('customers')->insertGetId([
		    		'name'    => $name,
		    		'phone'   => $phone,
		    		'address' => $address,

	    		]);
	    	}
    	}

    	// Trả dữ liệu tất cả bảng:
    	$customers = DB::table('customers')->get();
    	return json_encode($customers);
    }
}
