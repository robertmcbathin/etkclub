@extends('layouts.callback')

@section('content')
      <div class="container">
      <div class="page-header">
        <img src="{{ URL::to('/src/img/etk-club-logo-static.svg.png') }}" width="50" alt="ЕТК-Клуб">
        <h1>Вы почти у цели!</h1>
      </div>
      <p class="lead">На электронный адрес <strong>{{$email}}</strong> было отправлено письмо. Для подтвержения регистрации пройдите по ссылке в письме</p>
    </div>
     <footer class="footer">
      <div class="container">
        <p class="text-muted">ЕТК-Клуб 2016</p>
      </div>
    </footer>
@endsection