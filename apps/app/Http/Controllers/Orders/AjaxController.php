<?php

namespace App\Http\Controllers\orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\functions\OrdersHandling;
use App\functions\CustomerHandling;
use App\functions\ProductHandling;
use App\functions\Excel;
use App\functions\Email;

class AjaxController extends BaseController
{
    // Thêm đơn hàng
    function postAddOrdersAjax (Request $request) {
<<<<<<< HEAD
        $_id_order    = isset($request->_id_order)    ? $request->_id_order    : "";
        $_id_customer = isset($request->_id_customer) ? $request->_id_customer : "";
        $colum        = isset($request->colum)        ? $request->colum        : "";
        $value        = isset($request->value)        ? $request->value        : "";
=======
        $_id_order    = isset($request->_id_order)    ? trim($request->_id_order)    : "";
        $_id_customer = isset($request->_id_customer) ? trim($request->_id_customer) : "";
        $colum        = isset($request->colum)        ? trim($request->colum)        : "";
        $value        = isset($request->value)        ? trim($request->value)        : "";
>>>>>>> Developer

        // Ràng buộc các colums
        $colum_customers = ['name', 'phone', 'address'];
        if (! in_array($colum, $colum_customers)) return [];

        // Trường hợp thêm mới đơn hàng
        if (empty($_id_order)) {

            // Thêm khách hàng
            $id_customer = CustomerHandling::create($colum, $value);

            // Thêm order
            $id_order    = OrdersHandling::create($id_customer);

            if (!empty($id_customer) && !empty($id_order)) {
                return [
                    '_id_order'    => $id_order, 
                    '_id_customer' => $id_customer
                ];
            }
            else return [];
        }
       
       // Trường hợp sửa đơn hàng bản chất là sửa khách hàng
        else {
            CustomerHandling::update($_id_customer, $colum, $value);
            return [];
        }
    }

    // Thêm sản phẩm
    function postAddProductsAjax (Request $request)
    {
        $_id_order   = isset($request->_id_order)   ? trim($request->_id_order)   : "";
        $_id_product = isset($request->_id_product) ? trim($request->_id_product) : "";
        $product     = isset($request->product)     ? trim($request->product)     : "";

        if ( OrdersHandling::is_order_of_donmoi($_id_order) ) {
            // Tạo mới sản phẩm, chỉ tạo được các đơn tại đơn mới
            // nếu không người dùng có thể hack được
            $_id_product = ProductHandling::create( $_id_order, $product );

            if ( $_id_product ) {
                return [
                    'id_product'  => $_id_product, 
<<<<<<< HEAD
                    'total_money' => TotalMoney::get($_id_order), 
                    'url_image'    => OrdersHandling::getUrlImage($product->id_image_print)
=======
                    'total_money' => OrdersHandling::totalMoney( $_id_order ), 
                    'url_image'   => ProductHandling::getUrlImage( ProductHandling::parser($product)['id_image_print'] )
>>>>>>> Developer
                ]; 
            }
            return [];
        }
        else return [];
    }


    // Xóa sản phẩm
    function postDeleteProductsAjax (Request $request)
    {
        $_id_order   = isset($request->_id_order)   ? trim($request->_id_order)   : "";
        $_id_product = isset($request->_id_product) ? trim($request->_id_product) : "";

        if ( OrdersHandling::is_order_of_donmoi($_id_order) ) {

           $result = ProductHandling::delete($_id_order, $_id_product);

            if ( $result ) return [ 'total_money' => OrdersHandling::totalMoney( $_id_order ) ];
            else return [];
        }
        else return [];
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
<<<<<<< HEAD

    function getDeletePermanentlyAjax($id_customer, $id_order)
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
=======
    
>>>>>>> Developer
}
