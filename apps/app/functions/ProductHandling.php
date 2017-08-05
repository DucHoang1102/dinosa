<?php 
namespace App\functions;

use DB;

/*
|--------------------------------------------------------------------------
| ProductHandling
|--------------------------------------------------------------------------
|
| Xử lý chung cho sản phẩm
|
*/
class ProductHandling
{
	// Phân tích tách chuỗi sản phẩm
	public static function parser($subject)
	{
		$subject = strtoupper(trim($subject));
		$re      = '/^((A|D)[0-9]*[A-Z]?)(CT1|CT2|DT1|DT2|AK1|AK2|AK3)\((S|M|L|XL|XXL)\)$/';
		$prices  = [
    		'ACT1' => 150000, 'ACT2' => 150000,
    		'ADT1' => 160000, 'ADT2' => 160000,
    		'DCT1' => 125000, 'DCT2' => 125000,
    		'DDT1' => 125000, 'DDT2' => 125000,
    		'AAK1' => 250000, 'AAK2' => 250000,
    		'AAK3' => 250000,
    	];

		if (preg_match($re, $subject, $matches)) {
			return [
				'name_category_product' => $matches[2],
				'id_image_print'        => $matches[1],
				'name_embryo_tshirt'    => $matches[3],
				'name'                  => $matches[0],
				'size'                  => $matches[4],
				'price'                 => $prices[$matches[2].$matches[3]]
			];
		}
		else return [];
	}

	// Lấy sản phẩm theo id_orders và id_product
	public static function get($id_orders='0')
	{
		$products = DB::table('products_of_orders')
			    		->where([
			                ['id_orders', $id_orders]
			            ])
			    		->select('products_of_orders.id', 'products_of_orders.name', 'products_of_orders.price', 'products_of_orders.id_image_print')
			            ->orderBy('products_of_orders.created_at', 'asc')
			    		->get();

		if (!empty($products)) {
			foreach ($products as $product) {
	            $product->url_image = self::getUrlImage($product->id_image_print);
	        }
	        return $products;
		}
		else return [];
	}

	// Lấy link ảnh sản phẩm theo id_image
	public static function getUrlImage($id_image='0') {
        $url_image = DB::table('image_print')
                        ->select('src_f_a3')
                        ->where('id', $id_image)
                        ->first();

        if (!empty($url_image)){
            return $url_image;
        }
        else return '';
    }

    // Tạo mới sản phẩm
    public static function create()
    {
    	
    }

    // Xóa sản phẩm
    public static function delete()
    {

    }
}

