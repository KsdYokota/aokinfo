@php
    $title = 'フィードの追加';
@endphp
@extends('layouts.application')

@section('content')
<h1>{{ $title }}</h1>
{!! Form::open(['method'=>'post', 'route'=>'feeds']) !!}
  <div class="form-group">
    {{ Form::label('name', '名前') }}
    {{ Form::text('name', ' ', ['autofocus', 'class' => "form-control"]) }}
  </div>
  {!! Form::submit('登録する', ['class'=>"btn btn-primary"]) !!}
{!! Form::close() !!}

{!! link_to("/", 'キャンセル', [] ) !!}
@endsection
