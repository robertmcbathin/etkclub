<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ЕТК-Клуб - сообщество потребителей траснпортных услуг, основанных на использовании электронных карт">
    <meta name="author" content="Alexander Ivanov | mercile55">
    <title>ЕТК-Клуб</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="{{ URL::to('src/css/full-width-pics.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::to('src/css/animate.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/font-awesome.min.css') }}">
    <link href="{{ URL::to('src/css/main.css') }}" rel="stylesheet">
</head>
<body>
    @include('includes.header')
    @yield('content')

    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="{{ URL::to('src/js/wow.min.js') }}"></script>
    <script src="{{ URL::to('src/js/app.js') }}"></script>
    <script>
      new WOW().init();
    </script>
   @include('includes.footer')
</body>
</html>
