<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Feed;
use App\Item;
use App\Http\Controllers\Response;

class FeedsController extends Controller
{
    public function feed(Feed $feed)
    {
        $items = $feed->items()->get();
        return response()->xml($items);
    }
    
    public function index()
    {
        return view('feeds.index', ['feeds' => Feed::all() ]);
    }

    public function create()
    {
        return view('feeds.create');
    }

    public function store(Request $request)
    {
        $feed = new Feed;
        $feed->name = $request->name;
        $feed->save();
        return redirect('feeds');
    }

    public function show(Feed $feed)
    {
        $attached_ids = $feed->items()->get()->pluck('id');
        $detached_items = Item::whereNotIn('id', $attached_ids)
        ->get();
        return view('feeds.show', ['feed' => $feed, 'detached_items' => $detached_items]);
    }

    public function edit(Feed $feed)
    {
        return view('feeds.edit', ['feed' => $feed]);
    }

    public function update(Request $request, Feed $feed)
    {
        $feed->name = $request->name;
        $feed->save();
        return redirect('feeds');
    }

    public function destroy($id)
    {
    }

    public function attach_item(Request $request, Feed $feed)
    {
        $feed->items()->attach($request->item);
        return redirect()->route('feeds.show', ['feed' => $feed]);
    }

    public function detach_item(Request $request,Feed $feed)
    {
        $feed->items()->detach($request->item);
        return redirect()->route('feeds.show', ['feed' => $feed]);
    }
}