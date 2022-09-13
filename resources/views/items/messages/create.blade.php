@php
  $title = '通知の追加';
@endphp
@extends('layouts.application')
@section('content')
<h1>{{ $title }}</h1>

{!! Form::open(['method'=>'post', 'route'=>['items.messages.store', $item]]) !!}
  <div class="form-group">
    {{ Form::label('title', 'タイトル') }}
    {{ Form::text('title', ' ', ['autofocus', 'class' => "form-control"]) }}
  </div>
  <div class="form-group">
    {{ Form::label('category', 'カテゴリー') }}
    {{ Form::text('category', null, ['required', 'class' => "form-control"]) }}
  </div>
  <div class="form-group">
    {{ Form::label('type', 'タイプ') }}
    {{ Form::text('type', 'description', ['required', 'class' => "form-control"]) }}
  </div>
  <div class="form-group">
    {{ Form::label('description', '内容') }}
    {{ Form::textarea('description', null, ['required', 'class' => "form-control"]) }}
  </div>
  {!! Form::submit('追加', ['class' => "btn btn-primary"]) !!}
{!! Form::close() !!}

{!! link_to("items/{$item->id}/messages", 'キャンセル', [] ) !!}
@endsection
