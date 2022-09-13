@extends('layouts.application')
@section('title', $item->title.'の通知の一覧')

@section('content')
<h1>{{ $item->title.'の通知の一覧' }}</h1>

<div class="navigation m-3">
  {{ link_to_route('items.messages.create', '新規作成', ['item' => $item], ['class' => "btn btn-primary"]) }}
</div>

<table class="table table-striped">
  <thead>
    <th>タイトル</th>
    <th>カテゴリー</th>
    <th>タイプ</th>
    <th>内容</th>
    <th></th>
  </thead>
  <tbody>

    @foreach ($messages as $message)
    <tr>
      <td>
        {{$message->title}}
      </td>
      <td>
        {{$message->category}}
      </td>
      <td>
        {{$message->type}}
      </td>
      <td>
        {{$message->description}}
      </td>
      <td>
        {{link_to_route('items.messages.edit', '編集', ['item' => $item, 'message' => $message], []) }}
      </td>
      <td>
        {!! Form::open(['method' => 'delete', 'route' => ['items.messages.destroy', 'item' => $item, 'message' => $message]]) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-default text-danger confirm', 'data-confirm' => $message->title."を削除してよろしいですか？"]) !!}
        {!! Form::close() !!}  
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
