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
    		'orders_donMoi'                       => OrdersHandling::get(1), // Sửa lại sau, sẽ xóa
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

    function getView()
    {
    	$result = ['orders' => DB::table('customers')->get()];
    	return json_encode($result);
    }

    function postAdd (Request $request) {
    	// Không validate dữ liệu chung, validate ở duy nhất mục sản phẩm
    	//
    	// Kiểm tra đối tượng đã tồn tại chưa
    	// Test sdt 
    	// Lưu khách hàng 
    	// Lấy id khách hàng lưu orders
    	// Lấy id orders lưu products_of_orders => Hàm phân tích sản phẩm => Tính tiền => Tổng tiền
    	
    	$_id_customer = isset($request->_id_customer) ? $request->_id_customer : "";
    	$colum        = isset($request->colum)        ? $request->colum        : "";
    	$value        = isset($request->value)        ? $request->value        : "";

		if (!empty($_id_customer)) {
    		DB::table('customers')
					->where('id', $_id_customer)
					->update([
						$colum => $value
					]);
    	}
    	else {
    		$_id_customer = DB::table('customers')->insertGetId([
	    		$colum => $value
    		]);
    		return json_encode(['_id_customer' => $_id_customer]);
    	}
    	exit();
    }

    function postAutoComplete(Request $request, $colum)
    {
    	if ($colum == 'phone') {
    		$phoneInput = isset($request->phoneInput) ? $request->phoneInput : "";
    		$phones = DB::table('customers')
    					->select('phone', 'name')
    					->where('phone', 'like', $phoneInput.'%')
    					->offset(0)
    					->limit(5)
    					->get();
    		return json_encode($phones);
    	}

    	else if ($colums == "produce") {

    	}

   		else {
   			
   		}
    }
}
