<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $data->name }} — отзывы</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px 20px;
            background: #f5f7fb;
            color: #17243d;
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
        }

        .card {
            background: #fff;
            border: 1px solid #e5eaf2;
            border-radius: 12px;
            padding: 28px;
            margin-bottom: 24px;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 30px;
            line-height: 1.3;
            overflow-wrap: anywhere;
        }

        h2 {
            margin: 32px 0 16px;
            font-size: 24px;
        }

        .category {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 6px;
            background: #eef2ff;
            color: #5269a5;
            font-size: 14px;
        }

        .stats {
            display: flex;
            flex-wrap: wrap;
            gap: 12px 24px;
            margin-top: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e8edf4;
            color: #687995;
        }

        .rating {
            color: #d99a00;
            font-weight: bold;
        }

        .details {
            display: grid;
            gap: 16px;
            margin-top: 20px;
        }

        .detail-label {
            color: #8190a8;
            font-size: 14px;
        }

        .review {
            background: #fff;
            border: 1px solid #e5eaf2;
            border-radius: 10px;
            padding: 22px 24px;
            margin-bottom: 12px;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 12px;
        }

        .author {
            font-weight: bold;
        }

        .date {
            color: #8190a8;
            font-size: 14px;
        }

        .review-rating {
            color: #d99a00;
            white-space: nowrap;
        }

        .review-text {
            margin: 0;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .pagination {
            margin-top: 24px;
        }

        .pagination nav > div:first-child {
            display: none;
        }

        .pagination nav > div:last-child {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 6px;
        }

        .pagination a,
        .pagination span[aria-current],
        .pagination span[aria-disabled] {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            min-height: 38px;
            padding: 6px 12px;
            border: 1px solid #e1e7f0;
            border-radius: 8px;
            background: #fff;
            color: #405575;
            text-decoration: none;
        }

        .pagination span[aria-current] {
            background: #526fb5;
            border-color: #526fb5;
            color: #fff;
        }

        .pagination a:hover {
            background: #eef2ff;
        }

        .pagination span[aria-disabled] {
            color: #a4aec0;
        }
         a.mb{
            margin-bottom: 20px;
        }

        @media (max-width: 600px) {
            body {
                padding: 20px 12px;
            }

            .card {
                padding: 20px;
            }

            h1 {
                font-size: 25px;
            }

            h2 {
                font-size: 21px;
            }

            .review {
                padding: 18px;
            }
        }
    </style>
</head>
<body>
<main class="container">
    <div class="pagination"><a class="mb" href="{{ url('/') }}">На главную</a></div>
    <section class="card">
        <h1>{{ $data->name }}</h1>

        <span class="category">
                {{ $data->category->name }}
            </span>

        <div class="stats">
                <span class="rating">
                    ★ {{ number_format($data->rating_value, 1) }}
                </span>

            <span>
                    Оценок: {{ $data->rating_count }}
                </span>

            <span>
                    Отзывов на Яндексе: {{ $data->review_count }}
                </span>
        </div>

        <div class="details">
            <div>
                <div class="detail-label">Адрес</div>
                <div>{{ $data->address }}</div>
            </div>


        </div>
    </section>

    <h2>Отзывы</h2>

    @forelse ($reviews as $review)
        <article class="review">
            <div class="review-header">
                <div>
                    <div class="author">{{ $review->name ?: 'Анонимный пользователь' }}</div>

                    <div class="date">
                        {{ $review->date }}
                    </div>
                </div>

                <div class="review-rating">
                    ★ {{ $review->rating }}/5
                </div>
            </div>

            <p class="review-text">{{ $review->text ?: 'Без текста' }}</p>
        </article>
    @empty
        <div class="card">
            Отзывов пока нет.
        </div>
    @endforelse

    <div class="pagination">
        {{ $reviews->links() }}
    </div>

</main>
</body>
</html>
