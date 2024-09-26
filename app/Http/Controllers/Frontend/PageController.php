<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $query = Car::query()->where('availability', true); // Only show available cars

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

        $cars = $query->get();

        return view('frontend.home', compact('cars'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
