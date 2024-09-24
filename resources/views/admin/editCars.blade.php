@extends('layouts.app')

@section('content')

    <div class="container">
    <h2 class="mb-4">Edit Car</h2>

    <!-- Edit Car Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Edit Car</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('cars.update', $car->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="car_id" id="car_id" value="{{ $car->id }}">

                <div class="mb-3">
                    <label for="name" class="form-label">Car Name</label>
                    <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $car->name) }}" required>
                    @error('car_name')
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
                    <label for="year" class="form-label">Year of Manufacture</label>
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
                    <label for="availability" class="form-label">Availability Status</label>
                    <select id="availability" name="availability" class="form-select" required>
                        <option value="1" {{ old('availability', $car->availability) == true ? 'selected' : '' }}>Available</option>
                        <option value="0" {{ old('availability', $car->availability) == false ? 'selected' : '' }}>Not Available</option>
                    </select>
                    @error('availability')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Display existing image when editing -->
                @if(isset($car->image))
                    <div class="mb-3">
                        <label for="existing_image" class="form-label">Current Image</label>
                        <div>
                        <img src="{{ asset($car->image) }}" alt="Car Image" class="img-thumbnail" style="width: 150px;">
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="image" class="form-label">Car Image</label>
                    <input id="image" name="image" type="file" class="form-control" accept="image/*" onchange="validateImageSize(this)">
                    <span id="image-error" class="text-danger d-none">File size exceeds the allowed limit of 2MB.</span>
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Car</button>
            </form>
        </div>
    </div>
    </div>

@endsection