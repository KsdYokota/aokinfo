<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Channel;


class ChannelsController extends Controller
{

    public function publish(Request $request, Channel $channel)
    {
        if($request["publish"]){
            $channel->to_publish();
        }
        else{
            $channel->to_draft();
        }
        $channel->save();
        return redirect('channels/'.$channel->id.'/posts');
    }

    public function yosakoi()
    {
        return response()->yosakoi_root_xml();
    }

    public function feed(Request $request)
    {
        $draft = $request->draft;
        $channels = [];
        if($draft){
            $channels = Channel::all();
        }else{
            $channels = Channel::recent()->published()->get();
        }
        return response()->channel_xml($channels);
    }

    public function index()
    {
        $channels = Channel::all();
        return view('channels.index', ['channels' => $channels]);
    }

    public function create()
    {
        return view('channels.create');
    }

    public function store(Request $request)
    {
        $channel = new Channel;
        $channel->title = $request->title;
        $channel->publish_type = $request->publish_type;
        $channel->published_at = $request->published_at;
        $channel->code = $request->code;
        $channel->save();
        return redirect('channels/'.$channel->id.'/posts');
    }

    public function show($id)
    {
        //
    }

    public function edit(Channel $channel)
    {
        return view('channels.edit', ['channel' => $channel]);
    }

    public function update(Request $request, Channel $channel)
    {
        $channel->title = $request->title;
        $channel->publish_type = $request->publish_type;
        $channel->published_at = $request->published_at;
        $channel->save();
        return redirect('channels');
    }

    public function destroy(Channel $channel)
    {
        $channel->delete();

        session()->flash('alert',"「{$channel->title}」を削除しました");
        return redirect("channels");
    }
}