<?php
namespace App\functions\helpers;

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

class ConvertMoney
{
    public static function get ($number) {
        $result = "";
        $number   = strrev($number);
        $div    = 0;

        for ($i=0; $i < strlen($number) ; $i++) {
            if ($div == 3) {
                $result = ',' . $result;
                $div = 0;
            }

            $result = $number[$i] . $result;

            $div+=1;
        }

        return $result;
    }
}