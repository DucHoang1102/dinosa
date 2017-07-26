<?php
namespace App\functions;

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
    		'AAK3' => 250000
    	];

    	$product = $this->name_category_product . $this->name_embryo_tshirt;

    	return isset($prices[$product]) ? $prices[$product] : 0;
    }

}
