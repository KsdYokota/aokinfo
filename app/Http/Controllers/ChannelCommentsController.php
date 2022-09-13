<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;

class ChannelCommentsController extends Controller
{
  public function index(Channel $channel)
  {
    $comments = $channel->comments()->recent();
    return view('channels.comments.index', ["channel" => $channel, 'comments' => $comments]);
  }

  public function create(Request $request, Channel $channel)
  {
      return view('channels.comments.create', ['channel' => $channel, "sid" => "99999" ]);
  }

  public function store(Request $request, Channel $channel)
  {
      $comment = $channel->comments()->create(
          [
              'content' => $request->content,
              'sid' => $request->sid
          ]
      );

      // MySupportが302のレスポンスに対応していないため
      return response('ありがとうございました。', 200)->header('Content-Type', 'text/plain');
  }
}