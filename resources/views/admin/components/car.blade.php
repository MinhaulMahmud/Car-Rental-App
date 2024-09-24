<div class="container">
    <h2 class="mb-4">Manage Cars</h2>

    <!-- Add/Edit Car Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Add/Edit Car</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('cars.storeOrUpdate') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="car_id" id="car_id" value="{{ old('car_id') }}">

                <div class="mb-3">
                    <label for="car_name" class="form-label">Car Name</label>
                    <input id="car_name" name="car_name" type="text" class="form-control" value="{{ old('car_name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="brand" class="form-label">Brand</label>
                    <input id="brand" name="brand" type="text" class="form-control" value="{{ old('brand') }}" required>
                </div>

                <div class="mb-3">
                    <label for="model" class="form-label">Model</label>
                    <input id="model" name="model" type="text" class="form-control" value="{{ old('model') }}" required>
                </div>

                <div class="mb-3">
                    <label for="year" class="form-label">Year of Manufacture</label>
                    <input id="year" name="year" type="number" class="form-control" value="{{ old('year') }}" required>
                </div>

                <div class="mb-3">
                    <label for="car_type" class="form-label">Car Type</label>
                    <select id="car_type" name="car_type" class="form-select" required>
                        <option value="SUV">SUV</option>
                        <option value="Sedan">Sedan</option>
                        <option value="Hatchback">Hatchback</option>
                        <option value="Convertible">Convertible</option>
                        <option value="Coupe">Coupe</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="daily_rent_price" class="form-label">Daily Rent Price</label>
                    <input id="daily_rent_price" name="daily_rent_price" type="number" class="form-control" value="{{ old('daily_rent_price') }}" required>
                </div>

                <div class="mb-3">
                    <label for="availability" class="form-label">Availability Status</label>
                    <select id="availability" name="availability" class="form-select" required>
                        <option value="Available">Available</option>
                        <option value="Not Available">Not Available</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="car_image" class="form-label">Car Image</label>
                    <input id="car_image" name="car_image" type="file" class="form-control" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Save Car</button>
            </form>
        </div>
    </div>

    <!-- Cars Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Existing Cars</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Car Name</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Type</th>
                        <th>Daily Rent Price</th>
                        <th>Availability</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars as $car)
                    <tr>
                        <td>{{ $car->car_name }}</td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->year }}</td>
                        <td>{{ $car->car_type }}</td>
                        <td>${{ $car->daily_rent_price }}</td>
                        <td>{{ $car->availability }}</td>
                        <td>
                            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this car?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>