@extends('layouts.app')
@section('title')
    Edit Customer
@endsection

@section('content')
<div class="container mt-4">
    <h1>Edit Customer</h1>

    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Customer Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="number" class="form-label">Phone Number</label>
            <input type="text" name="number" class="form-control" value="{{ old('number', $customer->number) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Customer</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
