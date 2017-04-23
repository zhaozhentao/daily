<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'body',
        'source',
        'user_id',
        'topic_id',
        'body_original',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
