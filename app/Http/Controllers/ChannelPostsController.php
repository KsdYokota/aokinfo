<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Channel;
use App\Post;
use App\Http\Controllers\Response;

class ChannelPostsController extends Controller
{
    public function feed(Channel $channel)
    {
        $posts = $channel->posts()->get();
        return response()->post_xml($channel, $posts);
    }

    public function index(Channel $channel)
    {
        if( $channel->draft() ){
            return view('channels.posts.index', ['channel' => $channel,'posts' => $channel->posts]);
        }
        return view('channels.posts.index-publish', ['channel' => $channel,'posts' => $channel->posts]);
    }

    public function create(Channel $channel)
    {
        return view('channels.posts.create', ['channel' => $channel]);
    }

    public function store(Request $request, Channel $channel)
    {
        $post = $channel->posts()->create(
            [
                'title' => $request->title,
                'order_number' => $request->order_number,
                'content' => $request->content,
            ]
        );

        return redirect(route('channels.posts.index', $channel));
    }

    public function edit(Channel $channel, Post $post)
    {
        return view('channels.posts.edit', ['channel' => $channel, 'post' => $post]);
    }

    public function update(Request $request, Channel $channel, Post $post)
    {
        $post->title = $request->title;
        $post->order_number = $request->order_number;
        $post->content = $request->content;
        $post->save();
        return redirect(route('channels.posts.index', $channel));
    }

    
    public function destroy(Channel $channel, Post $post)
    {
        $post->delete();

        session()->flash('alert',"「{$post->title}」を削除しました");
        return redirect(route("channels.posts.index", $channel));
    }
}