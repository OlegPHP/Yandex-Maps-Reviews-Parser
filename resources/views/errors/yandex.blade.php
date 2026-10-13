<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Не удалось получить данные</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: #f5f7fb;
            color: #17243d;
            font-family: Arial, sans-serif;
        }

        .error-card {
            width: 100%;
            max-width: 480px;
            padding: 40px 32px;
            text-align: center;
            background: #fff;
            border: 1px solid #e5eaf2;
            border-radius: 14px;
        }

        .icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #fff3e8;
            color: #c87527;
            font-size: 28px;
        }

        h1 {
            margin: 0 0 12px;
            font-size: 25px;
        }

        p {
            margin: 0 0 24px;
            color: #71809a;
            line-height: 1.7;
        }

        a {
            display: inline-block;
            padding: 11px 20px;
            border-radius: 8px;
            background: #526fb5;
            color: #fff;
            text-decoration: none;
            transition: background .2s;
        }

        a:hover {
            background: #405b9b;
        }
    </style>
</head>
<body>
<main class="error-card">
    <div class="icon">!</div>

    <h1>{{ $title }}</h1>

    <p>{{ $message }}</p>

    <a href="{{ url('/') }}">Вернуться на главную</a>
</main>
</body>
</html>
