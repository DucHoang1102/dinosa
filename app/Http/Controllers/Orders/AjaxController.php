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
        $_id_order    = $request->_id_order;
        $_id_customer = $request->_id_customer;
        $name         = $request->name;
        $phone        = $request->phone;
        $address      = $request->address;

        // Kiểm tra khách hàng đã tồn tại chưa thông qua số điện thoại
        $id_customer_old = CustomerHandling::existsCustomer($phone);

        // Nếu là khách hàng cũ
        if (strlen($phone) >= 10 && !empty($id_customer_old) && $_id_customer !== $id_customer_old) {

            // Kiểm tra xem Khách hàng có các orders status không phải đơn mới không
            $check = CustomerHandling::haveOrders($_id_customer, [2,3,4,5,6,7,8, 9]);

            // Xóa customer nếu nó không chứa orders quan trọng
            if (empty($check)) CustomerHandling::delete($_id_customer);

            // Xóa order, tạo orders mới
            OrdersHandling::delete($_id_order);
            
            $id_order = OrdersHandling::create($id_customer_old);

            return [
                'customer_old' => CustomerHandling::getInfoCustomer($id_customer_old),
                '_id_order'    => $id_order, 
                '_id_customer' => $id_customer_old
            ];
        }

        // Trường hợp thêm mới đơn hàng
        if (empty($_id_order)) {

            // Thêm khách hàng
            $id_customer = CustomerHandling::create($name, $phone, $address);

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
            CustomerHandling::update($_id_customer, $name, $phone, $address);
            return [];
        }
    }

    // Thêm sản phẩm
    function postAddProductsAjax (Request $request)
    {
        $_id_order   = $request->_id_order;
        $_id_product = $request->_id_product;
        $product     = $request->product;

        if ( OrdersHandling::is_order_of_donmoi($_id_order) ) {
            // Tạo mới sản phẩm, chỉ tạo được các đơn tại đơn mới
            // nếu không người dùng có thể hack được
            $products    = ProductHandling::parser($product);

            $inventory   = ProductHandling::checkInventory($products['name']);

            if ($inventory) $_id_product = ProductHandling::create( $_id_order, $products, '1' );
            else            $_id_product = ProductHandling::create( $_id_order, $products );

            if ( $_id_product ) {
                return [
                    'id_product'  => $_id_product, 
                    'total_money' => OrdersHandling::totalMoney( $_id_order ), 
                    'url_image'   => ProductHandling::getUrlImage( ProductHandling::parser($product)['id_image_print'] ),
                    'inventory'   => $inventory
                ]; 
            }
            return [];
        }
        else return [];
    }


    // Xóa sản phẩm
    function postDeleteProductsAjax (Request $request)
    {
        $_id_order   = $request->_id_order;
        $_id_product = $request->_id_product;

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
        $orders_daInXong = OrdersHandling::getByStatus(3);

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

    // Thay đổi trạng thái sản phẩm
    function getChangeStatus(Request $request)
    {
        $status     = $request->_status;
        $id_order   = $request->_id_order;
        $id_product = $request->_id_product;

        if ( !empty($id_order) || !empty($id_product) )
        {
            switch ($status) {
                case '0':
                    $status = '1';
                    break;
                case '1': 
                    $status = '0';
                    break;
                default:
                    $status = '0';
                    break;
            }

            ProductHandling::changeStatus($id_order, $id_product, $status);

            return ['status' => $status];
        }
        else return [];
    }

    // Cộng thêm tiền ship hoặc phụ phí nếu có
    function postPlusMoney(Request $request)
    {
        // Validate số âm
        if ($request->_ship < 0 || $request->_phuphi < 0) return [];
        // Validate 2 trường đều trống
        if ($request->_ship == null && $request->_phuphi == null) return [];

        $id_order     = $request->_id_order;
        $ship_money   = ($request->_ship   !== null) ? $request->_ship   : 0;
        $phuphi_money = ($request->_phuphi !== null) ? $request->_phuphi : 0;

        $orders = OrdersHandling::plusMoney($id_order, $ship_money, $phuphi_money);

        return [
            'ship_money'   => $orders['ship_money'],
            'phuphi_money' => $orders['phuphi_money'],
            'total_money'  => $orders['total_money']
        ];
    }
}
