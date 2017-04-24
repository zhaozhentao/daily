<?php
/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/22
 * Time: 下午11:10
 */

namespace Daily\Creators;

use App\Models\Reply;
use App\Models\Topic;
use Carbon\Carbon;
use Daily\Core\CreatorListener;
use Auth;
use Daily\Markdown\Markdown;
use Daily\Notification\Mention;

class ReplyCreator
{
    protected $mentionParser;

    public function __construct(Mention $mentionParser)
    {
        $this->mentionParser = $mentionParser;
    }

    public function create(CreatorListener $listener, $data)
    {
        if ($this->isDuplicateReply($data)) {
            $errorMessages = new MessageBag;
            $errorMessages->add('duplicated', '请不要发布重复内容。');
            return $listener->createFailed($errorMessages);
        }

        $data['user_id'] = Auth::id();
        $data['body'] = $this->mentionParser->parse($data['body']);

        $markdown = new Markdown;
        $data['body_original'] = $data['body'];
        $data['body'] = $markdown->convertMarkdownToHtml($data['body']);

        $data['source'] = get_platform();

        $reply = Reply::create($data);
        if (!$reply) {
            return $listener->createFailed($reply->getErrors());
        }

        $topic = Topic::find($data['topic_id']);
        $topic->last_reply_user_id = Auth::id();
        $topic->reply_count++;
        $topic->updated_at = Carbon::now()->toDateTimeString();
        $topic->save();

        Auth::user()->increment('reply_count', 1);

        return $listener->createSuccess($reply);
    }

    private function isDuplicateReply($data)
    {
        $last_reply = Reply::where('user_id', Auth::id())
            ->where('topic_id', $data['topic_id'])
            ->orderBy('id', 'desc')
            ->first();

        return count($last_reply) && strcmp($last_reply->body_original, $data['body']) === 0;
    }
}
