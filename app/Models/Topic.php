<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Laracasts\Presenter\PresentableTrait;

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

    use PresentableTrait;
    protected $presenter = 'Daily\Presenters\TopicPresenter';

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

    public function getRepliesWithLimit($limit = 30)
    {
        $pageName = 'page';

        $latest_page = is_null(\Input::get($pageName)) ? ceil($this->reply_count / $limit) : 1;

        return $this->replies()
            ->orderBy('created_at', 'asc')
            ->with('user')
            ->paginate($limit, ['*'], $pageName, $latest_page);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appends()
    {
        return $this->hasMany(Append::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
