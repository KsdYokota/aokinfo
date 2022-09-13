<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Enums\ItemType;
use App\Http\Controllers\Response;

class ItemsController extends Controller
{
    public function feed()
    {
        $items = Item::normal()->get();
        return response()->xml($items);
    }
   
    public function index()
    {
        $items = Item::normal()->get();
        return view('items.index', ['items' => $items]);
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $item = new Item;
        $item->title = $request->title;
        $item->date = $request->date;
        $item->item_type = ItemType::NORMAL;
        $item->save();
        session()->flash('notice',"「{$item->title}」を追加しました");
        return redirect('items');
    }

    public function show($id)
    {
    }

    public function edit(Item $item)
    {
        return view('items.edit', ['item' => $item]);
    }

    public function update(Request $request, Item $item)
    {
        $item->title = $request->title;
        $item->date = $request->date;
        $item->save();
        session()->flash('notice',"「{$item->title}」を更新しました");
        return redirect('items');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        session()->flash('alert',"「{$item->title}」を削除しました");
        return redirect("items");
    }
}