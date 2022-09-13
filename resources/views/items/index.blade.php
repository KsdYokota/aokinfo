@extends('layouts.application')
@section('title', 'アイテム一覧')

@section('content')
<div class="navigation m-3">
  {{ link_to_route('items.create', '新規作成', [], ['class' => "btn btn-primary"]) }}
  {{ link_to_route('feeds.index', 'フィードの一覧', [], ['class' => "btn btn-feed"]) }}
</div>

<table class="table table-striped">
  <thead>
    <th>アプリケーション</th>
    <th>更新日付</th>
    <th></th>
    <th></th>
  </thead>
  <tbody>
    @foreach ($items as $item)
    <tr>
      <td class="align-middle">
        {{ link_to_route('items.messages.index', $item->title, $item) }}
      </td>
      <td class="align-middle">
        {{$item->date}}
      </td>
      <td class="align-middle">
        {{ link_to_route('items.edit', "編集", ['item' => $item]) }}
      </td>
      <td>
        {!! Form::open(['method' => 'delete', 'route' => ['items.destroy', $item]]) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-default text-danger confirm', 'data-confirm' => $item->title."を削除してよろしいですか？"]) !!}
        {!! Form::close() !!}        
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
