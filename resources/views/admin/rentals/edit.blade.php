@extends('layouts.app')

@section('title')
    Edit Rental
@endsection

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Edit Rental</h2>

    <form action="{{ route('rentals.update', $rental->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer</label>
            <input type="text" id="customer_name" class="form-control" value="{{ $rental->user->name }}" disabled>
        </div>

        <div class="mb-3">
            <label for="car_id" class="form-label">Car</label>
            <select name="car_id" id="car_id" class="form-control">
                @foreach ($cars as $car)
                    <option value="{{ $car->id }}" {{ $rental->car_id == $car->id ? 'selected' : '' }}>
                        {{ $car->name }} ({{ $car->brand }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $rental->start_date }}">
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $rental->end_date }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Rental</button>
    </form>
</div>
@endsection
