<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\SocialiteHelper;
use Session;

class AuthController extends Controller
{
    use SocialiteHelper;

    public function login()
    {
        return view('auth.login');
    }

    public function create()
    {
        if (!Session::has('oauthData')) {
            return redirect()->route('login');
        }

        $oauthData = array_merge(Session::get('oauthData'), Session::get('_old_input', []));
        return view('auth.signup', compact('oauthData'));
    }

    public function userNotFound($driver, $oauthUser)
    {
        if ($driver == 'github') {
            $oauthData['image_url'] = $oauthUser->user['avatar_url'];
            $oauthData['github_id'] = $oauthUser->user['id'];
            $oauthData['github_url'] = $oauthUser->user['url'];
            $oauthData['github_name'] = $oauthUser->nickname;
            $oauthData['name'] = $oauthUser->user['name'];
            $oauthData['email'] = $oauthUser->email;
        } else if ($driver == 'wechat') {

        }
        $oauthData['driver'] = $driver;
        Session::put('oauthData', $oauthData);
        return redirect(route('signup'));
    }
}
