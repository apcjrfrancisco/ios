@extends('layouts.app')

@section('title', 'TM Search')

@section('content')

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h4>Searched Results</h4>
                    <div class="underline mb-4"></div>
                </div>

                @forelse ($searchProducts as $productItem)
                    <div class="col-md-10">
                        <div class="product-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="product-card-img">
                                        <label class="stock bg-danger">New</label>

                                        @if ($productItem->product_image)
                                            <a
                                                href="{{ url('/categories/' . $productItem->category->category_slug . '/' . $productItem->product_slug) }}">
                                                <img src="{{ asset($productItem->product_image) }}">
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="product-card-body">
                                        <p class="product-brand">{{ $productItem['brand']['brand_name'] }}</p>
                                        <h5 class="product-name">
                                            {{ $productItem->product_name }}
                                            </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price"><span
                                                    style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                {{ Str::currency($productItem->selling_price) }}</span>
                                        </div>
                                        <a href="{{ url('/categories/' . $productItem->category->category_slug . '/' . $productItem->product_slug) }}"
                                            class="btn btn-outline-primary">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 p-2">
                        <h4>No Products Found</h4>
                    </div>
                @endforelse

                <div>
                    {{ $searchProducts->appends(request()->input())->links() }}
                </div>

                <div class="text-center">
                    <a href="{{ url('/categories') }}" class="btn btn-warning px-3">Shop More</a>
                </div>

            </div>
        </div>
    </div>

@endsection
