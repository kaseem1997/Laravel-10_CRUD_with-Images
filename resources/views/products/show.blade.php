@extends('layouts.app')

@section('main')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8 mt-4">
            <div class="card p-4">
                <h3 class="mb-4 underline">Name: {{ $product->name }}</h3>
                <p class="mb-4">
                    <h4 class="underline">Description:</h4>
                    <span class="description">{{ $product->description }}</span>
                </p>
                <img src="/products/{{ $product->image }}" class="img-fluid rounded" alt="Product Image" />
                
                <a href="{{ route('products.index') }}" class="btn btn-dark mt-3">Back</a>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card p {
        font-size: 16px;
        color: #555;
    }

    .underline {
        text-decoration: underline;
    }

    .description {
        display: inline-block;
        transition: color 0.3s ease;
    }

    .description:hover {
        color: #ff6600;
    }

    .card img {
        max-width: 100%;
        height: auto;
    }
</style>

@endsection
