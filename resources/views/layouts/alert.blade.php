 <!-- フラッシュメッセージ -->
 @if (session('notice'))
 <div class="alert alert-success" role="alert">
     {{ session('notice') }}
 </div>
@endif
@if (session('alert'))
 <div class="alert alert-danger" role="alert">
     {{ session('alert') }}
 </div>
@endif