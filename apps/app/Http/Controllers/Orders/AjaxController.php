<?php

namespace App\Http\Controllers\orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\functions\RandomId;
use App\functions\ParserProduct;
use App\functions\TotalMoney;
use App\functions\OrdersHandling;
use App\functions\Excel;
use App\functions\Email;

class AjaxController extends Controller
{
	// Thêm đơn hàng
    function postAddOrdersAjax (Request $request) {
        $_id_order    = isset($request->_id_order)    ? $request->_id_order : "";
        $_id_customer = isset($request->_id_customer) ? $request->_id_customer : "";
        $colum        = isset($request->colum)        ? $request->colum     : "";
        $value        = isset($request->value)        ? $request->value     : "";

        $colum_customers = ['name', 'phone', 'address'];

        if (! in_array($colum, $colum_customers)) return [];

        // Trường hợp thêm mới đơn hàng
        if (empty($_id_order) || empty($_id_customer)) {
            // Colums Customers
            $colum_customers = ['name', 'phone', 'address'];

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
            else return [];
        }
       
       // Trường hợp sửa đơn hàng
       else 
       {
            DB::table('customers')
                ->where('id', $_id_customer)
                ->update([
                    $colum => $value
                ]);
            return [];
       }
    }

    // Thêm sản phẩm
    function postAddProductsAjax (Request $request)
    {
        $_id_order   = isset($request->_id_order)   ? $request->_id_order   : "";
        $_id_product = isset($request->_id_product) ? $request->_id_product : "";
        $product     = isset($request->product)     ? $request->product     : "";

        $product = new ParserProduct($product);

        if (empty($_id_product)) {
            // Tạo mới sản phẩm
            $_id_product = RandomId::get("PO", 10);

            $check = DB::table('products_of_orders')->insert([
                'id'                    => $_id_product,
                'id_orders'             => $_id_order,
                'name_category_product' => $product->name_category_product,
                'id_image_print'        => $product->id_image_print,
                'name_embryo_tshirt'    => $product->name_embryo_tshirt,
                'name'                  => $product->name,
                'size'                  => $product->size,
                'price'                 => $product->price,
                'created_at'            => \Carbon\Carbon::now(),
                'updated_at'            => \Carbon\Carbon::now()
            ]);

            if ($check == true) {
                return [
                    'id_product'  => $_id_product, 
                    'total_money' => TotalMoney::get($_id_order), 
                    'url_image'    => OrdersHandling::get_url_image($product->id_image_print)
                ]; 
            }
            return [];
        }
        else return [];
    }


    // Xóa sản phẩm
    function postDeleteProductsAjax (Request $request)
    {
        $_id_order   = isset($request->_id_order)   ? $request->_id_order   : "";
        $_id_product = isset($request->_id_product) ? $request->_id_product : "";

        if (!empty($_id_order) && !empty($_id_product)) {

            // Xóa xản phẩm
            $check = DB::table('products_of_orders')
                        ->select('price')
                        ->where([
                            ['products_of_orders.id_orders', $_id_order],
                            ['products_of_orders.id', $_id_product]
                        ])
                        ->delete();

            if ($check == 1) return ['total_money' => TotalMoney::get($_id_order)];
            else return [];
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

    function getSendMailAjax (Request $request)
    {
        $path            = 'upload/mail-orders/';
        $file_name       = 'Nguyễn Đức Hoàng ' . date('d-m-Y') . '.xlsx';
        $file_path       = $path . $file_name;
        $orders_daInXong = OrdersHandling::get(3);

        if (count($orders_daInXong) < 1) return ["status" => 0];
        
        // Tạo file excel đơn hàng
        $excel      = new Excel();
        $excel->setDatas($orders_daInXong)->saveFile($path, $file_name );

        // Kiểm tra sự tồn tại file 
        if (!file_exists($file_path)) return ["status" => 0];

        // Gửi đơn hàng cho vận chuyển
        $mail       = new EMail();
        $result = $mail->sendMail($file_name, $file_name, $file_path, $file_name);

        if ($result) return ["status" => 1, 'time_current'=> date('d-m-Y H:i:s'), 'file' => $file_name];
        
        return ["status" => 0];
    }
}
