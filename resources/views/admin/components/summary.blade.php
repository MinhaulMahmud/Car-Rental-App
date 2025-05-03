<div class="container-fluid py-4">
    <!-- Main Stats Row -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-car fa-2x text-primary"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-primary text-uppercase small">Total Cars</div>
                        <div class="fs-4 fw-bold text-dark">{{ $totalCars }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-dollar-sign fa-2x text-success"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-success text-uppercase small">Admin Earnings</div>
                        <div class="fs-4 fw-bold text-dark">${{ number_format($totalAdminEarnings ?? 0, 2) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-clipboard-list fa-2x text-info"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-info text-uppercase small">Total Rentals</div>
                        <div class="fs-4 fw-bold text-dark">{{ $totalRentals }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-car-side fa-2x text-warning"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-warning text-uppercase small">Available Cars</div>
                        <div class="fs-4 fw-bold text-dark">{{ $availableCars }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Rentals -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <h6 class="mb-0 fw-bold text-primary"><i class="fas fa-history me-2"></i>Recent Rentals</h6>
                </div>
                <div class="card-body">
                    @forelse($recentRentals as $rental)
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                            <div>
                                <div class="fw-bold">{{ $rental->user->name }}</div>
                                <div class="text-muted small">{{ $rental->car->model }}</div>
                            </div>
                            <div class="text-end">
                                <div class="fw-bold text-success">${{ number_format($rental->total_cost, 2) }}</div>
                                <div class="text-muted small">{{ $rental->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted">No recent rentals found.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- User Sales Statistics -->
    <div class="row g-4 mt-1">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-chart-line me-2"></i>User Sales Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>User Name</th>
                                    <th>Role</th>
                                    <th>Total Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $users = collect($carsWithUsers)->pluck('user')->filter()->unique('id');
                            @endphp
                            @forelse($users as $user)
                                @php
                                    $userCars = $carsWithUsers->where('user_id', $user->id);
                                    $userSales = 0;
                                    foreach($userCars as $car) {
                                        $userSales += $car->rentals->sum('total_cost');
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        <span class="badge bg-secondary text-capitalize">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success">${{ number_format($userSales, 2) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No user sales data found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
