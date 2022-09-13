@php
    $title = '通知の追加';
@endphp
@extends('layouts.application')

@section('content')
<h1>{{ $title }}</h1>
{!! Form::open(['method'=>'put', 'route'=> ['feeds.update', $feed]]) !!}
  <div class="form-group">
    {{ Form::label('name', '名前') }}
    {{ Form::text('name', $feed->name, ['autofocus', 'required', 'class' => "form-control"]) }}
  </div>
  {!! Form::submit('更新', ['class'=>"btn btn-primary"]) !!}
{!! Form::close() !!}
{!! link_to("feeds", 'キャンセル', [] ) !!}
@endsection
