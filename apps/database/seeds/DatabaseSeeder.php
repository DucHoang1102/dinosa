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
        //$this->call(OrdersStatusSeeder::class);
        //$this->call(CategoryProductSeeder::class);
        //$this->call(EmbryoTshirtSeeder::class);
        $this->call(ImagePrintSeeder::class);
        //$this->call(CustomersSeeder::class);
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
			['name' => 'Chuyển thành công', 'description' => ''],
			['name' => 'Chuyển thất bại', 'description' => ''],
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
			['name' => 'A', 'description' => 'Áo thun đôi', 'price' => '0000'],
			['name' => 'D', 'description' => 'Áo game',   'price' => '0000'],
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
				'deal_history' => '', 
				"created_at"   => \Carbon\Carbon::now(),
	            "updated_at"   => \Carbon\Carbon::now(),
			]);
		};
	}
}