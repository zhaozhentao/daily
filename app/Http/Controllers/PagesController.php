<?php

namespace App\Http\Controllers;

use App\Models\User;

class PagesController extends Controller
{
    public function home()
    {
        $topics = User::find(1)->topics()->where('is_blocked', 'no')->orderBy('created_at', 'desc')->paginate(20);

        return view('pages.home', compact('topics'));
    }

    public function about()
    {
        return 'about';
    }
}
