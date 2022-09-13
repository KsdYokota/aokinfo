@extends('layouts.application')
@section('title', '記事一覧')
@section('content')
  <p>
    {{ link_to_route('channels.index', "チャンネル一覧", [], []) }}
    >> {{$channel->title}}（下書き）
        >> 
        {{ link_to_route("channels.publish", "公開する", [$channel, "publish" => true], ["class" => "btn btn-primary"]) }}
  </p>

  <div class="row">
    <div class="col-3">
      <div class="sidebar">
        <p>
          {{ link_to_route('channels.posts.create', "目次追加", [ $channel ], ['class' => "btn btn-success"]) }}
        </p>

        <table class="table">
          @foreach ($posts as $post)
            <tr>
              <td>
                <div class="row">
                  <div class="col-8">
                    {{ $post->order_number }}. <a href="#toc{{$post->id}}">{{ $post->title }}</a>
                  </div>
                  <div class="col-1">
                    <a href="{{ route('channels.posts.edit', [$channel, $post]) }}" class="btn btn-link">
                      <i class="fas fa-edit"></i>
                    </a>
                  </div>
                  <div class="col-1">
                    {!! Form::open(['method' => 'delete', 'url' => route('channels.posts.destroy', [ $channel, $post])]) !!}
                    <button class="btn btn-link confirm" data-confirm="”{{$post->title}}”を削除してよろしいですか？">
                      <i class="far fa-trash-alt text-danger"></i>
                    </button>
                    {!! Form::close() !!}
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
    <div class="col-9">
      @foreach ($posts as $key => $post)
        <div class="card mb-2">
          <div class="card-header">
            <div class="row">
              <div class="col-9">
                <h4 id="toc{{$post->id}}">{{$key+1 .". ". $post->title}}</h4>
              </div>
              <div class="col-1">
                <a href="{{ route('channels.posts.edit', [$channel, $post]) }}" class="btn btn-link">
                  <i class="fas fa-edit"></i>
                </a>
              </div>
              <div class="col-1">
                {!! Form::open(['method' => 'delete', 'route' => ['channels.posts.destroy', $channel, $post]]) !!}
                  <button class="btn btn-link confirm" data-confirm="{{$post->title}}を削除してよろしいですか？">
                    <i class="far fa-trash-alt text-danger"></i>
                  </button>
                {!! Form::close() !!}
              </div>
            </div>
          </div>
          <div class="card-body">
            <p class="card-text">
              {!! nl2br(e($post->content)) !!}
            </p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
