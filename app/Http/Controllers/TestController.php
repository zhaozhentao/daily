<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;

class TestController extends Controller
{
    public function test()
    {
        DB::listen(function ($sql) {
//            var_dump($sql);
        });
        DB::enableQueryLog();

        User::getByDriver('github', '1');

        return response()->json(DB::getQueryLog());
    }
}
