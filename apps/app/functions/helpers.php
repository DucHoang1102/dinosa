<?php
namespace App\functions;

use DB;

class RandomId
{
	private static $result;

	public static function get ($prefix="Default", $length=10)
	{
		$length = (int)$length;

		self::$result = $prefix;

		for ($i = 0 ; $i < $length; $i++)
		{
			self::$result = self::$result . rand(0,9);
		}

		return self::$result;
	}
}

class ParserProduct
{      

    public $name_category_product = "";

    public $id_image_print      = "";

    public $name_embryo_tshirt    = "";

    public $name                  = "";

    public $size                  = "";

    public $price                 = 0; 

    function __construct($subject="")
    {
    	$subject = strtoupper(trim($subject));

		$re = '/^((A|D)[0-9]*[A-Z]?)(CT1|CT2|DT1|DT2|AK1|AK2|AK3)\((S|M|L|XL|XXL)\)$/';

		if (preg_match($re, $subject, $matches)) {
			$this->name_category_product = $matches[2];
			$this->id_image_print        = $matches[1];
			$this->name_embryo_tshirt    = $matches[3];
			$this->name                  = $matches[0];
			$this->size                  = $matches[4];
			$this->price                 = $this->getPriceProduct();
		}
    }

    private function getPriceProduct () {
    	$prices = [
    		'ACT1' => 150000, 'ACT2' => 150000,
    		'ADT1' => 160000, 'ADT2' => 160000,
    		'DCT1' => 125000, 'DCT2' => 125000,
    		'DDT1' => 125000, 'DDT2' => 125000,
    		'AAK1' => 250000, 'AAK2' => 250000,
    		'AAK3' => 250000,
    	];

    	$product = $this->name_category_product . $this->name_embryo_tshirt;

    	return isset($prices[$product]) ? $prices[$product] : 0;
    }

}

class TotalMoney
{
    // Convert tiền dạng 100,000
    public static function convert ($name)
    {
        $result = "";
        $name   = strrev($name);
        $div    = 0;

        for ($i=0; $i < strlen($name) ; $i++) {
            if ($div == 3) {
                $result = ',' . $result;
                $div = 0;
            }

            $result = $name[$i] . $result;

            $div+=1;
        }
        return $result;
    }

    // Cộng tổng tiền
    public static function get($id_order="")
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
                    ->get();

        $total_money = $order->surcharge_money + $order->ship_customer_money;

        foreach ($products as $product) {
            $total_money = $total_money + $product->price;
        }

        return self::convert($total_money);
    }
}

class DateHandling
{
    public static function convert ($date_sql="") 
    {
        //$date_sql = "2017-07-26 23:58:05";

        $date_sql = date('Y-m-d', strtoTime($date_sql)); // Chuyển từ 2017-07-27 14:58:05 => 2017-07-27

        $today_number = strtoTime(date('Y-m-d')); // Chuyển từ Y-m-d => ra số

        $date_sql_number = strtoTime($date_sql); // Chuyển ra Y-m-d => số

        // Mỗi ngày cách nhau: 86400s;
        $ratio = ($today_number-$date_sql_number)/86400;

        if ($ratio == 0) $time_string = "Hôm nay";
        
        else if ($ratio == 1) $time_string = "Hôm qua";

        else if ($ratio > 1) $time_string = $ratio . ' ngày trước';

        // Trả về dạng: Hôm nay (28-07-2017)
        return $time_string . ' (' . date('d-m-Y', strtoTime($date_sql)) . ')';$date_sql;
    }

}
//1501174800
//1501088400