@extends('layouts.app')
@section('title')
    {{ $customer->name }}'s Rental History
@endsection

@section('content')
<div class="container mt-4">
    <h1>{{ $customer->name }}'s Rental History</h1>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Rental ID</th>
                    <th>Car Name</th>
                    <th>Brand</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Cost</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rentalHistory as $rental)
                <tr>
                    <td>{{ $rental->id }}</td>
                    <td>{{ $rental->car->name }}</td>
                    <td>{{ $rental->car->brand }}</td>
                    <td>{{ $rental->start_date }}</td>
                    <td>{{ $rental->end_date }}</td>
                    <td>${{ $rental->total_cost }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back to Customers</a>
</div>
@endsection
