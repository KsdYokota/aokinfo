@php
    $title = "編集1";
@endphp
@extends('layouts.application')
@section('content')
<h1>{{ $title }}</h1>

{!! Form::open(['method' => 'put', "route" => ['channels.update', $channel] ]) !!}
    <div class="form-group">
        {{ Form::label('title', '題名') }}
        {{ Form::text('title', $channel->title, ['autofocus', 'class' => "form-control", 'id'=>"title"]) }}
    </div>
    <div class="row">
        <div class="col form-group">
            {{ Form::label('published_at', '公開日') }}
            {{ Form::date('published_at', $channel->published_at, ['id'=>"pubDate", 'class' => "form-control"]) }}
        </div>
        <div class="col form-group">
            {{ Form::label('publish_type', '公開状態') }}
            {{ Form::select('publish_type', App\Enums\PublishType::toSelectArray(), $channel->publish_type, ['required', 'class' => "form-control"]) }}
        </div>
    </div>
    {{ Form::hidden('code', 'yosakoi') }}

    {!! Form::submit('更新', ["class" => "btn btn-primary"]) !!}
{!! Form::close() !!}
@endsection
