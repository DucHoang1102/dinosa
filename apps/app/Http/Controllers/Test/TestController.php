<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Orders\BaseController;

class TestController extends BaseController
{
    function index () {
    	return view('test');
    }
}
