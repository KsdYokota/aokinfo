@php
  $title = "ご意見・ご要望はこちら";
@endphp
@extends('layouts.plain')
@section('content')
<h1>ご意見・ご要望はこちら</h1>
<p>今回の番組「{{$channel->title}}」に関しまして、ご意見やご要望がございましたら、こちらからお願いいたします。</p>

{!! Form::open(['method' => 'post', 'route' => ['channels.comments.store', $channel]]) !!}
  <div class="form-group">
    {{ Form::label('content', 'ご意見・ご要望') }}
    <br/>
    {{ Form::textarea('content', "", ['autofocus', 'required', 'class' => "form-control"]) }}
  </div>
  {{ Form::hidden('sid', $sid)}}

  <p>内容をご確認の上、送信ボタンを押してください</p>
  {!! Form::submit('送信', ['class' => 'btn btn-success']) !!}
{!! Form::close() !!}
@endsection
