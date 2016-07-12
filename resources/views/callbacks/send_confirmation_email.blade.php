@extends('layouts.entrance_layout')

@section('content')
  <div class="container center join-container">
  	<div class="row">
  		<div class="alert alert-success" role="alert">
  			Поздравляем! На электронный ящик <strong>{{$email}}</strong> было отправлено письмо. Для подтвержения регистрации пройдите по ссылке в письме
  		</div>
  	</div>
  </div>
@endsection