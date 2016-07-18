@extends('layouts.callback')

@section('content')
      <div class="container">
      <div class="page-header">
        <img src="{{ URL::to('/src/img/etk-club-logo-static.svg.png') }}" width="50" alt="ЕТК-Клуб">
        <h1>Поздравляем!</h1>
      </div>
      <p class="lead">Ваша учетная запись активирована. Для авторизации на портале <a href="http://21market.ru" target="_blank">21market.ru</a> используйте указанный электронный адрес или серию и номер карты в качестве имени пользователя вместе с высланным Вам ранее паролем.</p>
    </div>
     <footer class="footer">
      <div class="container">
        <p class="text-muted">ЕТК-Клуб 2016</p>
      </div>
    </footer>
@endsection