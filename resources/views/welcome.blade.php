<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <a href="{{ route('socialRedirect', 'google') }}">Google Login</a><br>
    <hr>
    <a href="{{ route('socialRedirect', 'github') }}">GitHub Login</a>
</body>

</html>