@php
  $title = 'ユーザーサポート情報の追加';
@endphp
@extends('layouts.application')

@section('page_css')
<style>
#preview_list_title {
  color: black;
  background-color: yellow;
  border: 1 solid white;
  padding: 5px 1em 5px 1em;
  margin-bottom: 10px;
  font-weight: bold;
}

#preview-text {
  color: white;
  background-color: black;
  border: 1 solid white;
  padding: 5px 1em 5px 1em;
}

#preview_post_title {
  color: yellow;
}

#preview {
  color: white;
  background-color: gray;
  width: 45em;
  padding: 0.5em;
  margin: 10px 0;
}
</style>
@endsection

@section('content')
<h1>{{ $title }}</h1>

{!! Form::open(['method'=>'post', 'route'=>'user_supports.store']) !!}
  <div class="form-group">
    {{ Form::label('title', '題名') }}
    {{ Form::text('title', ' ', ['autofocus', 'class' => "form-control", 'id'=>"title"]) }}
  </div>
  
  <div class="form-group">
    {{ Form::label('description', '本文') }}
    {{ Form::textarea('description', null, ['required', 'class' => "form-control", 'id'=>"post_content"]) }}
  </div>

  <div class="row">
    <div class="col form-group">
      {{ Form::label('published_at', '公開日') }}
      {{ Form::date('published_at', \Carbon\Carbon::now(), ['id'=>"pubDate", 'class' => "form-control"]) }}
    </div>
    <div class="col form-group">
      {{ Form::label('publish_type', '公開状態') }}
      {{ Form::select('publish_type', App\Enums\PublishType::toSelectArray(), App\Enums\PublishType::PUBLISHED, ['required', 'class' => "form-control"]) }}
    </div>
  </div>
  {!! Form::submit('追加', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<div class="mt-3 container_preview">
  <button class="btn btn-warning mt-2 mb-2" onclick="preview.update();">プレビューに反映する</button>
  <div id="preview">
    <div id="preview_list_title">
    サンプル
    </div>

    <div id="preview-text">
      <h1 id="preview_post_title">サンプル</h1>
      <hr>
      <div id="preview_post_content">
        サンプル
      </div>
    </div>
  </div>
</div>

{!! link_to("user_supports", 'キャンセル', [] ) !!}

@endsection
