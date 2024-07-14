<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Магазин SlamJam</h1>
    <div class="row">
        @foreach ($products as $index => $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-img-top position-relative">
                        <img src="{{ $product['image_urls'][0] }}" class="img-fluid" alt="Product Image">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product['product_name'] }}</h5>
                        <p class="card-text">Vendor: {{ $product['vendor'] }}</p>
                        <p class="card-text">Price: {{ $product['price_regular'] }}</p>

                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                data-target="#quickShopModal{{ $index }}">View Product
                        </button>
                    </div>
                </div>
            </div>

            <!-- Модальное окно быстрого просмотра -->
            <div class="modal fade" id="quickShopModal{{ $index }}" tabindex="-1"
                 aria-labelledby="quickShopModalLabel{{ $index }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="quickShopModalLabel{{ $index }}">Quick Shop
                                - {{ $product['product_name'] }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ $product['image_urls'][0] }}" class="img-fluid" alt="Product Image">
                            <h5 class="mt-3">{{ $product['product_name'] }}</h5>
                            <p>Vendor: {{ $product['vendor'] }}</p>
                            <p>Price: {{ $product['price_regular'] }} </p>
                            <a href="{{ $product['product_link'] }}" target="_blank" class="btn btn-primary">View
                                Product</a>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Add to cart</button>
                        </div>
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
