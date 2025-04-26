@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h2>{{ $car->name }} Details</h2>
        <a href="{{ route('fleet.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Car Details -->
    <div class="card mb-4">
        <div class="card-body d-flex flex-wrap">
            <div class="flex-grow-1">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Brand:</strong> {{ $car->brand }}</p>
                        <p><strong>Model:</strong> {{ $car->model }}</p>
                        <p><strong>Year:</strong> {{ $car->year }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Type:</strong> {{ $car->car_type }}</p>
                        <p><strong>Daily Rate:</strong> ${{ number_format($car->daily_rent_price, 2) }}</p>
                        <p><strong>Total Revenue:</strong> ${{ number_format($totalRevenue, 2) }}</p>
                    </div>
                </div>
                <div class="mt-3">
                    <button onclick="toggleEditForm()" class="btn btn-primary">Edit Details</button>
                </div>
            </div>
            <div class="ms-4">
                <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" width="220" height="220" style="object-fit:cover; border-radius:8px;">
            </div>
        </div>
    </div>

    <!-- Edit Form (Hidden by default) -->
    <div id="editForm" class="card mb-4" style="display:none;">
        <div class="card-body">
            <h4 class="mb-3">Edit Car Details</h4>
            <form action="{{ route('fleet.cars.update', $car) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="{{ $car->name }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Brand</label>
                        <input type="text" name="brand" value="{{ $car->brand }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Model</label>
                        <input type="text" name="model" value="{{ $car->model }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Year</label>
                        <input type="number" name="year" value="{{ $car->year }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Car Type</label>
                        <input type="text" name="car_type" value="{{ $car->car_type }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Daily Rent Price</label>
                        <input type="number" step="0.01" name="daily_rent_price" value="{{ $car->daily_rent_price }}" class="form-control" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Car Image (Leave empty to keep current image)</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Update Car</button>
                <button type="button" onclick="toggleEditForm()" class="btn btn-secondary ms-2">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Rental History -->
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3">Rental History</h4>
            @if($rentals->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rentals as $rental)
                                <tr>
                                    <td>{{ $rental->user->name }}</td>
                                    <td>{{ $rental->start_date }}</td>
                                    <td>{{ $rental->end_date }}</td>
                                    <td>${{ number_format($rental->total_cost, 2) }}</td>
                                    <td>{{ ucfirst($rental->status) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $rentals->links() }}
                </div>
            @else
                <p class="text-muted">No rental history available for this car.</p>
            @endif
        </div>
    </div>
</div>

<script>
    function toggleEditForm() {
        var form = document.getElementById('editForm');
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    }
</script>
@endsection