@extends('layouts.application')
@section('title', 'フィード '.$feed->name)

@section('content')
<h1>{{ "フィード {$feed->name}" }}</h1>

<div class="navigation m-3">
  {{ link_to_route('feeds.feed', 'RSS フィード', ['feed' => $feed], ['class' => "btn btn-feed", "target" => "_blank"]) }}
</div>

<h3>登録されたアイテム一覧</h3>
<table class="table table-striped">
  <thead>
    <th>名前</th>
    <th></th>
  </thead>
  <tbody>

    @foreach ($feed->items()->get() as $item)
    <tr>
      <td>
        {{$item->title}}
      </td>
      <td>
        {!! Form::open(['method' => 'delete', 'route' => ['feeds.detach_item', $feed, $item]]) !!}
        {!! Form::submit('外す', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>


<h3>登録できるアイテム一覧</h3>
<table class="table table-striped">
  <thead>
    <th>名前</th>
    <th></th>
  </thead>
  <tbody>

    @foreach ($detached_items as $item)
    <tr>
      <td>
        {{$item->title}}
      </td>
      <td>
        {!! Form::open(['method' => 'post', 'route' => ['feeds.attach_item', $feed, 'item' => $item]]) !!}
        {!! Form::submit('含める', ['class' => 'btn btn-success']) !!}
        {!! Form::close() !!}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
