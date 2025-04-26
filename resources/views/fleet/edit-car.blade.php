@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Edit Car</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('fleet.cars.update', $car) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Car Name</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $car->name) }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input id="brand" name="brand" type="text" class="form-control" value="{{ old('brand', $car->brand) }}" required>
                            @error('brand')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="model" class="form-label">Model</label>
                            <input id="model" name="model" type="text" class="form-control" value="{{ old('model', $car->model) }}" required>
                            @error('model')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input id="year" name="year" type="number" class="form-control" value="{{ old('year', $car->year) }}" required>
                            @error('year')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="car_type" class="form-label">Car Type</label>
                            <select id="car_type" name="car_type" class="form-select" required>
                                <option value="SUV" {{ old('car_type', $car->car_type) == 'SUV' ? 'selected' : '' }}>SUV</option>
                                <option value="Sedan" {{ old('car_type', $car->car_type) == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                                <option value="Hatchback" {{ old('car_type', $car->car_type) == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                                <option value="Convertible" {{ old('car_type', $car->car_type) == 'Convertible' ? 'selected' : '' }}>Convertible</option>
                                <option value="Coupe" {{ old('car_type', $car->car_type) == 'Coupe' ? 'selected' : '' }}>Coupe</option>
                            </select>
                            @error('car_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="daily_rent_price" class="form-label">Daily Rent Price</label>
                            <input id="daily_rent_price" name="daily_rent_price" type="number" class="form-control" value="{{ old('daily_rent_price', $car->daily_rent_price) }}" required>
                            @error('daily_rent_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="availability" class="form-label">Availability</label>
                            <select id="availability" name="availability" class="form-select" required>
                                <option value="1" {{ old('availability', $car->availability) == true ? 'selected' : '' }}>Available</option>
                                <option value="0" {{ old('availability', $car->availability) == false ? 'selected' : '' }}>Not Available</option>
                            </select>
                            @error('availability')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Car Image</label>
                            <input id="image" name="image" type="file" class="form-control" accept="image/*">
                            @if($car->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $car->image) }}" alt="Car Image" width="120" style="object-fit:cover;">
                                </div>
                            @endif
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Update Car</button>
                        <a href="{{ route('fleet.dashboard') }}" class="btn btn-secondary ms-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
