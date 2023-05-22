@extends('layouts.app')

@section('title')
TM {{ $category->category_name }}
@endsection

@section('content')

    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">Our Products</h4>
                </div>
                @forelse ($products as $item)
                    <div class="col-md-3">
                        <div class="product-card">
                            <div class="product-card-img">
                                @if ($item->quantity > 0)
                                    <label class="stock bg-success">In Stock</label>
                                @else
                                    <label class="stock bg-danger">Out of Stock</label>
                                @endif
                                <a href="{{ url('/categories/' . $item->category->category_slug . '/' . $item->product_slug) }}">
                                    <img src="{{ asset($item->product_image) }}" alt="Laptop">
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{ $item['brand']['brand_name'] }}</p>
                                <h5 class="product-name">
                                    {{ $item->product_name }}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price">${{ $item->selling_price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>No Products Available for {{ $category->category_name }}</h4>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
