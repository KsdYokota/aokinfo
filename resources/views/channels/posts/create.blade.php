@php
  $title = "目次の追加";
@endphp
@extends('layouts.application')
@section('content')
<h1>{{ $title }}</h1>

{!! Form::open(['method' => 'post', 'route' => ['channels.posts.store', $channel]]) !!}
  <div class="form-group">
    {{ Form::label('title', 'タイトル') }}
    {{ Form::text('title', null, ['autofocus', 'required', 'class' => "form-control"]) }}
  </div>
  <div class="form-group">
    {{ Form::label('order_number', '並び順') }}
    {{ Form::text('order_number', $channel->posts()->count() +1, ['required', 'class' => "form-control"]) }}
  </div>
  <div class="form-group">
    {{ Form::label('content', '内容') }}
    {{ Form::textarea('content', null, ['class' => "form-control"]) }}
  </div>
  {!! Form::submit('作成', ["class" => "btn btn-primary"]) !!}
{!! Form::close() !!}

{!! link_to_route('channels.posts.index', 'キャンセル', [$channel], [] ) !!}

@endsection
