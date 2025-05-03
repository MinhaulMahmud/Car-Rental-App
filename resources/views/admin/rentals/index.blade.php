@extends('layouts.app')

@section('title')
    Manage Rentals
@endsection

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Manage Rentals</h2>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Car</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Cost</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentals as $rental)
                <tr>
                    <td>{{ $rental->id }}</td>
                    <td>{{ $rental->user->name }}</td>
                    <td>{{ $rental->car->name }} ({{ $rental->car->brand }})</td>
                    <td>{{ $rental->start_date }}</td>
                    <td>{{ $rental->end_date }}</td>
                    <td>${{ $rental->total_cost }}</td>
                    <td>
                        @php
                            $startDateTime = \Carbon\Carbon::parse($rental->start_date)->startOfDay();
                            $endDateTime = \Carbon\Carbon::parse($rental->end_date)->endOfDay();
                            $now = \Carbon\Carbon::now();
                            
                            $status = 'Unknown';
                            if ($now->lt($startDateTime)) {
                                $status = '<span class="badge bg-info">Yet To Start</span>';
                            } elseif ($now->between($startDateTime, $endDateTime)) {
                                $status = '<span class="badge bg-warning">Ongoing</span>';
                            } else {
                                $status = '<span class="badge bg-success">Completed</span>';
                            }
                        @endphp
                        {!! $status !!}
                    </td>
                    <td>
                        @php
                            $startDateTime = \Carbon\Carbon::parse($rental->start_date)->startOfDay();
                            $now = \Carbon\Carbon::now();
                        @endphp
                        @if ($now->lt($startDateTime))
                            <a href="{{ route('rentals.edit', $rental->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('rentals.destroy', $rental->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @else
                            <span class="text-muted">Non Actionable</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
