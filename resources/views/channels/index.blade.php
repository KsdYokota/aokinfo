{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

{{-- @yield('title')にテンプレートごとにtitleタグの値を代入 --}}
@section('title', '記事一覧')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')

<p>
  {{ link_to_route('channels.create', "新規作成", [], ["class" => "btn btn-primary"]) }}
  {{ link_to_route('channels.yosakoi', '確認用 XML', [], ['target' => '_blank', 'class' => "btn btn-secondary"]) }}
  {{ link_to_route('channels.feed', '公開用 XML', [], ['target' => '_blank', 'class' => "btn btn-feed"]) }}
</p>

<table class="table table-striped">
  <thead>
    <th>題名</th>
    <th>公開日</th>
    <th>コメント数</th>
    <th>編集・削除</th>
  </thead>
  <tbody>
    @foreach ($channels as $channel)
    <tr>
      <td>
        @if ( $channel->draft() )
          <span class="badge badge-light">下書き</span>
        @else
          <span class="badge badge-success">公開</span>
        @endif
        {{ link_to_route('channels.posts.index', $channel->title, [$channel,'posts' => $channel->posts]) }}
      </td>
      <td>
        <small>{{ $channel->published_at }}</small>
      </td>
      <td align="right" width="120">
        {{ link_to_route('channels.comments.index', $channel->comments()->count(), [$channel], []) }}
      </td>
        <td width="120">
        <div class="row">
        <div class="col">
          <a class="btn btn-link" href="{{ route('channels.edit', ['channel' => $channel]) }}">
            <i class="fas fa-edit"></i>
          </a>
        </div>
        <div class="col">
          @if ( $channel->draft() )
            {!! Form::open(['method' => 'delete', 'route' => ['channels.destroy', $channel]]) !!}
              <button class="btn btn-link confirm" data-confirm="{{$channel->title}}を削除してよろしいですか？">
                <i class="far fa-trash-alt text-danger"></i>
              </button>
            {!! Form::close() !!}
          @endif
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
