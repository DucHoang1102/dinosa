<?php 
namespace App\functions;

use DB;
use App\functions\ProductHandling;
use App\functions\helpers\RandomId;
use App\functions\helpers\DateHandling;
use App\functions\helpers\ConvertMoney;

/*
|--------------------------------------------------------------------------
| OrdersHandling
|--------------------------------------------------------------------------
|
| Xử lý chung cho orders
|
*/ 
class OrdersHandling
{
	public static function getByStatus ($order_status='0', $or_order_status='0') 
	{
		$orders = DB::table('orders')
            ->select('*', 'orders.id as id', 'orders.created_at as created_at', 'orders.updated_at as updated_at')
    		->whereIn('id_orders_status', [$order_status, $or_order_status])
    		->join('customers', 'orders.id_customers', '=', 'customers.id')
            ->orderBy('orders.updated_at', 'asc')
    		->get();

        if (!empty($orders)) {
            foreach ($orders as $order) {
                $products = ProductHandling::get($order->id);
                $order->products = $products;
                $order->total_money = self::totalMoney($order->id);
            }
            return $orders;
        }
    	else return [];
	}

    public static function getByDateStatus ($order_status=0, $or_order_status=0)
    {
        $list_group_dates   = [];
        
        $result = [];

        $date_orders = DB::table('orders')
                            ->select('updated_at')
                            ->whereIn('id_orders_status', [$order_status, $or_order_status])
                            ->orderBy('updated_at', 'asc')
                            ->get();
        foreach ($date_orders as $key => $date) {
            $list_group_dates[] = date('Y-m-d', strtoTime($date->updated_at));
        }

        $list_group_dates = array_unique($list_group_dates);

        foreach ($list_group_dates as $date) {

            $orders = self::getByStatus($order_status, $or_order_status);

            foreach ($orders as $order) {

                if ($date == date('Y-m-d', strtoTime($order->updated_at))) {

                    $result[DateHandling::convert($date)][] = $order;
                }
            }
        }

        return $result;
    }

    // Đến tổng số order
    public static function count($order_status=0, $or_order_status=0)
    {
        $count_orders = DB::table('orders')
                        ->select(DB::raw('count(*) as count'))
                        ->whereIn('id_orders_status', [$order_status, $or_order_status])
                        ->first();
        return $count_orders->count;
    }

    // Sử lý Total Money
    // Hàm OK
    public static function totalMoney ($id_order='000')
    {
        $total_money = 0;

        $order    = DB::table('orders')
                      ->select('surcharge_money', 'ship_customer_money')
                      ->where('id', $id_order)
                      ->first();

        $products = DB::table('products_of_orders')
                      ->select('products_of_orders.price')
                      ->where([
                          ['products_of_orders.id_orders', $id_order]
                      ])
                      ->get(); // Bắt buộc phải để get

        if ( empty($order) ) return 0;

        if ( !empty($products) ) {  
            foreach ($products as $product) {
                $total_money = $total_money + $product->price;
            }

            $total_money = $total_money + $order->surcharge_money + $order->ship_customer_money;
        }

        return ConvertMoney::get($total_money);
    }

    // Move orders, chuyển qua lại giữa các trường
    public static function move($status, $id, $no_update = false) 
    {
        if (!empty($status) and !empty($id))
        {
            if ($no_update == true) {
                $update = [
                    'id_orders_status' => $status
                ];
            }
            else {
                $update = [
                    'id_orders_status' => $status,
                    'updated_at' => \Carbon\Carbon::now()
                ];
            }

            $result = DB::table('orders')
                          ->where('orders.id', $id)
                          ->update($update);
            return $result;
        }
        else return false;
    }

    // Tạo orders
    public static function create($id_customer)
    {
        $id_order = RandomId::get("DS", 10);

        $result   = DB::table('orders')
                      ->insert([
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

        if ($result) return $id_order;
        else         return false;
    }

    // Delete orders
    public static function delete()
    {

    }

    // Delete Permanently Orders -> Xóa vĩnh viễn
    public static function deletePermanently ($id_order) {
        if ( $id_order === 0 ) return false;

        $result = DB::table('orders')->where(
            'id', $id_order 
        )->delete(); 

        return $result;
    }

    public static function deletePermanentlyAll () {
        $result = DB::table('orders')->where([
            [ 'id_orders_status', 9 ]
        ])->delete(); 

        return $result;
    }

    // Kiểm tra orders thuộc đơn mới
    public static function is_order_of_donmoi($id_order)
    {
        $result = DB::table('orders')
                    ->select('id')
                    ->where([
                        [ 'id', $id_order ],
                        [ 'id_orders_status', 1 ]
                    ])
                    ->first(); // trả về rarray hoặc null

        if ( $result ) return true;
        else           return false;
    }

    // Kiểm tra orders thuộc thùng rác
    public static function is_order_of_thungrac($id_order)
    {
        $result = DB::table('orders')
                    ->select('id')
                    ->where([
                        [ 'id', $id_order ],
                        [ 'id_orders_status', 9 ]
                    ])
                    ->first(); // trả về rarray hoặc null | get trả về [] hoặc array

        if ( $result ) return true;
        else           return false;
    }
}
