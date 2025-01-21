<!DOCTYPE html>
<html>
<head>
    <title>Sales Index</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Available Sales</h1>
        <div class="row">
            @foreach ($sales as $sale)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('storage/' . $sale->image) }}" class="card-img-top" alt="{{ $sale->product }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $sale->product }}</h5>
                            <p class="card-text">{{ $sale->description }}</p>
                            <p class="card-text">Price: ${{ $sale->price }}</p>
                            <a href="#" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>