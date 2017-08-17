<?php
namespace App\functions;

use DB;
use App\functions\helpers\RandomId;

/*
|--------------------------------------------------------------------------
| CustomerHandling
|--------------------------------------------------------------------------
|
| Xử lý chung cho khách hàng
|
*/
class CustomerHandling
{
	// Check Khách hàng bằng phone
	public static function existsCustomer($phone)
	{
		$id = DB::table('customers')
			      ->select('customers.id')
			      ->where('phone', $phone)
			      ->first();
		if (!empty($id)) return $id->id;
		else            return false;
	}

	// Lấy thông tin khách hàng
	public static function getInfoCustomer($id_customer=0)
	{
		$result = DB::table('customers')
					  ->select('name', 'phone', 'address')
					  ->where('customers.id', $id_customer)
					  ->first();
		if (!empty($result)) {
			return $result;
		}
		else {
			return false;
		}
	}

	// Thêm khách hàng
	public static function create($name='', $phone='', $address='') 
	{
		$id_customer = RandomId::get("CT", 10);
        $result      = DB::table('customers')->insert([
            'id'         => $id_customer,
            'name'       => $name,
            'phone'      => $phone,
            'address'    => $address,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        if ($result) return $id_customer;
        else         return false;
	}

	// Update thông tin khách hàng
	public static function update($id_customer, $name='', $phone='', $address='')
	{
		$result =DB::table('customers')
                    ->where('id', $id_customer)
                    ->update([
                        'name'       => $name,
                        'phone'      => $phone,
                        'address'    => $address,
                        'updated_at' => \Carbon\Carbon::now()
                    ]);

        return $result;
	}

	// Kiểm tra xem có orders không
    public static function haveOrders($id_customer, $id_orders_status=[])
    {
        $check = DB::table('orders')
                    ->select('id_customers')
                    ->where('id_customers', $id_customer)
                    ->WhereIn('id_orders_status', $id_orders_status)
                    ->first();
        return $check;
    }

	// Dọn dẹp khách hàng
	public static function clear()
	{
		$customers = DB::table('customers')
						->select('id')
						->where('name', '')
						->orWhere('phone', '')
						->orWhere('address', '')
						->get();

		foreach ($customers as $customer) {
			$check = self::haveOrders($customer->id, [1,2,3,4,5,6,7,8,9]);

			if (empty($check)) self::delete($customer->id);
		}
	}

	// Xóa khách hàng kèm theo thông số status orders
	public static function delete($id_customer)
	{
		$result = DB::table('customers')
			          ->where('customers.id', $id_customer)
			          ->delete();
		return $result;	
	}

}