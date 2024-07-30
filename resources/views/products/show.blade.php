@extends('layout.app')

@section('title') Evara Dashboard @endsection

@section('content')

<section class="content-main">
            <div class="content-header">
                <div>
                    <h2 class="content-title card-title">{{ $product['title'] }}</h2>
                </div>
            </div>
            <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <img src="{{asset($product->image)}}" alt="{{ $product['title'] }}" class="card-img-top img-fluid">
                        <div class="card-body">
                            <p class="card-text">{{ $product['description'] }}</p>
                            <ul class="list-group">
                                <li class="list-group-item">Brand : {{ $product->brand->name }}</li>
                                <li class="list-group-item">Price : {{ $product['price'] }}</li>
                                <li class="list-group-item">Category : {{ $product->category->name }}</li>
                                <li class="list-group-item">Views : {{ $product->views }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section> <!-- content-main end// -->

@endsection
