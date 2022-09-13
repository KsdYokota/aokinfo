@php
    $title = '番組の追加';
@endphp
@extends('layouts.application')
@section('content')
<h1>{{ $title }}</h1>

{!! Form::open(['method' => 'post', 'url' => route('channels.store')]) !!}
  <div class="form-group">
    {{ Form::label('title', '題名') }}
    {{ Form::text('title', "", ['required', 'autofocus','class' => "form-control"]) }}
  </div>
  <div class="row">
    <div class="col form-group">
      {{ Form::label('published_at', '公開日') }}
      {{ Form::date('published_at', \Carbon\Carbon::now(), ['id'=>"pubDate", 'class' => "form-control"]) }}
    </div>
    <div class="col form-group">
      {{ Form::label('publish_type', '公開状態') }}
      {{ Form::select('publish_type', App\Enums\PublishType::toSelectArray(), App\Enums\PublishType::DRAFT, ['required', 'class' => "form-control"]) }}
    </div>
  </div>
  {{ Form::hidden('code', 'yosakoi') }}

  {!! Form::submit('追加', ['class' => "btn btn-primary"]) !!}
{!! Form::close() !!}
@endsection
