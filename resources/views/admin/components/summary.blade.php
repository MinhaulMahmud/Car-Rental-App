<div class="container-fluid p-4">
    <!-- Main Stats Row -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Cars</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCars }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-car fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Admin Earnings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($totalAdminEarnings ?? 0, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Rentals</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRentals }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Available Cars</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $availableCars }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-car-side fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings Overview & Recent Rentals -->
    <div class="row">
        <!-- Earnings Overview -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="earningsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Rentals -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Rentals</h6>
                </div>
                <div class="card-body">
                    @foreach($recentRentals as $rental)
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="mb-1">{{ $rental->user->name }}</h6>
                            <small class="text-muted">{{ $rental->car->model }}</small>
                        </div>
                        <div class="text-right">
                            <div>${{ number_format($rental->total_cost, 2) }}</div>
                            <small class="text-muted">{{ $rental->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Car Status & Distribution -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Car Status Distribution</h6>
                </div>
                <div class="card-body">
                    <canvas id="carStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- User-Car Listings -->
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">User-Car Listings</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Vendor</th>
                                <th>Car Name</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Year</th>
                                <th>Type</th>
                                <th>Daily Rent Price</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($carsWithUsers as $car)
                            <tr>
                                <td>{{ $car->user->name ?? 'N/A' }}</td>
                                <td>{{ $car->user->role ?? 'N/A' }}</td>
                                <td class="font-weight-bold">{{ $car->name }}</td>
                                <td>{{ $car->brand }}</td>
                                <td>{{ $car->model }}</td>
                                <td>{{ $car->year }}</td>
                                <td>{{ $car->car_type }}</td>
                                <td>${{ number_format($car->daily_rent_price, 2) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Earnings Chart
const earningsCtx = document.getElementById('earningsChart').getContext('2d');
new Chart(earningsCtx, {
    type: 'bar',
    data: {
        labels: ['Admin Cars', 'Fleet Provider', 'Car Owners'],
        datasets: [{
            label: 'Earnings Distribution',
            data: [{{ $adminEarnings ?? 0 }}, {{ $fleetProviderEarnings ?? 0 }}, {{ $ownerEarnings ?? 0 }}],
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
            borderWidth: 1
        }]
    },
    options: {
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Car Status Chart
const statusCtx = document.getElementById('carStatusChart').getContext('2d');
new Chart(statusCtx, {
    type: 'doughnut',
    data: {
        labels: ['Available', 'Rented', 'Maintenance'],
        datasets: [{
            data: [
                {{ $carStatus['available'] ?? 0 }},
                {{ $carStatus['rented'] ?? 0 }},
                {{ $carStatus['maintenance'] ?? 0 }}
            ],
            backgroundColor: ['#1cc88a', '#4e73df', '#f6c23e']
        }]
    },
    options: {
        maintainAspectRatio: false,
    }
});
</script>
@endpush
