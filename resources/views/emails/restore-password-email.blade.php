<!DOCTYPE html>
<html>
<head>
    <title>Привет,{{$login}}!!!</title>
</head>
<body>
    <p>Для восстановления пароля необходимо перейти по ссылке</p>
    <p> <a href="{{ route('auth.forget.change-password', ["token" => $token]) }}">Восстановить пароль</a>!</p>
    <p>Если вы не делали запрос на восстановление пароля,то проигнорируйте это сообщение</p>
</body>
</html>
