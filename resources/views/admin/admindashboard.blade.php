@extends('layouts.app')
@section('title')
	Dashboard
@endsection

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Admin Dashboard</h1>

        <div class="row">
            <!-- Total Number of Cars -->
            <div class="col-md-3 mb-4">
                <div class="card border-primary text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Cars</h5>
                        <p class="card-text display-4">{{ $totalCars }}</p>
                    </div>
                </div>
            </div>

            <!-- Number of Available Cars -->
            <div class="col-md-3 mb-4">
                <div class="card border-success text-center">
                    <div class="card-body">
                        <h5 class="card-title">Available Cars</h5>
                        <p class="card-text display-4">{{ $availableCars }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Number of Rentals -->
            <div class="col-md-3 mb-4">
                <div class="card border-warning text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Rentals</h5>
                        <p class="card-text display-4">{{ $totalRentals }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Earnings from Rentals -->
            <div class="col-md-3 mb-4">
                <div class="card border-info text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Earnings</h5>
                        <p class="card-text display-4">${{ number_format($totalEarnings, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
