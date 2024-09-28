@extends('frontend.layouts.app')

@section('title')
    Cars
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Available Cars</h1>

    <!-- Search and Sort Buttons -->
    <div class="row mb-4">
        <div class="col-md-8">
            <form method="GET" action="{{ route('cars.index') }}" class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by name or brand..." value="{{ request('search') }}">
                <select name="sort_by" class="form-select">
                    <option value="">Sort By</option>
                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="brand" {{ request('sort_by') == 'brand' ? 'selected' : '' }}>Brand</option>
                    <option value="daily_rent_price" {{ request('sort_by') == 'daily_rent_price' ? 'selected' : '' }}>Price</option>
                </select>
                <select name="sort_order" class="form-select">
                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
                <button type="submit" class="btn btn-primary">Search & Sort</button>
            </form>
        </div>
    </div>

    <!-- Car List in Column View -->
    <ul class="list-group">
        @foreach ($cars as $car)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <img src="{{ asset($car->image) }}" alt="{{ $car->name }}" class="img-thumbnail me-3" style="height: 100px; width: 150px; object-fit: cover;">
                <div>
                    <h5 class="mb-1">{{ $car->name }}</h5>
                    <p class="mb-1"><strong>Brand:</strong> {{ $car->brand }}</p>
                    <p class="mb-1"><strong>Price:</strong> ${{ $car->daily_rent_price }}/day</p>
                </div>
            </div>
            <a href="{{ route('frontend.cars.show', $car->id) }}" class="btn btn-info">View Details</a>
        </li>
        @endforeach
    </ul>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $cars->appends(request()->query())->links() }}
    </div>
</div>
@endsection
