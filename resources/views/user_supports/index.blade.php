@extends('layouts.application')
@section('title', 'ユーザーサポート情報')

@section('content')
<h1>{{ 'ユーザーサポート情報' }}</h1>

<div id="update_noti" class="card">
  <div class="card-body">
    <h2 class="card-title">通知日付の更新</h2>
    <ol class="card-text">
      <li>MySupportからの新着通知を出すときに押してください。</li>
      <li>更新後、
        <a target="_blank" href="http://www.aok-net.jp/mysupport/serviceinformation.xml">通知日付XML</a>の内容が更新されていることを確認してください。
      </li>
    </ol>
    {{ link_to_route('user_supports.ping', "通知日付を更新する", [], ['class'=>'btn btn-success']) }}
  </div>
</div>

<h2 class="mt-3">お知らせの一覧</h2>

<div class="navigation m-3">
  {{ link_to_route('user_supports.create', '新規作成', [], ['class' => "btn btn-primary"]) }}
  {{ link_to_route('user_supports.feed', 'RSS フィード', [], ['target' => '_blank', 'class' => "btn btn-feed"]) }}
</div>

<table class="table border table-striped">
  <tbody>
    @foreach ($messages as  $key =>$message)
      <tr>
        <td>
          <div class="row">
            <div class="col">
              <h3>
              {{ $key+1 }}.&nbsp;{{ link_to_route("user_supports.show", $message->title, ['user_support' => $message], []) }} &nbsp;
            </h3>
          </div>
        </div>
          <div class="row">
            <div class="col-5">
              <small>{{ $message->published_at }}</small>
              @if ( $message->draft() == true)
                <span class="badge badge-light">下書き</span>
              @else
                <span class="badge badge-success">公開</span>
              @endif
            </div>
            <div class="col">
              <div class="float-right">
                {{ link_to_route('user_supports.edit', '編集', ['user_support' => $message], ['class'=>'btn btn-primary']) }}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              @if ($key+1 <= 20)
              <p class="mt-2">
                {!! nl2br(e($message->description)) !!}
              </p>
            @endif
          </div>
        </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
