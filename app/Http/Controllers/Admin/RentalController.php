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

    public function create()
    {
        $cars = Car::all();
        $customers = User::where('role', 'customer')->get();

        return view('admin.rentals.create', compact('cars', 'customers'));
    }

    public function store(Request $request)
    {
        // Validate rental data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:Ongoing,Completed,Canceled',
        ]);

        // Fetch the car to get the daily rent price
        $car = Car::findOrFail($request->car_id);

        // Calculate total rental days
        $start_date = new \DateTime($request->start_date);
        $end_date = new \DateTime($request->end_date);
        $total_days = $end_date->diff($start_date)->days + 1; // Include the start and end date

        // Calculate the total cost
        $total_cost = $total_days * $car->daily_rent_price;

        // Add total_cost to the validated data
        $validatedData['total_cost'] = $total_cost;

        // Create new rental
        Rental::create($validatedData);

        return redirect()->route('admin.rentals.index')->with('status', 'Rental added successfully. Total cost: ' . $total_cost);
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
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:Ongoing,Completed,Canceled',
        ]);

        // Fetch the car to get the daily rent price
        $car = Car::findOrFail($request->car_id);

        // Calculate total rental days
        $start_date = new \DateTime($request->start_date);
        $end_date = new \DateTime($request->end_date);
        $total_days = $end_date->diff($start_date)->days + 1; // Include the start and end date

        // Calculate the total cost
        $total_cost = $total_days * $car->daily_rent_price;

        // Add total_cost to the validated data
        $validatedData['total_cost'] = $total_cost;

        // Update the rental
        $rental->update($validatedData);

        return redirect()->route('admin.rentals.index')->with('status', 'Rental updated successfully. Total cost: ' . $total_cost);
    }

    public function destroy(Rental $rental)
    {
        $rental->delete();

        return redirect()->route('admin.rentals.index')->with('status', 'Rental deleted successfully.');
    }
}
