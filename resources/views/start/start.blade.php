<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Отзывы Яндекс Карт</title>

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

        .container {
            width: 100%;
            max-width: 520px;
        }

        .heading {
            margin-bottom: 28px;
            text-align: center;
        }

        .heading h1 {
            margin: 0 0 12px;
            font-size: 30px;
            line-height: 1.3;
        }

        .heading p {
            margin: 0;
            color: #71809a;
            line-height: 1.6;
        }

        .form-card {
            padding: 28px;
            background: #fff;
            border: 1px solid #e5eaf2;
            border-radius: 14px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #dce3ee;
            border-radius: 8px;
            outline: none;
            color: #17243d;
            font-size: 15px;
            transition: border-color .2s, box-shadow .2s;
        }

        input:focus {
            border-color: #526fb5;
            box-shadow: 0 0 0 3px #526fb51a;
        }

        input::placeholder {
            color: #a4aec0;
        }

        button {
            width: 100%;
            margin-top: 16px;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: #526fb5;
            color: #fff;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background .2s;
        }

        button:hover {
            background: #405b9b;
        }

        .hint {
            margin: 16px 0 0;
            color: #8190a8;
            font-size: 13px;
            line-height: 1.6;
        }

        @media (max-width: 480px) {
            .heading h1 {
                font-size: 26px;
            }

            .form-card {
                padding: 22px;
            }
        }
    </style>
</head>
<body>
<main class="container">
    <header class="heading">
        <h1>Отзывы Яндекс Карт</h1>
        <p>Информация об организации и отзывы в одном месте</p>
    </header>

    <section class="form-card">
        <form method="POST" action="{{ route('company.get') }}">
            @csrf

            <label for="url">Ссылка на организацию</label>

            <input
                type="url"
                id="url"
                name="url"
                placeholder="https://yandex.ru/maps/org/..."
                required
            >

            <button type="submit">Получить данные</button>

            <p class="hint">
                Вставьте ссылку на организацию в Яндекс Картах.
                Данные будут загружены и сохранены для просмотра отзывов.
            </p>
        </form>
    </section>
</main>
</body>
</html>

