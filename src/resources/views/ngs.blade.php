<!DOCTYPE html>
<html>
<head>
    <title>Результаты парсинга статей с NGS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .article-modal .modal-dialog {
            max-width: 90%;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Результаты парсинга статей с NGS</h1>

    <ul class="list-group">
        @foreach ($articles as $article)
            <li class="list-group-item mb-4">
                <h2 class="article-heading" data-toggle="modal" data-target="#articleModal{{ $loop->index }}">
                    <a href="">{{ $article['heading'] }}</a>
                </h2>
                <p>{{ $article['text'] }}</p>
                <img src="{{ $article['image'] }}" class="img-fluid w-50" alt="Изображение статьи">
                <p class="text-muted">{{ $article['date'] }}</p>
            </li>

            <!-- Modal -->
            <div class="modal fade article-modal" id="articleModal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="articleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="articleModalLabel">{{ $article['heading'] }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <img class="w-75" src="{{ $article['image'] }}">
                        <div class="modal-body">
                            {{ $article['full_text'] }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('.article-heading').click(function () {
            var target = $(this).data('target');
            $(target).modal('show');
        });
    });
</script>

</body>
</html>
