<?php

namespace App\Models;

use App\Models\Traits\UserAvatarHelper;
use App\Models\Traits\UserSocialiteHelper;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laracasts\Presenter\PresentableTrait;

class User extends Authenticatable
{
    use Notifiable, UserSocialiteHelper, UserAvatarHelper;

    protected $guarded = ['id', 'is_banned'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    use PresentableTrait;
    public $presenter = 'Daily\Presenters\UserPresenter';
}
