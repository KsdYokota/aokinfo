@php
  $title = 'アイテム追加';
@endphp
@extends('layouts.application')

@section('content')
<h1>{{ $title }}</h1>
{!! Form::open(['method'=>'post', 'route'=>'items.store']) !!}
  <div class="form-group">
    {{ Form::label('title', 'タイトル') }}
    {{ Form::text('title', null, ['autofocus', 'required', 'class' => "form-control"]) }}
  </div>
  <div class="form-group">
    {{ Form::label('date', '更新日付') }}
    {{ Form::date('date', \Carbon\Carbon::now(), ['required', 'class' => "form-control"]) }}
  </div>
  {!! Form::submit('追加', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
{!! link_to("items", 'キャンセル', [] ) !!}

@endsection
