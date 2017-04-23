<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\SocialiteHelper;
use App\Http\Requests\StoreUserRequest;
use Daily\Listeners\UserCreatorListener;
use Illuminate\Support\Facades\Log;
use Session;
use Flash;
use Auth;

class AuthController extends Controller implements UserCreatorListener
{
    use SocialiteHelper;

    public function login()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        Flash::success(lang('Operation succeeded.'));
        return redirect()->route('home');
    }

    public function create()
    {
        if (!Session::has('oauthData')) {
            return redirect()->route('login');
        }

        $oauthData = array_merge(Session::get('oauthData'), Session::get('_old_input', []));
        return view('auth.signup', compact('oauthData'));
    }

    public function store(StoreUserRequest $request)
    {
        if (!Session::has('oauthData')) {
            return redirect(route('login'));
        }

        $oauthUser = array_merge(Session::get('oauthData'), $request->only('name', 'email', 'password'));
        $userData = array_only($oauthUser, array_keys($request->rules()));
        $userData['register_source'] = $oauthUser['driver'];

        return app(\Daily\Creators\UserCreator::class)->create($this, $userData);
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

    public function loginUser($user)
    {
        Auth::loginUsingId($user->id);
        Session::forget('oauthData');
        Flash::success(lang('Login Successfully.'));
        return redirect('/');
    }

    #----------------  UserCreatorListener -------------------
    public function userValidationError($errors)
    {

    }

    public function userCreated($user)
    {
        Auth::login($user, true);
        Session::forget('oauthData');
        Flash::success(lang('Congratulations and Welcome!'));
        return redirect('/');
    }
}
