<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(CategoryProductSeeder::class); //1
        $this->call(OrdersStatusSeeder::class);    //2
        $this->call(EmbryoTshirtSeeder::class);    //3
        $this->call(ImagePrintSeeder::class);      //4
        //$this->call(CustomersSeeder::class);       //5
        //$this->call(OrdersSeeder::class);          //6
        //$this->call(ProductsofOrdersSeeder::class);  //7
    }
}

// Table: embryo_tshirt (Phôi áo)
class EmbryoTshirtSeeder extends Seeder
{
	public function run()
	{
		$datas = [
			['name' => 'CT1', 'description' => 'Áo thun ngắn tay trắng'],
			['name' => 'CT2', 'description' => 'Áo thun ngắn tay đen'],
			['name' => 'DT1', 'description' => 'Áo thun dài tay trắng'],
			['name' => 'DT2', 'description' => 'Áo thun dài tay đen'],
			['name' => 'AK1', 'description' => 'Áo khoác trắng có mũ'],
			['name' => 'AK2', 'description' => 'Áo khoác xám có mũ'],
			['name' => 'AK3', 'description' => 'Áo khoác bóng rổ (trắng tay đen)'],
			['name' => 'BL', 'description'  => 'Balo dây rút'],
		];

		foreach ($datas as $data) {
			DB::table('embryo_tshirt')->insert([
				'name'        => $data['name'],
				'description' => $data['description'],
				"created_at"  => \Carbon\Carbon::now(),
	            "updated_at"  => \Carbon\Carbon::now(),
			]);
		};
	}
}

// Table: orders_status
class OrdersStatusSeeder extends Seeder
{
	public function run()
	{
		$datas = [
			['name' => 'Đơn mới'],
			['name' => 'Đã xác nhận'],
			['name' => 'Đã in xong'],
			['name' => 'Đang chuyển'],
			['name' => 'Chuyển thành công chưa thanh toán'],
			['name' => 'Chuyển thành công đã thanh toán'],
			['name' => 'Chuyển thất bại chưa trả hàng'],
			['name' => 'Chuyển thất bại đã trả hàng'],
			['name' => 'Thùng rác'],
		];

		foreach ($datas as $data) {
			DB::table('orders_status')->insert([
				'name'        => $data['name'],
				"created_at"  => \Carbon\Carbon::now(),
	            "updated_at"  => \Carbon\Carbon::now(),
			]);
		};
	}
}

// Table: category_product:  Danh mục sản phẩm
class CategoryProductSeeder extends Seeder
{
	public function run()
	{
		$datas = [
			['name' => 'D', 'description' => 'Áo đôi'],
			['name' => 'A', 'description' => 'Áo game'],
		];

		foreach ($datas as $data) {
			DB::table('category_product')->insert([
				'name'        => $data['name'],
				'description' => $data['description'],
				"created_at"  => \Carbon\Carbon::now(),
	            "updated_at"  => \Carbon\Carbon::now(),
			]);
		};
	}
}

// Table: image_print:  Mã ảnh
class ImagePrintSeeder extends Seeder
{
	public function run()
	{
		$c_product = ['A', 'D'];
		$images = range(1,251);
		$images_sub = ['', 'A', 'B', 'C', 'D', 'E', 'F'];
		foreach ($c_product as $p) {
			foreach ($images as $i) {
				foreach ($images_sub as $i_s) {
					DB::table('image_print')->insert([
						'id'         => $p.$i.$i_s,
						'url'        => '/upload/d-p-1234/f-a3/' . $p.$i.$i_s . '.png',
						"created_at" => \Carbon\Carbon::now(),
			            "updated_at" => \Carbon\Carbon::now(),
					]);
				};
			};
		};
	}
}

