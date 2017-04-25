<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Auth;
use DB;

class TestController extends Controller
{
    public function test()
    {
        var_dump(Reply::find(6)->votes()->updateOrCreate(['user_id' => Auth::id()], ['is' => 'downvote', 'user_id' => Auth::id()]));
    }
}
