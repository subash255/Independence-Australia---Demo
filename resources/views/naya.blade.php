@extends('layouts.master')
@section('content')

    <div class="container">
        <h1>Products</h1>

        @if(count($products) > 0)
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ $product['image_url'] }}" class="card-img-top" alt="{{ $product['name'] }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product['name'] }}</h5>
                                <p class="card-text">{{ $product['description'] }}</p>
                                <p class="card-text"><strong>Price: </strong>{{ $product['price'] }}</p>
                                <a href="{{ $product['url'] }}" class="btn btn-primary">View Product</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No products found.</p>
        @endif
    </div>
@endsection
