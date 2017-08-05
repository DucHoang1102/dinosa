<?php

namespace App\Http\Controllers\orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\functions\OrdersHandling;
use App\functions\CustomerHandling;
use App\functions\Excel;
use App\functions\Email;

class AjaxController extends BaseController
{
    // Thêm đơn hàng
    function postAddOrdersAjax (Request $request) {
        $_id_order    = isset($request->_id_order)    ? $request->_id_order    : "";
        $_id_customer = isset($request->_id_customer) ? $request->_id_customer : "";
        $colum        = isset($request->colum)        ? $request->colum        : "";
        $value        = isset($request->value)        ? $request->value        : "";

        // Ràng buộc các colums
        $colum_customers = ['name', 'phone', 'address'];
        if (! in_array($colum, $colum_customers)) return [];

        // Kiểm tra khách hàng đã tồn tại chưa thông qua số điện thoại
        if ($colum == 'phone') {

            $id_customer_old = CustomerHandling::existsCustomer($value);

            // Nếu tồn tại khách hàng
            if (!empty($id_customer_old)) {

                // Nếu không phải khách hàng hiện tại thì xóa khách hàng
                // và thêm mới orders
                if ($id_customer_old !== $_id_customer)
                {
                    CustomerHandling::delete($_id_customer);
                    $_id_order = OrdersHandling::create($id_customer_old);
                }

                return [
                    'customer_old' => CustomerHandling::getInfoCustomer($id_customer_old),
                    '_id_order'    => $_id_order, 
                    '_id_customer' => $id_customer_old
                ];
            }
        }

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
                    'url_image'    => OrdersHandling::getUrlImage($product->id_image_print)
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
            $phones     = DB::table('customers')
                            ->select('phone', 'name')
                            ->where('phone', 'like', $phoneInput.'%')
                            ->offset(0)
                            ->limit(5)
                            ->get();

            if (CustomerHandling::existsCustomer($phoneInput)) return [];
            else return $phones;
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
}
