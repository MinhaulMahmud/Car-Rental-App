@extends('frontend.layouts.app')

@section('title')
    {{ $car->name }} - Car Details
@endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="row g-0">
            <div class="col-md-6">
                <img src="{{ asset($car->image) }}" alt="{{ $car->name }}" class="img-fluid rounded-start h-100 object-fit-cover">
            </div>
            <div class="col-md-6">
                <div class="card-body p-4">
                    <h1 class="card-title display-4 fw-bold text-primary mb-4">{{ $car->name }}</h1>
                    <div class="mb-4">
                        <span class="badge bg-success fs-4 px-3 py-2">${{ $car->daily_rent_price }} / day</span>
                    </div>
                    <p class="card-text fs-5 mb-2"><i class="bi bi-car-front-fill me-2"></i><strong>Brand:</strong> {{ $car->brand }}</p>
                    <p class="card-text fs-5 mb-2"><i class="bi bi-tag-fill me-2"></i><strong>Car Type:</strong> {{ $car->car_type }}</p>
                    <p class="card-text fs-5 mb-4"><i class="bi bi-info-circle-fill me-2"></i><strong>Description:</strong></p>
                    <p class="card-text fs-6 mb-4">{{ $car->description }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-arrow-left-circle me-2"></i>Back to List
                        </a>
                        @auth
                            <a href="{{ route('rentals.book', $car->id) }}" class="btn btn-success btn-lg">
                                <i class="bi bi-calendar-check me-2"></i>Book Now
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-secondary btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login to Book
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<style>
    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }
    .card-title {
        color: #0056b3;
    }
    .badge {
        font-weight: normal;
    }
</style>
@endsection