<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $cars = Car::query();

        // Filters for car type, brand, daily rent price
        if ($request->has('car_type')) {
            $cars->where('car_type', $request->car_type);
        }
        if ($request->has('brand')) {
            $cars->where('brand', $request->brand);
        }
        if ($request->has('daily_rent_price')) {
            $cars->where('daily_rent_price', '<=', $request->daily_rent_price);
        }

        $cars = $cars->where('availability', true)->get();

        return view('frontend.cars', compact('cars'));
    }

    
}
