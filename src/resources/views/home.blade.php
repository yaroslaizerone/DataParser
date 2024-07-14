<!DOCTYPE html>
<html>
<head>
    <title>Data Fetcher</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Выберите источник данных</h1>
    <form action="{{ route('fetch.data') }}" method="GET">
        <div class="form-group">
            <label for="source">Источник данных:</label>
            <select class="form-control" id="source" name="source">
                <option value="ngs">НГС Новости</option>
                <option value="ria">Риа Новости</option>
                <option value="yandex">Яндекс погода</option>
                <option value="slamjam">SlamJam</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Получить данные</button>
    </form>
</div>
</body>
</html>
