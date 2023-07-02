@extends('layouts.app')

@section('main')

<div class="container">
    <div class="text-right">
        <a href="{{ route('products.create') }}" class="btn btn-dark mt-2">New Product</a>
    </div>
    <h3 class="text-muted text-center mb-4">This is All Product</h3>
    <table class="table table-hover mt-2">
        <thead class="thead-dark">
            <tr>
                <th>S.no</th>
                <th>
                    <a href="{{ route('products.index', ['sort_field' => 'name', 'sort_direction' => 'asc']) }}" class="text-light">Name</a>
                    <a href="{{ route('products.index', ['sort_field' => 'name', 'sort_direction' => 'desc']) }}" class="text-light">↑↓</a>
                </th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            $sno = ($products->currentPage() - 1) * $products->perPage() + 1;
            @endphp
            @foreach($products as $product)
            <tr>
                <td>{{ $sno++ }}</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="text-dark name-hover">{{ $product->name }}</a>
                </td>
                <td>
                    @php
                    $truncatedDescription = Str::limit($product->description, 50);
                    @endphp
                    <span data-toggle="tooltip" data-placement="top" title="{{ $product->description }}">
                        {{ $truncatedDescription }}
                    </span>
                </td>
                <td>
                    <img src="{{ asset('products/' . $product->image) }}" class="rounded-circle" width="30" height="30" />
                </td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-dark btn-sm">Edit</a>

                    <form method="POST" class="d-inline" action="{{ route('products.destroy', $product->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }

    .name-hover:hover {
        color: #ff6600;
    }
</style>

@endsection

@push('scripts')
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endpush