// Table: customers
class CustomersSeeder extends Seeder
{
	public function run()
	{
		$datas = [
			['name' => 'Nguyễn Văn A',       'phone' => '0972982082', 'address' => 'Từ Xá - Đoàn Kết - Thanh Miện - Hải Dương'],
			['name' => 'Nguyễn Văn Bân',     'phone' => '01683044062', 'address' => 'Cống Cái Tắt, Sở Dầu, Hải Phòng'],
			['name' => 'Nguyễn Hai Văn Mà',  'phone' => '01683234362', 'address' => 'Cống Cái Tắt, Sở dfdfsdDầu, Hải Phòng'],
			['name' => 'Nguyễn Văn Tài Em',  'phone' => '0168304462', 'address' => 'Cống Cái Tắt, Sở Dầu, Hải Phòng'],
			['name' => 'Nguyễn Chỉ Thiên',   'phone' => '0168334233', 'address' => 'Cống Cái fdfdTắt, Sở Dầu, Hải Phòng'],
			['name' => 'Nguyễn Văn F',       'phone' => '0133435533', 'address' => 'Cống Cái Tắt, Sở Dầu, Hải Phòng'],
			['name' => 'Trần thị Ai',        'phone' => '0934234644', 'address' => 'Cống Cái Tắt, Sở Dầudfdf, Hải Phòng'],
			['name' => 'Nguyễn Văn Lào Cai', 'phone' => '0165372464', 'address' => 'Cống Cái Tắt, Sở Dầu, Hải dfdfPhòng'],
			['name' => 'Vũ Thị Thu',         'phone' => '4544344342', 'address' => 'Cống Cái Tắt, Sởđvccv Dầu, Hải Phdfsdòng'],
			['name' => 'Nguyễn Văn E',       'phone' => '4546643234', 'address' => 'Cống Cái Tắt, Sở zxcxDầu, Hải xcxzPhòng'],
			['name' => 'Nguyễn Văn K',       'phone' => '4543344544', 'address' => 'Cống Cái Tắt, Sởxcxz Dầu, Hải Phxcxcòng'],
			['name' => 'Trần Văn Bi',        'phone' => '2334333343', 'address' => 'Cống Cái Tắt, Sở Dầxcxzu, Hải Phòng'],
			['name' => 'Nguyễn Văn F',       'phone' => '01683044062', 'address' => 'Cống Cxcxcái Tắt, Sở Dầu, Hải Phòng'],
			['name' => 'Trần Thị Tiền',      'phone' => '01683044062', 'address' => 'Cống Cxcxái Tắt, Sở Dầu, Hải Phòng'],
			['name' => 'Nguyễn Văn Test',    'phone' => '01683044062', 'address' => 'Cống Cái Tắt, Sở Dầu, Hải Phòxcxcxng'],
			['name' => 'Nguyễn Văn BACDE',   'phone' => '01683044062', 'address' => 'Cống Cái Txcxcxắt, Sở xxcxDầu, Hải Phòng'],
			['name' => 'Nguyễn Văn FFFFF',   'phone' => '01683044062', 'address' => 'Cống Cxcxi Tắt, Sở Dầu, Hải Phònxcxcxg'],
			['name' => 'Nguyễn Văn DDDĐ',    'phone' => '01683044062', 'address' => 'Cống Cácxci Tắt, Sởxcx Dầu, Hải Phxcxcxcòng'],
			['name' => 'Nguyễn Văn EEEEE',   'phone' => '01683044062', 'address' => 'Cống Cáxcxi Tắt, Sởxcx Dầu, Hải Phcxcxcòng'],
		];

		foreach ($datas as $data) {
			DB::table('customers')->insert([
				'name'         => $data['name'],
				'phone'        => $data['phone'],
				'address'      => $data['address'],
				'noted'        => '', 
				"created_at"   => \Carbon\Carbon::now(),
	            "updated_at"   => \Carbon\Carbon::now(),
			]);
		};
	}
}

// Table: orders
class OrdersSeeder extends Seeder
{
	public function run()
	{
		$datas = [
			['id_post' => 'VN1234', 'id_customers' => '1', 'id_orders_status' => '1'],
			['id_post' => 'VN5678', 'id_customers' => '2', 'id_orders_status' => '1'],
		];

		foreach ($datas as $data) {
			DB::table('orders')->insert([
				'id_post'          => $data['id_post'],
				'id_customers'     => $data['id_customers'],
				'id_orders_status' => $data['id_orders_status'],
				"created_at"       => \Carbon\Carbon::now(),
	            "updated_at"       => \Carbon\Carbon::now(),
			]);
		};
	}
}

// Table: products_of_orders
class ProductsofOrdersSeeder extends Seeder
{
	public function run()
	{
		$datas = [
			['id_orders' => '1', 'name_category_product' => 'A', 'name_image_print' => 'A7', 'name_embryo_tshirt' => 'CT2','name' => 'A7CT2', 'size' => 'S', 'money' => '150,000', 'status'=>'0'],
			['id_orders' => '2', 'name_category_product' => 'A', 'name_image_print' => 'A90', 'name_embryo_tshirt' => 'CT1','name' => 'A90CT1', 'size' => 'XL', 'money' => '150,000', 'status'=>'0'],
		];

		foreach ($datas as $data) {
			DB::table('products_of_orders')->insert([
				'id_orders'             => $data['id_orders'],
				'name_category_product' => $data['name_category_product'],
				'name_image_print'      => $data['name_image_print'],
				'name_embryo_tshirt'    => $data['name_embryo_tshirt'],
				'name'                  => $data['name'],
				'size'                  => $data['size'],
				'money'                 => $data['money'],
				'status'                => $data['status'],
				"created_at"            => \Carbon\Carbon::now(),
	            "updated_at"            => \Carbon\Carbon::now(),
			]);
		};
	}
}