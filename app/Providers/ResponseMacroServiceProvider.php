<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseMacroServiceProvider extends ServiceProvider
{
    
    /**
     * アプリケーションのレスポンスマクロ登録
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('xml', function($items, $status = 200, array $header = [], $xml = null)
        {
            // set up the document
            $xml = new \XmlWriter();
            $xml->openMemory();
            $xml->setIndent(true);
            $xml->startDocument('1.0', 'UTF-8');

            // <rss--->
            $xml->startElement('appinformation');

            
            foreach ($items as $key => $item) {
                $xml->startElement('ksinfo');
                {
                    $xml->writeElement('title', $item->title);
                    $xml->writeElement('link', route('items.messages.feed', ['item' => $item]));
                    $xml->writeElement('date', $item->format_date());
                }
                $xml->endElement();
            }
            
            // ----appinforamation
            $xml->endElement();

            if (empty($header)) {
                $header['Content-Type'] = 'application/xml';
            }

            return Response::make($xml->outputMemory(true), $status, $header);
        });


        Response::macro('xml_messages', function($messages, $status = 200, array $header = [], $xml = null)
        {
            $xml = new \XmlWriter();
            $xml->openMemory();
            $xml->setIndent(true);
            $xml->startDocument('1.0', 'UTF-8');

            // <list-index>
            $xml->startElement('list-index');
            $xml->writeElement('title', 'ユーザーサポート情報');
            $xml->writeElement('linkbase', 'http://aok-net.jp/mysupport/service/info');
            
            foreach ($messages as $key => $message) {
                $xml->startElement('item');
                {
                    $xml->writeElement('title', $message->title);
                    $xml->writeElement('category', $message->category);                        
                    $xml->writeElement('type', $message->type);
                    $xml->startElement('description');
                        $xml->writeCData($message->description);
                    $xml->endElement();
                }
                $xml->endElement();
            }
            
            // </list-index>
            $xml->endElement();

            if (empty($header)) {
                $header['Content-Type'] = 'application/xml';
            }

            return Response::make($xml->outputMemory(true), $status, $header);
        });


        // MySupport用
        Response::macro('xml_user_support', function($messages, $status = 200, array $header = [], $xml = null)
        {
            $xml = new \XmlWriter();
            $xml->openMemory();
            $xml->setIndent(true);
            $xml->startDocument('1.0', 'UTF-8');

            // <list-index>
            $xml->startElement('list-index');
            $xml->writeElement('title', 'ユーザーサポート情報');
            $xml->writeElement('linkbase', 'http://aok-net.jp/mysupport/service/info');
            
            foreach ($messages as $key => $message) {
                $xml->startElement('item');
                {
                    $xml->writeElement('title', $message->title." ". $message->published_at_jp());
                    $xml->writeElement('category', $message->category." ". $message->published_at_jp());
                    $xml->writeElement('type', $message->type);
                    $xml->startElement('description');
                        $formated_html = nl2br($message->description);
                        $content_body = "<h1>{$message->category}</h1><hr><p>{$formated_html}</p>";
                        $xml->writeCData( $content_body );
                    $xml->endElement();
                }
                $xml->endElement();
            }
            
            // </list-index>
            $xml->endElement();

            if (empty($header)) {
                $header['Content-Type'] = 'application/xml';
            }

            return Response::make($xml->outputMemory(true), $status, $header);
        });

        // RSSフィード（Web、RSSリーダー用）
        Response::macro('xml_user_support_rss', function($messages, $status = 200, array $header = [], $xml = null)
        {
            $link_php = "http://www.aok-net.com/service/mysupportlist.php?title=";

            $xml = new \XmlWriter();
            $xml->openMemory();
            $xml->setIndent(true);
            $xml->startDocument('1.0', 'UTF-8');

            // <list-index>
            $xml->startElement('rss');
            $xml->writeAttribute('version','2.0');
            $xml->startElement('channel');
            $xml->writeElement('title', 'ユーザーサポート情報');
            $xml->writeElement('link', 'http://aok-net.jp/mysupport/service/info');
            $xml->writeElement('description', 'ユーザーサポート情報');
            $xml->writeElement('language', 'ja');
            
            foreach ($messages as $key => $message) {
                $xml->startElement('item');
                {
                    $xml->writeElement('title', $message->title);
                    $xml->startElement('description');
                        $formated_html = nl2br($message->description);
                        $content_body = "<h1>{$message->category}</h1><hr><p>{$formated_html}</p>";
                        $xml->writeCData( $content_body );
                    $xml->endElement();
                    $xml->writeElement('pubDate', $message->pubDate());
                    $xml->writeElement('link', $link_php. $message->title);
                }
                $xml->endElement();
            }
            
            // </channel>
            $xml->endElement();
            // </rss>
            $xml->endElement();

            if (empty($header)) {
                $header['Content-Type'] = 'application/xml';
            }

            return Response::make($xml->outputMemory(true), $status, $header);
        });


        // よさこい通信：MySupport用
        Response::macro('yosakoi_xml', function($messages, $status = 200, array $header = [], $xml = null)
        {
            $xml = new \XmlWriter();
            $xml->openMemory();
            $xml->setIndent(true);
            $xml->startDocument('1.0', 'UTF-8');

            // <list-index>
            $xml->startElement('list-index');
            $xml->writeElement('title', 'AOKよさこい通信');
            // $xml->writeElement('linkbase', 'http://aok-net.jp/mysupport/service/info');
            
            foreach ($messages as $key => $message) {
                $xml->startElement('item');
                {
                    $xml->writeElement('title', $message->title." ". $message->published_at_jp());
                    $xml->writeElement('category', $message->category." ". $message->published_at_jp());
                    $xml->writeElement('type', $message->type);
                    $xml->startElement('description');
                        $formated_html = nl2br($message->description);
                        $content_body = "<h1>{$message->category}</h1><hr><p>{$formated_html}</p>";
                        $xml->writeCData( $content_body );
                    $xml->endElement();
                }
                $xml->endElement();
            }
            
            // </list-index>
            $xml->endElement();

            if (empty($header)) {
                $header['Content-Type'] = 'application/xml';
            }

            return Response::make($xml->outputMemory(true), $status, $header);
        });
        
        Response::macro('yosakoi_root_xml', function( $status = 200, array $header = [], $xml = null)
        {
            $xml = new \XmlWriter();
            $xml->openMemory();
            $xml->setIndent(true);
            $xml->startDocument('1.0', 'UTF-8');

            // <list-index>
            $xml->startElement('list-index');
            $xml->startAttribute('xmlns');
            $xml->text('http://www.aok-net.com/list-index/');
            $xml->endAttribute();

            $xml->writeElement('title', 'よさこい通信テキスト版');
            $xml->writeElement('linkbase', 'http://aok-net.jp/mysupport/service');
            
            $xml->startElement('item');
            {
                $xml->writeElement('title', "よさこい通信テキスト版");
                $xml->writeElement('category', "よさこい通信テキスト版");
                $xml->writeElement('link', route('channels.feed', ["draft" => "1"]));
                $xml->writeElement('type', "list");
            }
            $xml->endElement();
            
            // </list-index>
            $xml->endElement();

            if (empty($header)) {
                $header['Content-Type'] = 'application/xml';
            }

            return Response::make($xml->outputMemory(true), $status, $header);
        });

        Response::macro('channel_xml', function($channels, $status = 200, array $header = [], $xml = null)
        {
            $xml = new \XmlWriter();
            $xml->openMemory();
            $xml->setIndent(true);
            $xml->startDocument('1.0', 'UTF-8');

            // <list-index>
            $xml->startElement('list-index');
            $xml->startAttribute('xmlns');
            $xml->text('http://www.aok-net.com/list-index/');
            $xml->endAttribute();

            $xml->writeElement('title', 'よさこい通信テキスト版');
            $xml->writeElement('linkbase', 'http://aok-net.jp/mysupport/service/info');
            
            foreach ($channels as $key => $channel) {
                $xml->startElement('item');
                {
                    $xml->writeElement('title', $channel->title);
                    $xml->writeElement('category', $channel->title);
                    $xml->writeElement('link', route('channels.posts.feed', ['channel' => $channel]));
                    $xml->writeElement('type', "list");
                    
                    // ガイド音声のコントロールをする場合
                    // $xml->startElement('description');
                    // $xml->startAttribute('type');
                    // $xml->text('menuguide');
                    // $xml->endAttribute();
                    // $xml->writeCDATA("hoge");                    
                    // $xml->endElement();
                }
                $xml->endElement();
            }
            
            // </list-index>
            $xml->endElement();

            if (empty($header)) {
                $header['Content-Type'] = 'application/xml';
            }

            return Response::make($xml->outputMemory(true), $status, $header);
        });
        
        Response::macro('post_xml', function($channel, $posts, $status = 200, array $header = [], $xml = null)
        {
            $toDescription = function ($post)
            {
                return
                "<h1>".$post->title."</h1>"
                ."<hr>"
                ."<p>"
                .nl2br($post->content)
                ."</p>";
            };

            $xml = new \XmlWriter();
            $xml->openMemory();
            $xml->setIndent(true);
            $xml->startDocument('1.0', 'UTF-8');

            // <list-index>
            $xml->startElement('list-index');
            $xml->startAttribute('xmlns');
            $xml->text('http://www.aok-net.com/list-index/');
            $xml->endAttribute();

            $xml->writeElement('title', 'よさこい通信テキスト版');
            $xml->writeElement('linkbase', 'http://aok-net.jp/mysupport/service/info');
            
            $desc_all = "";
            foreach ($posts as $key => $post) {
                $xml->startElement('item');
                {
                    $xml->writeElement('title', $post->title);
                    $xml->writeElement('category', $post->title);
                    $xml->writeElement('link', "");
                    $xml->writeElement('type', "description");
                    $xml->startElement('description');
                    $desc = $toDescription($post);
                    $desc_all .= $desc. "<br/>";
                    $xml->writeCData($desc);
                    $xml->endElement();
                }
                $xml->endElement();
            }

            // すべて再生
            $xml->startElement('item');
            {
                $xml->writeElement('title', "すべて再生");
                $xml->writeElement('category', "すべて再生");
                $xml->writeElement('link', "");
                $xml->writeElement('type', "description");
                $xml->startElement('description');
                $xml->writeCData( $desc_all);
                $xml->endElement();
            }
            $xml->endElement();
            
            if (config("app.accept_comments")) {
                // ご意見・ご感想フォーム
                $xml->startElement('item');
                {
                    $xml->writeElement('title', "ご意見・ご要望");
                    $xml->writeElement('category', "ご意見・ご要望");
                    $xml->writeElement('link', route('channels.comments.create', ["channel" => $channel]) );
                    // $xml->writeElement('link', route('channels.comments.create', ["channel" => $channel, "sid" => "[ENVID]"]) );
                    $xml->writeElement('type', "text");
                    $xml->endElement();
                }
                $xml->endElement();
            }
            
            // </list-index>
            $xml->endElement();

            if (empty($header)) {
                $header['Content-Type'] = 'application/xml';
            }

            return Response::make($xml->outputMemory(true), $status, $header);
        });
    }
}