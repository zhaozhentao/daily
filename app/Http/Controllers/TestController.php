<?php

namespace App\Http\Controllers;

use Daily\Notification\Mention;

class TestController extends Controller
{
    public function test(Mention $mentionParser)
    {
        $mentionParser->parse("@Laravel @黄老吉 百年好合");
        var_dump($mentionParser->usernames);
    }
}
