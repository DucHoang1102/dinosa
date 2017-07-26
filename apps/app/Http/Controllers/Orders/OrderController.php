<?php

namespace App\Http\Controllers\Orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\functions\orders\thuxem;

use View;
use DB;
use App\functions\OrdersHandling;
use App\functions\RandomId;
use App\functions\ParserProduct;

class OrderController extends Controller
{
    function index () {
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
    	return view('bill.base');
    }

    function getView()
    {
        $orders = OrdersHandling::get(1);
        return $orders;
    }

    function postAddOrdersAjax (Request $request) {
        $_id_order = isset($request->_id_order) ? $request->_id_order : "";

        // Trường hợp thêm mới đơn hàng
       if (empty($_id_order)) {
            // Colums Customers
            $colum_customers = ['name', 'phone', 'address'];
            $colum = isset($request->colum) ? $request->colum : "";
            $value = isset($request->value) ? $request->value : "";

            $id_customer = RandomId::get("CT", 10);
            $id_order    = RandomId::get("DS", 10);

            $check_1 = DB::table('customers')->insert([
                'id'   => $id_customer,
                $colum => $value,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);

            // Colums Orders
            $check_2 = DB::table('orders')->insert([
                'id'                  => $id_order,
                'id_post'             => "",
                'id_customers'        => $id_customer,
                'id_orders_status'    => 1,
                'surcharge_money'     => 0,
                'ship_customer_money' => 0,
                'total_money'         => 0,
                'created_at'          => \Carbon\Carbon::now(),
                'updated_at'          => \Carbon\Carbon::now()
            ]);
            if ($check_1 == true and $check_2 == true) {
                return ['_id_order'=>$id_order, '_id_customer'=>$id_customer];
            }
            else exit();
       }
       
       // Trường hợp sửa
       else 
       {
            $colum_customers = ['name', 'phone', 'address'];
            $colum = isset($request->colum) ? $request->colum : "";
            $value = isset($request->value) ? $request->value : "";

            if (in_array($colum, $colum_customers)) {
                $_id_customer = isset($request->_id_customer) ? $request->_id_customer : "";

                DB::table('customers')
                    ->where('id', $_id_customer)
                    ->update([
                        $colum => $value
                    ]);
            }
            return [];
       }
    }

    function postAddProductsAjax (Request $request)
    {
        $_id_order = isset($request->_id_order) ? $request->_id_order : "";
        $product = isset($request->product) ? $request->product : "";
        $_id_product = isset($request->_id_product) ? $request->_id_product : "";

        $product = new ParserProduct($product);

        if (empty($_id_product)) {
            // Tạo mới sản phẩm
            $_id_product = RandomId::get("PO", 10);
            $total_money = DB::table('orders')
                               ->select('total_money')
                               ->where('id',$_id_order)
                               ->first();

            $total_money = $total_money->total_money + $product->price;

            DB::table('products_of_orders')->insert([
                'id'                    => $_id_product,
                'id_orders'             => $_id_order,
                'name_category_product' => $product->name_category_product,
                'name_image_print'      => $product->name_image_print,
                'name_embryo_tshirt'    => $product->name_embryo_tshirt,
                'name'                  => $product->name,
                'size'                  => $product->size,
                'price'                 => $product->price,
                'created_at'            => \Carbon\Carbon::now(),
                'updated_at'            => \Carbon\Carbon::now()
            ]);

            $total_money = DB::table('orders')
                ->select('total_money')
                ->where('id', $_id_order)
                ->lockForUpdate(['total_money' => $total_money])->first();

            return ['id_product' => $_id_product, 'total_money' => $total_money->total_money];
        }
        else {
            // Sửa sản phẩm
            DB::table('products_of_orders')
                ->where('id', $_id_product)
                ->update([
                    'name_category_product' => $product->name_category_product,
                    'name_image_print'      => $product->name_image_print,
                    'name_embryo_tshirt'    => $product->name_embryo_tshirt,
                    'name'                  => $product->name,
                    'size'                  => $product->size,
                    'price'                 => $product->price,
                    'updated_at'            => \Carbon\Carbon::now()
                ]);
            return [];
        }
    }

    function postAutoCompleteAjax (Request $request, $colum)
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

    	else if ($colums == "product") {

    	}

   		else {
   			
   		}
    }
}
