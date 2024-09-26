
<div class="container">
    <h1 class="text-center my-5 text-primary">Your Rentals</h1>
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Car</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Cost</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($rentals as $rental)
                <tr>
                    <td>{{ $rental->car->name }}</td>
                    <td>{{ $rental->start_date }}</td>
                    <td>{{ $rental->end_date }}</td>
                    <td>${{ $rental->total_cost }}</td>
                    <td>
                        @if(now()->lt($rental->start_date))  {{-- Yet to start --}}
                            Yet To Start
                        @elseif(now()->between($rental->start_date, $rental->end_date))  {{-- Ongoing --}}
                            Ongoing
                        @else  {{-- Completed --}}
                            Completed
                        @endif
                    </td>
                    <td>
                        @if(now()->lt($rental->start_date))  {{-- Only allow cancellation before it starts --}}
                            <a href="{{ route('rentals.cancel', $rental->id) }}" class="btn btn-sm btn-danger">Cancel</a>
                        @else
                            Not Cancelable
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
