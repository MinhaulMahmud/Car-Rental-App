<?php

namespace App\Http\Controllers;

use App\Models\Car; // Adjust according to your Car model namespace
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        // Validate and create a new car
        $validatedData = $request->validate([
            'car_name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'car_type' => 'required|string',
            'daily_rent_price' => 'required|numeric',
            'availability' => 'required|string',
            'car_image' => 'nullable|image|max:2048',
        ]);

        // Handle file upload and saving to the database here
        Car::create($validatedData);
        return redirect()->route('cars.index')->with('status', 'Car added successfully!');
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        // Validate and update the car
        $validatedData = $request->validate([
            'car_name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'car_type' => 'required|string',
            'daily_rent_price' => 'required|numeric',
            'availability' => 'required|string',
            'car_image' => 'nullable|image|max:2048',
        ]);

        // Handle file upload and updating the database here
        $car->update($validatedData);
        return redirect()->route('cars.index')->with('status', 'Car updated successfully!');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('status', 'Car deleted successfully!');
    }
}
n