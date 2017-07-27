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

    public $name_image_print      = "";

    public $name_embryo_tshirt    = "";

    public $name                  = "";

    public $size                  = "";

    public $price                 = 0; 

    function __construct($subject="")
    {
    	$subject = strtoupper(trim($subject));

		$re = '/^((A|D)[0-9]*)(CT1|CT2|DT1|DT2|AK1|AK2|AK3)\((S|M|L|XL|XXL)\)$/';

		if (preg_match($re, $subject, $matches)) {
			$this->name_category_product = $matches[2];
			$this->name_image_print      = $matches[1];
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

class SumTotalMoney
{
    // Cộng tổng tiền
    public static function get($id_order, $money_product)
    {
        $total_money = DB::table('orders')
                           ->select('total_money')
                           ->where('id',$id_order)
                           ->first();

        $total_money = $total_money->total_money + $money_product;

        $check = DB::table('orders')
                ->where('id', $id_order)
                ->update([
                    'total_money' => $total_money
                ]);

        if ($check == 1) 
        {
            return ConverseTotalMoney::get($total_money);
        }
        return 0;
    }
}

class SubTotalMoney
{
    // Trừ tổng tiền
    public static function get($id_order, $id_product)
    {
        if (!empty($id_order) && !empty($id_product)) {

            // Lấy tổng tiền hiện tại
            $total_money_old = DB::table('orders')
                                    ->select('total_money')
                                    ->where('id',$id_order)
                                    ->first();

            // Lấy giá tiền sản phẩm cần trừ
            $price_product = DB::table('products_of_orders')
                                    ->select('price')
                                    ->where([
                                        ['products_of_orders.id_orders', $id_order],
                                        ['products_of_orders.id', $id_product]
                                    ])
                                    ->first();

            // Xóa xản phẩm
            $check_1 = DB::table('products_of_orders')
                            ->select('price')
                            ->where([
                                ['products_of_orders.id_orders', $id_order],
                                ['products_of_orders.id', $id_product]
                            ])
                            ->delete();


            // Cập nhật lại tổng tiền và trả về tổng tiền
            $total_money = $total_money_old->total_money - $price_product->price;

            $check_2 = DB::table('orders')
                         ->where('id', $id_order)
                         ->update([
                             'total_money' => $total_money
                         ]);

            if ($check_1 == 1 && $check_2 == 1) 
            {
                return ConverseTotalMoney::get($total_money);
            }
            return 0;
        }
    }
}

class ConverseTotalMoney
{
    public static function get($name) {

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
}