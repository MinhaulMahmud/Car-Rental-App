@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Fleet Provider Dashboard</h2>
    <div class="mb-4">
        <a href="{{ route('fleet.cars.create') }}" class="btn btn-primary">Add New Car</a>
    </div>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Cars Listed</h5>
                    <p class="display-6">{{ $totalCars ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <p class="display-6">₹{{ number_format($totalRevenue ?? 0, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Your Cars</h5>
        </div>
        <div class="card-body p-0">
            @if($cars->count())
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Type</th>
                            <th>Price/Day</th>
                            <th>Availability</th>
                            <th>Times Rented</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cars as $car)
                        <tr>
                            <td>
                                @if($car->image)
                                    <img src="{{ asset('storage/' . $car->image) }}" alt="Car Image" width="80" height="50" style="object-fit:cover;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $car->name }}</td>
                            <td>{{ $car->brand }}</td>
                            <td>{{ $car->model }}</td>
                            <td>{{ $car->year }}</td>
                            <td>{{ $car->car_type }}</td>
                            <td>₹{{ number_format($car->daily_rent_price, 2) }}</td>
                            <td>
                                <form action="{{ route('fleet.cars.updateAvailability', $car) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="availability" onchange="this.form.submit()" class="form-select form-select-sm">
                                        <option value="1" {{ $car->availability ? 'selected' : '' }}>Available</option>
                                        <option value="0" {{ !$car->availability ? 'selected' : '' }}>Not Available</option>
                                    </select>
                                </form>
                            </td>
                            <td>{{ $car->rentals_count ?? $car->rentals->count() }}</td>
                            <td>
                                <a href="{{ route('fleet.cars.details', $car) }}" class="btn btn-info btn-sm mb-1">View</a>
                                <a href="{{ route('fleet.cars.edit', $car) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                                <form action="{{ route('fleet.cars.destroy', $car) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Remove this car from listing?')">Remove from Listing</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $cars->links() }}
            </div>
            @else
                <div class="p-4 text-center text-muted">No cars listed yet.</div>
            @endif
        </div>
    </div>
</div>
@endsection