<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'title',
        'body',
        'excerpt',
        'is_draft',
        'source',
        'body_original',
        'user_id',
        'category_id',
        'created_at',
        'updated_at'
    ];

    public static function makeExcerpt($body)
    {
        $html = $body;
        $excerpt = trim(preg_replace('/\s\s+/', ' ', strip_tags($html)));
        return str_limit($excerpt, 200);
    }

    public function getCreatedAtAttribute($date)
    {
        return date("d/m/Y", strtotime($date));;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
