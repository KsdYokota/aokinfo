@extends('layouts.application')
@section('title', 'フィードの一覧')

@section('content')
<h1>{{ 'フィードの一覧' }}</h1>

<div class="navigation m-3">
  {{ link_to_route('feeds.create', '新規作成', [], ['class' => "btn btn-primary"]) }}
</div>

<table class="table table-striped">
  <thead>
    <th>名前</th>
    <th></th>
  </thead>
  <tbody>

    @foreach ($feeds as $feed)
    <tr>
      <td>
        {{ link_to_route('feeds.show', $feed->name, $feed) }}
      </td>
      <td>
        {{ link_to_route('feeds.edit', '編集', $feed) }}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
