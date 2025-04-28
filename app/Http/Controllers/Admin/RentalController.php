<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with('car', 'user')->get();
        return view('admin.rentals.index', compact('rentals'));
    }

    public function edit(Rental $rental)
    {
        $cars = Car::all();
        $customers = User::where('role', 'customer')->get();
        return view('admin.rentals.edit', compact('rental', 'cars', 'customers'));
    }

    public function update(Request $request, Rental $rental)
    {
        // Validate rental data
        $validatedData = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Fetch the car to get the daily rent price
        $car = Car::findOrFail($request->car_id);
        // Calculate total rental days
        $start_date = \Carbon\Carbon::parse($request->start_date)->startOfDay();
        $end_date = \Carbon\Carbon::parse($request->end_date)->endOfDay();
        $total_days = $start_date->diffInDays($end_date) + 1;

        // Calculate the total cost
        $total_cost = $total_days * $car->daily_rent_price;

        // Add total_cost to the validated data
        $validatedData['total_cost'] = $total_cost;

        // Update the rental
        $rental->update($validatedData);

        return redirect()->route('rentals.index')->with('status', 'Rental updated successfully. Total cost: ' . $total_cost);
    }

    public function destroy(Rental $rental)
    {
        $rental->delete();
        return redirect()->route('rentals.index')->with('status', 'Rental deleted successfully.');
    }
}

