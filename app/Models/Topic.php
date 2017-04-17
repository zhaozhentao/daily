<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function getCreatedAtAttribute($date)
    {
        return date("d/m/Y", strtotime($date));;
    }
}
