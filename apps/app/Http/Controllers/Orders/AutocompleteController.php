<?php

namespace App\Http\Controllers\orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\functions\CustomerHandling;

class AutocompleteController extends Controller
{
    function getPhone(Request $request)
    {
        $phoneInput = isset($request->phoneInput) ? trim($request->phoneInput) : "";

        if (strlen($phoneInput) < 6) return [];

        $phones = DB::table('customers')
                    ->select('phone', 'name')
                    ->where('phone', 'like', $phoneInput.'%')
                    ->offset(0)
                    ->limit(5)
                    ->get();

        if (CustomerHandling::existsCustomer($phoneInput)) return [];
        else return $phones;
    }
}
