<div class="container">
    <h1 class="text-center my-5 text-primary">Browse Cars</h1>

    <!-- Search and Sort Form -->
    <form action="{{ route('home') }}" method="GET" class="mb-5">
        <div class="row">
            <div class="col-md-8 mb-3 mb-md-0">
                <input type="text" name="search" class="form-control" placeholder="Search cars by name, brand or type" value="{{ request()->search }}">
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <select name="sort" class="form-select form-select-sm">
                    <option value="">Sort by</option>
                    <option value="price_asc" {{ request()->sort == 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                    <option value="price_desc" {{ request()->sort == 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
                    <option value="name_asc" {{ request()->sort == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                    <option value="name_desc" {{ request()->sort == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100">Go</button>
            </div>
        </div>
    </form>

    <!-- Cars Grid -->
    <div class="row">
        @foreach($cars as $car)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <img src="{{ asset($car->image) }}" class="card-img-top" alt="{{ $car->name }}" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title text-dark">{{ $car->name }} - <span class="text-muted">{{ $car->brand }}</span></h5>
                    <p class="card-text text-muted">{{ $car->car_type }} | <strong class="text-primary">${{ $car->daily_rent_price }}</strong> / day</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- View Button triggers Modal -->
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#carModal{{ $car->id }}">View</button>
                        
                        @auth
                            <a href="{{ route('rentals.book', $car->id) }}" class="btn btn-primary btn-sm">Book Now</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">Login to Book</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for each car -->
        <div class="modal fade" id="carModal{{ $car->id }}" tabindex="-1" aria-labelledby="carModalLabel{{ $car->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="carModalLabel{{ $car->id }}">{{ $car->name }} - {{ $car->brand }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ asset($car->image) }}" class="img-fluid rounded shadow-sm" alt="{{ $car->name }}">
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Car Details</strong></h6>
                                <p><strong>Type:</strong> {{ $car->car_type }}</p>
                                <p><strong>Model:</strong> {{ $car->model }}</p>
                                <p><strong>Year:</strong> {{ $car->year }}</p>
                                <p><strong>Price:</strong> ${{ $car->daily_rent_price }} / day</p>
                                <p><strong>Brand:</strong> {{ $car->brand }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        @auth
                            <a href="{{ route('rentals.book', $car->id) }}" class="btn btn-primary">Book Now</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-secondary">Login to Book</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
