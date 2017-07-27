<?php 
namespace App\functions;

use DB;
use App\functions\ConverseTotalMoney;

class OrdersHandling
{
	public static function get ($order_status) 
	{
		$orders = DB::table('orders')
            ->select(DB::raw('*, orders.id as id'))
    		->where('id_orders_status', $order_status)
    		->join('customers', 'orders.id_customers', '=', 'customers.id')
            ->orderBy('orders.created_at', 'asc')
    		->get();

    	foreach ($orders as $order) {
    		$products = self::getProducts($order->id);
    		$order->products = $products;
            $order->total_money = ConverseTotalMoney::get($order->total_money);
    	}

    	return $orders;
	}

	public static function getProducts($id_orders) 
	{
		$products = DB::table('products_of_orders')
    		->where('id_orders', $id_orders)
    		->select('id', 'name','price')
            ->orderBy('products_of_orders.created_at', 'asc')
    		->get();
    	return $products;
	}

	public static function getCustomers()
	{

	}

}