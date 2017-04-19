<?php

namespace Daily\Markdown;

use Parsedown;
use League\HTMLToMarkdown\HtmlConverter;

use Purifier;

/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/19
 * Time: 下午3:51
 */
class Markdown
{
    public function __construct()
    {
        $this->htmlParser = new HtmlConverter(['header_style' => 'atx']);
        $this->markdownParser = new Parsedown();
    }

    public function convertMarkdownToHtml($markdown)
    {
        $convertedHmtl = $this->markdownParser->setBreaksEnabled(true)->text($markdown);
        $convertedHmtl = Purifier::clean($convertedHmtl, 'user_topic_body');
        $convertedHmtl = str_replace("<pre><code>", '<pre><code class=" language-php">', $convertedHmtl);

        return $convertedHmtl;
    }
}
