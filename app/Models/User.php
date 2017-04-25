<?php

namespace App\Models;

use App\Models\Traits\UserAvatarHelper;
use App\Models\Traits\UserSocialiteHelper;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laracasts\Presenter\PresentableTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, UserSocialiteHelper, UserAvatarHelper;
    use EntrustUserTrait;

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

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
