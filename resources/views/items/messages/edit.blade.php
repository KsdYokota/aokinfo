@php
  $title = '通知の追加';
@endphp
@extends('layouts.application')

@section('content')
<h1>{{ $title }}</h1>

{!! Form::open(['method'=>'put', 'route'=>['items.messages.update', $item, $message]]) !!}
  <div class="form-group">
    {{ Form::label('title', 'タイトル') }}
    {{ Form::text('title', $message->title, ['autofocus', 'required', 'class' => "form-control"]) }}
  </div>
  <div class="form-group">
    {{ Form::label('category', 'カテゴリー') }}
    {{ Form::text('category', $message->category, ['required', 'class' => "form-control"]) }}
  </div>
  <div class="form-group">
    {{ Form::label('type', 'タイプ') }}
    {{ Form::text('type', $message->type, ['required', 'class' => "form-control"]) }}
  </div>
  <div class="form-group">
    {{ Form::label('description', '内容') }}
    {{ Form::textarea('description', $message->description, ['required', 'class' => "form-control"]) }}
  </div>
  {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

{!! link_to("items/{$item->id}/messages", 'キャンセル', [] ) !!}
@endsection
