<?php 
namespace App\functions;

use DB;
use App\functions\helpers\RandomId;
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
		$re      = '/^((A|D)[0-9]*[A-Z]?)(CT1|CT2|DT1|DT2|AK1|AK2|AK3|BL1)\((S|M|L|XL|XXL)\)$/';
		$prices  = [
    		'ACT1' => 150000, 'ACT2' => 150000,
    		'ADT1' => 160000, 'ADT2' => 160000,
    		'DCT1' => 129500, 'DCT2' => 129500,
    		'DDT1' => 129500, 'DDT2' => 129500,
    		'AAK1' => 250000, 'AAK2' => 250000,
    		'AAK3' => 250000, 'ABL1' => 150000,
    	];

		preg_match($re, $subject, $matches);

		return [
			'name_category_product' => isset( $matches[2] ) ? $matches[2] : '',
			'id_image_print'        => isset( $matches[1] ) ? $matches[1] : '',
			'name_embryo_tshirt'    => isset( $matches[3] ) ? $matches[3] : '',
			'name'                  => isset( $matches[0] ) ? $matches[0] : '',
			'size'                  => isset( $matches[4] ) ? $matches[4] : '',
			'price'                 => isset( $prices[ $matches[2].$matches[3] ] ) ? $prices[ $matches[2].$matches[3] ] : '',
		];
	}

	// Lấy sản phẩm theo id_orders 
	public static function get($id_orders='0')
	{
		$products = DB::table('products_of_orders')
			    		->where([
			                ['id_orders', $id_orders]
			            ])
			    		->select(
                            'products_of_orders.id', 
                            'products_of_orders.name', 
                            'products_of_orders.price', 
                            'products_of_orders.id_image_print', 
                            'products_of_orders.status', 
                            'products_of_orders.size',
                            'products_of_orders.name_embryo_tshirt')
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
	public static function getUrlImage($id_image) {
        $url_image = DB::table('image_print')
                        ->select('url')
                        ->where('id', $id_image)
                        ->first();

        if (!empty($url_image)){
            return $url_image->url;
        }
        else return '';
    }

    // Check sản phẩm tồn kho
    public static function checkInventory($name_product)
    { 
        // Lấy id đơn hàng có các sản phẩm yêu cầu và hiện tại  
        // đang ở shop. Sau đó check đơn hàng đó xem có phải
        // thuộc hàng tồn trả về không
        $products = DB::table('products_of_orders')
                        ->select('id', 'id_orders')
                        ->where([
                            ['name', $name_product],
                            ['status', 1]
                        ])
                        ->get();

        foreach ( $products as $product ) {
            $order = DB::table('orders')
                         ->select('id')
                         ->where([
                               ['id', $product->id_orders],
                               ['id_orders_status', 8]
                           ])
                         ->first();
            
            if ( $order ) {
                // Chuyển trạng thái đơn tồn trong kho
                $result = self::changeStatus($order->id, $product->id, 0);

                if ( $result ) {
                    return $product->id;
                }
            }
        }
    }

    // Chuyển status(trạng thái) của sản phẩm
    // 1: Hàng có mặt tại shop
    // 0: Hàng không ở shop (Mới chưa in, hàng đã chuyển đi,...)
    public static function changeStatus($id_order, $id_product='all', $status) {
        if ( $id_order === 0 ) return false;

        if ($id_product == 'all') {
            $where = [
                ['id_orders', $id_order]
            ];
        }
        else {
            $where = [
                ['id_orders', $id_order],
                ['id',  $id_product],
            ];
        }

        $result = DB::table('products_of_orders')
        			  ->where($where)
        			  ->update(['status' => $status]);
    	return $result;
    }

    // Tạo mới sản phẩm
    public static function create($id_order, $product, $status='0')
    {
    	$id_product = RandomId::get("PO", 10);
        
        $result = DB::table('products_of_orders')->insert([
            'id'                    => $id_product,
            'id_orders'             => $id_order,
            'name_category_product' => $product[ 'name_category_product' ],
            'id_image_print'        => $product[ 'id_image_print'        ],
            'name_embryo_tshirt'    => $product[ 'name_embryo_tshirt'    ],
            'name'                  => $product[ 'name'                  ],
            'size'                  => $product[ 'size'                  ],
            'price'                 => $product[ 'price'                 ],
            'status'                => $status,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now()
        ]);

        if ( $result ) return $id_product;
        else           return false;
    }

    // Xóa sản phẩm
    public static function delete($id_order, $id_product)
    {
    	if ($id_order === 0 || $id_product === 0) return false;
    	
	    $result = DB::table('products_of_orders')
					->select('id')
					->where([
					   [ 'products_of_orders.id_orders', $id_order ],
					   [ 'products_of_orders.id', $id_product ]
					])
					->delete();

		return $result;
    }
}

