<?php

namespace App\Http\Controllers\Traits;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Socialite;

/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/16
 * Time: 下午10:22
 */
trait SocialiteHelper
{
    private $oauthDriver = ['github' => 'github', 'wechat' => 'weixin'];

    public function oauth(Request $request)
    {
        $driver = $request->get('driver');
        $driver = !isset($this->oauthDriver[$driver]) ? 'github' : $this->oauthDriver[$driver];

        if (Auth::check() && Auth::user()->register_source == $driver) {
            return redirect('/');
        }
        return Socialite::driver($driver)->redirect();
    }

    public function callback(Request $request)
    {
        $driver = $request->get('driver');

        if (!isset($this->oauthDriver[$driver]) || Auth::check() && Auth::user()->register_source == $driver) {
            return redirect('/');
        }

        $oauthUser = Socialite::with($this->oauthDriver[$driver])->user();
        $user = User::getByDriver($driver, $oauthUser->id);

        if (Auth::check()) {

        } else {
            if ($user) {
                return $this->loginUser($user);
            }
            return $this->userNotFound($driver, $oauthUser);
        }
    }
}
