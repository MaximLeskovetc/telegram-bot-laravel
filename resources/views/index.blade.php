<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Telegram Bot</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>
<body>
<form method="Post" action="{{action('BotController@send')}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button>Отправить</button>
</form>

<form method="Post" action="{{action('BotController@update')}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button>Обновить</button>
</form>
</body>
</html>
