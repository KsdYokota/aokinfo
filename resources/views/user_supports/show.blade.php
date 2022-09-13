@php
  $title = $message->title;
@endphp
@extends('layouts.plain')

@section('content')
<h1>{{ $title }}</h1>
<article>
  {!! nl2br($message->description) !!}
</article>
@endsection
