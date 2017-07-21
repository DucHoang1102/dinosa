<?php 
namespace App\functions;

use DB;

/*
$order_donMoi = ['orders' => '[{}, {}, {}]'], 'total-orders' => 'Tổng số lượng orders' ('có thẻ không cần')

    		"{produces => [['name1' => 'sanpham1', 'money' => 'tiền sản phẩm']], 'total-money' => 'Tổng tiền đơn hàng'}, {}, {}"

    	
    		"  
				function total-orders
				function Lấy sản phẩm theo đơn hàng
				function Lấy thông tin khách hàng theo đơn hàng

				trả về array $orders lưu toàn bộ thông tin của orders
    		"
*/
class OrdersHandling
{
	public static function get ($order_status) 
	{
		$orders = DB::table('orders')
    		->where('id_orders_status', $order_status)
    		->join('customers', 'orders.id_customers', '=', 'customers.id')
    		->get();

    	foreach ($orders as $order) {
    		$produces = self::getProduces($order->id);
    		$order->produces = $produces;
    	}
    	return $orders;
	}

	public static function getProduces($id_orders) 
	{
		$produces = DB::table('products_of_orders')
    		->where('id_orders', $id_orders)
    		->select('name', 'size' ,'money')
    		->get();
    	return $produces;
	}

	public static function getCustomers()
	{

	}

}