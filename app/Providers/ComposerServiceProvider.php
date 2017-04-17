<?php
/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/17
 * Time: 下午9:30
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with('currentUser', Auth::user());
        });
    }
}
