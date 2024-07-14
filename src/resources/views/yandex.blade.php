<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Прогноз погоды</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="my-4">Прогноз погоды</h1>
    <div class="row">
        @foreach ($forecasts as $forecast)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $forecast['date'] }}</h5>
                    <img src="{{ $forecast['icon_url'] }}">
                    <p class="card-text">{{ $forecast['condition'] }}</p>
                    <p class="card-text">Днём: {{ $forecast['temp_day'] }}°C</p>
                    <p class="card-text">Ночью: {{ $forecast['temp_night'] }}°C</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
