<!DOCTYPE html>
<html>
<head>
    <title>Результаты парсинга статей с NGS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Результаты парсинга статей с RIA</h1>

    <ul class="list-group">
        @foreach ($articles as $article)
            <li class="list-group-item mb-4">
                <h2>{{ $article['heading'] }}</h2>
                <img src="{{ $article['image'] }}" class="img-fluid w-50" alt="Изображение статьи">
                <p class="text-muted">{{ $article['date'] }}</p>
            </li>
        @endforeach
    </ul>
</div>
</body>
</html>
