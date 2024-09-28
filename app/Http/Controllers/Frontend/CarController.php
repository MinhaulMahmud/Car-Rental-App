<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
{
    $query = Car::query();

    // Handle search
    if ($request->has('search') && $request->search != '') {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('brand', 'like', '%' . $request->search . '%')
              ->orWhere('car_type', 'like', '%' . $request->search . '%');
        });
    }

    // Handle sorting
    if ($request->has('sort') && $request->sort != '') {
        if ($request->sort == 'price_asc') {
            $query->orderBy('daily_rent_price', 'asc');
        } elseif ($request->sort == 'price_desc') {
            $query->orderBy('daily_rent_price', 'desc');
        } elseif ($request->sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($request->sort == 'name_desc') {
            $query->orderBy('name', 'desc');
        }
    }

    // Fetch cars with pagination
    $cars = $query->where('availability', true)->paginate(10); // Replace get() with paginate()

    return view('frontend.cars', compact('cars'));
}


    public function show($id)
    {
        $car = Car::findOrFail($id);  // Find the car by ID or throw a 404 error if not found
        return view('frontend.car_details', compact('car'));
    }
}
