<header>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">

    {{ link_to_route( 'items.index' ,"ホーム", [], ['class'=>"navbar-brand"]) }}


    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto ml-3">
        <li class="nav-item active">
          {{ link_to_route( 'user_supports.index' ,"ユーザーサポート情報", [], ['class'=>"nav-link"]) }}
        </li>
        <li class="nav-item active">
          {{ link_to_route( 'channels.index' ,"AOKよさこい通信", [], ['class'=>"nav-link"]) }}
        </li>
      </ul>
    </div>
  </nav>
</header>
