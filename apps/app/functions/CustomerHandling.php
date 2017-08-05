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
	public static function existsCustomer($phone='000')
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
	public static function create($colum='0', $value='') 
	{
		$id_customer = RandomId::get("CT", 10);
        $result      = DB::table('customers')->insert([
            'id'         => $id_customer,
            $colum       => $value,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        if ($result) return $id_customer;
        else         return false;
	}

	// Update thông tin khách hàng
	public static function update($id_customer='000', $colum='0', $value='')
	{
		$result =DB::table('customers')
                    ->where('id', $id_customer)
                    ->update([
                        $colum => $value
                    ]);

        return $result;
	}

	// Xóa khách hàng
	public static function delete($id_customer='000')
	{
		$result = DB::table('customers')
			          ->where('customers.id', $id_customer)
			          ->delete();

		return $result;
	}

}