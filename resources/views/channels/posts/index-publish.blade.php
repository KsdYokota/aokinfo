@extends('layouts.application')
@section('title', $channel->title.'（公開中）')
@section('content')
  <p>
    {{ link_to_route('channels.index', "チャンネル一覧", [], []) }}
    >> {{$channel->title}}（公開中）>> {{ link_to_route("channels.publish", "下書きに戻す", [$channel, "publish" => false], ["class" => "btn btn-primary"]) }}
  </p>

  <div class="row">
    <div class="col-3">
      <div class="sidebar">
        <table class="table">
          @foreach ($posts as $post)
            <tr>
              <td>
                <div class="row">
                  <div class="col-8">
                    {{ $post->order_number }}. <a href="#toc{{$post->id}}">{{ $post->title }}</a>
                  </div>
                  <div class="col-1">
                  </div>
                  <div class="col-1">
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
            </div>
            <div class="col-1">
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
