<?php 
namespace App\functions;

use DB;
use App\functions\TotalMoney;
use App\functions\DateHandling;

class OrdersHandling
{
	public static function get ($order_status=0, $or_order_status=0, $id_order=0, $id_product=0) 
	{
		$orders = DB::table('orders')
            ->select('*', 'orders.id as id', 'orders.created_at as created_at', 'orders.updated_at as updated_at')
    		->whereIn('id_orders_status', [$order_status, $or_order_status])
            ->where('orders.id', $id_order)
    		->join('customers', 'orders.id_customers', '=', 'customers.id')
            ->orderBy('orders.updated_at', 'asc')
    		->get();

    	foreach ($orders as $order) {
    		$products = self::getProducts($order->id, $id_product);
    		$order->products = $products;
            $order->total_money = TotalMoney::get($order->id);
    	}

    	return $orders;
	}

    public static function getByGroupDate ($order_status=0, $or_order_status=0, $id_product=0)
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

            $orders = self::get($order_status, $or_order_status);

            foreach ($orders as $order) {

                if ($date == date('Y-m-d', strtoTime($order->updated_at))) {

                    $result[DateHandling::convert($date)][] = $order;
                }
            }
        }

        return $result;
    }

	public static function getProducts($id_orders, $id_product=0) 
	{
		$products = DB::table('products_of_orders')
    		->where([
                ['id_orders', $id_orders],
                ['products_of_orders.id', $id_product]
            ])
    		->select('products_of_orders.id', 'products_of_orders.name', 'products_of_orders.price', 'products_of_orders.id_image_print')
            ->orderBy('products_of_orders.created_at', 'asc')
    		->get();

        foreach ($products as $product) {
            $product->url_image = self::getUrlImage($product->id_image_print);
        }

    	return $products;
	}

    public static function count($order_status=0, $or_order_status=0)
    {
        $count_orders = DB::table('orders')
                        ->select(DB::raw('count(*) as count'))
                        ->whereIn('id_orders_status', [$order_status, $or_order_status])
                        ->first();
        return $count_orders->count;
    }

    public static function getUrlImage($id_image=0) {
        $url_image = DB::table('image_print')
                        ->select('src_f_a3')
                        ->where('id', $id_image)
                        ->first();
        if (!empty($url_image)){
            return $url_image;
        }
        return false;
    }
}