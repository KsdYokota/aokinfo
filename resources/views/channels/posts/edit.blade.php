@php
  $title = "目次の編集";
@endphp
@extends('layouts.application')
@section('content')
<h1>{{ $title }}</h1>

{!! Form::open(['method' => 'put', 'route' => ['channels.posts.update', $channel, $post]]) !!}
  <div class="form-group">
    {{ Form::label('title', 'タイトル') }}
    {{ Form::text('title', $post->title, ['autofocus', 'required', 'class' => "form-control"]) }}
  </div>
  <div class="form-group">
    {{ Form::label('order_number', '並び順') }}
    {{ Form::text('order_number', $post->order_number, ['required', 'class' => "form-control"]) }}
  </div>
  <div class="form-group">
    {{ Form::label('content', '内容') }}
    {{ Form::textarea('content', $post->content, ['class' => "form-control"]) }}
  </div>
  {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

{!! link_to_route('channels.posts.index', 'キャンセル', [$channel] ) !!}

@endsection
