<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Message;

class UserSupportsController extends Controller
{
    public function index()
    {
        $item = Item::usersupport()->first();
        return view('user_supports.index', ['messages' => $item->messages()->recent()->get()] );
    }

    public function create()
    {
        return view('user_supports.create');
    }

    public function store(Request $request)
    {
        $item = Item::usersupport()->first();

        $message = $item->messages()->create(
            [
                'title' => $request->title,
                'category' => $request->title,//$request->category,
                'type' => 'description',
                'description' => $request->description,
                'published_at' => $request->published_at,
                'publish_type' => $request->publish_type,
            ]
            );
        return redirect("user_supports");
    }

    public function show($id)
    {
        $message = Message::find($id);
        return view('user_supports.show', ['message' => $message]);
    }

    public function edit($id)
    {
        $message = Message::find($id);
        return view('user_supports.edit', ['message' => $message]);
    }

    public function update(Request $request, $id)
    {
        $item = Item::usersupport()->first();
        $message = $item->messages()->find($id);
        $message->title = $request->title;
        $message->category = $request->title;//$request->category;
        $message->description = $request->description;
        $message->published_at = $request->published_at;
        
        $message->publish_type = $request->publish_type;
        $message->save();
        return redirect("user_supports");
    }

    public function destroy($id)
    {
    }

    // MySupportの最終更新通知XMLの通知日時の更新
    public function ping()
    {
        $xml = new \XmlWriter();
        $xml->openMemory();
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('ksinfo');

        $fmt = \Carbon\Carbon::now();
        $xml->writeElement('date', $fmt->format('M j Y G:i:s +900'));   // +900 良くない

        $xml->endElement();
        $xml->endDocument();
        $xml_body = $xml->outputMemory(true);
        
        if ( app()->isLocal() || app()->runningUnitTests() ) {
            // .env に APP_ENV=local (ローカル環境) または APP_ENV=testing (テスト環境) と書いてある場合
             // テスト環境, ローカル環境用の記述
            // echo $xml_body;
        }
        else { 
            // .env に APP_ENV=production (本番環境) などと書いてあった場合
            // 本番環境用の記述
            // MySupport から参照されるXMLを更新する
            // 対象URL：http://www.aok-net.jp/mysupport/serviceinformation.xml
            $path =implode(DIRECTORY_SEPARATOR, [$_SERVER['DOCUMENT_ROOT'], "mysupport", 'serviceinformation.xml']);

            file_put_contents($path, $xml_body);
        }
        session()->flash('notice',"通知日時を {$xml_body} に更新しました");
        return redirect("user_supports");
    }

    public function feed()
    {
        $item = Item::usersupport()->first();
        $messages = $item->messages()->recent()->published()->limit(20)->get();
        return response()->xml_user_support($messages);
    }
    public function rssfeed()
    {
        $item = Item::usersupport()->first();
        $messages = $item->messages()->recent()->published()->limit(20)->get();
        return response()->xml_user_support_rss($messages);
    }
}
