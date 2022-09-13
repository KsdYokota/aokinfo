@php
  $title = 'アイテム編集';
@endphp
@extends('layouts.application')
@section('content')
<h1>{{ $title }}</h1>
{!! Form::open(['method'=>'put', 'route'=>['items.update', $item]]) !!}
  <div class="form-group">
    {{ Form::label('title', 'タイトル') }}
    {{ Form::text('title', $item->title, ['autofocus', 'required', 'class' => "form-control"]) }}
  </div>
  <div class="form-group">
    {{ Form::label('date', '更新日付') }}
    {{ Form::date('date', $item->date, ['required', 'class' => "form-control"]) }}
  </div>
  {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
{!! link_to("items", 'キャンセル', [] ) !!}
@endsection
