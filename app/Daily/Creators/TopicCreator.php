<?php
/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/19
 * Time: 下午3:33
 */

namespace Daily\Creators;

use App\Models\Topic;
use Auth;
use Daily\Core\CreatorListener;
use Daily\Markdown\Markdown;
use Illuminate\Support\MessageBag;

class TopicCreator
{
    public function create(CreatorListener $listener, $data)
    {
        if ($this->isDuplicate($data)) {
            $errorMessages = new MessageBag;
            $errorMessages->add('duplicated', '请不要发布重复内容。');
            $listener->createFailed($errorMessages);
            return;
        }

        $data['user_id'] = Auth::id();
        $markdown = new Markdown;
        $data['body_original'] = $data['body'];
        $data['body'] = $markdown->convertMarkdownToHtml($data['body']);
        $data['excerpt'] = Topic::makeExcerpt($data['body']);

        $data['source'] = get_platform();

        $topic = Topic::create($data);
        if (!$topic) {
            return $listener->createFailed($topic->getErrors());
        }
        Auth::user()->increment('topic_count', 1);

        return $listener->createSuccess($topic);
    }

    private function isDuplicate($data)
    {
        $last_topic = Topic::where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->first();

        return count($last_topic) && strcmp($last_topic->title, $data['title']) === 0;
    }
}
