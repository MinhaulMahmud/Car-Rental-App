@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-5 text-primary">Browse Cars</h1>
    <div class="row">
        @foreach($cars as $car)
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg">
                <img  src="{{asset($car->image)}}" class="card-img-rounded"  alt="{{ $car->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $car->name }} - {{ $car->brand }}</h5>
                    <p class="card-text">{{ $car->car_type }} | {{ $car->daily_rent_price }} $/day</p>
                    @auth
                        <a href="{{ route('rentals.book', $car->id) }}" class="btn btn-primary">Book Now</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-secondary">Login to Book</a>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endSection