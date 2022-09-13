<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Message;
use App\Http\Controllers\Response;

class ItemMessagesController extends Controller
{
    public function feed(Item $item)
    {
        $messages = $item->messages()->get();
        return response()->xml_messages($messages);
    }
    
    public function index(Item $item)
    {
        $messages = $item->messages()->get();
        return view('items.messages.index',['item' => $item, 'messages' => $messages]);
    }

    public function create(Item $item)
    {
        return view('items.messages.create', ['item' => $item]);
    }

    public function store(Request $request, Item $item)
    {
        $message = $item->messages()->create(
            [
                'title' => $request->title,
                'category' => $request->category,
                'type' => $request->type,
                'description' => $request->description,
            ]
            );
        return redirect("items/{$item->id}/messages");
    }

    public function show($id)
    {
    }

    public function edit(Item $item, Message $message)
    {
        return view('items.messages.edit', ['item' => $item, 'message' => $message]);
    }

    public function update(Request $request, Item $item, Message $message)
    {
        $message->title = $request->title;
        $message->category = $request->category;
        $message->type = $request->type;
        $message->description = $request->description;
        $message->save();

        return redirect("items/{$item->id}/messages");
    }

    public function destroy(Item $item,Message $message)
    {
        $message->delete();
        session()->flash('alert',"「{$message->title}」を削除しました");
        return redirect("items/{$item->id}/messages");
    }
}
