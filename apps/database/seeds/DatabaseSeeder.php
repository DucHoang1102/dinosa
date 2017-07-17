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
    	//$this->call(CategoryProductSeeder::class); //1
        //$this->call(OrdersStatusSeeder::class);    //2
        //$this->call(EmbryoTshirtSeeder::class);    //3
        //$this->call(ImagePrintSeeder::class);      //4
        //$this->call(CustomersSeeder::class);       //5
        //$this->call(OrdersSeeder::class);          //6
        $this->call(ProductsofOrdersSeeder::class);  //7
    }
}

// Table: embryo_tshirt (Phôi áo)
class EmbryoTshirtSeeder extends Seeder
{
	public function run()
	{
		$datas = [
			['name' => 'CT1', 'description' => 'Áo thun ngắn tay trắng', 'price' => '25000'],
			['name' => 'CT2', 'description' => 'Áo thun ngắn tay đen',   'price' => '25000'],
			['name' => 'DT1', 'description' => 'Áo thun dài tay trắng',  'price' => '30000'],
			['name' => 'DT2', 'description' => 'Áo thun dài tay đen',    'price' => '30000'],
			['name' => 'AK2', 'description' => 'Áo khoác xám có mũ',     'price' => '85000'],
			['name' => 'AK3', 'description' => 'Áo khoác trắng tay đen', 'price' => '85000'],
		];

		foreach ($datas as $data) {
			DB::table('embryo_tshirt')->insert([
				'name'        => $data['name'],
				'description' => $data['description'],
				'price'       => $data['price'],
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
			['name' => 'Đơn mới', 'description' => ''],
			['name' => 'Đã xác nhận', 'description' => ''],
			['name' => 'Đã in xong', 'description' => ''],
			['name' => 'Đang chuyển', 'description' => ''],
			['name' => 'Chuyển thành công chưa thanh toán', 'description' => ''],
			['name' => 'Chuyển thành công đã thanh toán', 'description' => ''],
			['name' => 'Chuyển thất bại chưa trả hàng', 'description' => ''],
			['name' => 'Chuyển thất bại đã trả hàng', 'description' => ''],
			['name' => 'Thùng rác', 'description' => ''],
		];

		foreach ($datas as $data) {
			DB::table('orders_status')->insert([
				'name'        => $data['name'],
				'description' => $data['description'],
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
			['name' => 'D', 'description' => 'Áo đôi', 'price' => '0000'],
			['name' => 'A', 'description' => 'Áo game',   'price' => '0000'],
		];

		foreach ($datas as $data) {
			DB::table('category_product')->insert([
				'name'        => $data['name'],
				'description' => $data['description'],
				'price'       => $data['price'], 
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
		$images = range(1,251);

		foreach ($images as $image) {
			DB::table('image_print')->insert([
				'name'                  => 'A'.$image,
				'src'                   => '',
				'description'           => '',
				'name_category_product' => 'A',
				'price'                 => '0', 
				"created_at"            => \Carbon\Carbon::now(),
	            "updated_at"            => \Carbon\Carbon::now(),
			]);
		};

		foreach ($images as $image) {
			DB::table('image_print')->insert([
				'name'                  => 'D'.$image,
				'src'                   => '',
				'description'           => '',
				'name_category_product' => 'D',
				'price'                 => '0', 
				"created_at"            => \Carbon\Carbon::now(),
	            "updated_at"            => \Carbon\Carbon::now(),
			]);
		};
	}
}

// Table: customers
class CustomersSeeder extends Seeder
{
	public function run()
	{
		$datas = [
			['name' => 'Nguyễn Văn A', 'phone' => '0972982082', 'address' => 'Từ Xá - Đoàn Kết - Thanh Miện - Hải Dương'],
			['name' => 'Nguyễn Văn B', 'phone' => '01683044062', 'address' => 'Cống Cái Tắt, Sở Dầu, Hải Phòng'],
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
			['id_orders' => '1', 'name_category_product' => 'A', 'name_image_print' => 'A7', 'name_embryo_tshirt' => 'CT2','name' => 'A7CT2', 'size' => 'S', 'status'=>'0'],
			['id_orders' => '2', 'name_category_product' => 'A', 'name_image_print' => 'A90', 'name_embryo_tshirt' => 'CT1','name' => 'A90CT1', 'size' => 'XL', 'status'=>'0'],
		];

		foreach ($datas as $data) {
			DB::table('products_of_orders')->insert([
				'id_orders'             => $data['id_orders'],
				'name_category_product' => $data['name_category_product'],
				'name_image_print'      => $data['name_image_print'],
				'name_embryo_tshirt'    => $data['name_embryo_tshirt'],
				'name'                  => $data['name'],
				'size'                  => $data['size'],
				'status'                => $data['status'],
				"created_at"            => \Carbon\Carbon::now(),
	            "updated_at"            => \Carbon\Carbon::now(),
			]);
		};
	}
}