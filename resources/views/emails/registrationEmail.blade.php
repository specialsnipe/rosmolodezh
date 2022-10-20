<!DOCTYPE html>
<html>
<head>
    <title>Привет, ты забыл пароль от своего аккаунта?</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>Поздравляем с регистрацией на нашем сайте, это было здорово! Вы выбрали траекторию {{ $mailData['track'] }}</p>
    <p>Ваш логин: {{ $mailData['login'] }}</p>
    <p>Заходите на наш <a href="{{ route('home') }}">сайт</a>!</p>
</body>
</html>
