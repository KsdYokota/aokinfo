@extends('layouts.application')
@section('title', 'コメント一覧')

@section('content')

<p>
  {{ link_to_route('channels.index', "チャンネル一覧", [], []) }}
  >> {{$channel->title}}
</p>

<h3>{{$comments->count()}}件のコメント</h3>
<table class="table table-striped">
  <thead>
    <th>sid</th>
    <th>コメント</th>
    <th>投稿日</th>
  </thead>
  <tbody>
    @foreach ($comments as $comment)
    <tr>
      <td>
       {{ $comment->sid }}
      </td>
      <td>
       {{ $comment->content }}
      </td>
      <td align="right" width="120">
        {{ $comment->created_at->format('Y年m月d日 H:i') }}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
