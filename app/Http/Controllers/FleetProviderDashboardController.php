<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FleetProviderDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cars = Car::where('user_id', $user->id)
            ->withCount('rentals')
            ->latest()
            ->paginate(10);
        
        // Get total revenue using the correct column name 'total_cost'
        $totalRevenue = $user->cars()
            ->join('rentals', 'cars.id', '=', 'rentals.car_id')
            ->sum('rentals.total_cost');

        return view('fleet.dashboard', [
            'cars' => $cars,
            'totalRevenue' => $totalRevenue,
            'totalCars' => $cars->total(),
        ]);
    }

    public function create()
    {
        return view('fleet.create-car');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'car_type' => 'required|string|max:255',
            'daily_rent_price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cars', 'public');
            $validated['image'] = $imagePath;
        }

        $validated['user_id'] = $user->id;
        $validated['availability'] = true;

        Car::create($validated);

        return redirect()->route('fleet.dashboard')->with('success', 'Car added to fleet successfully.');
    }

    public function update(Request $request, Car $car)
    {
        $user = Auth::user();
        
        if ($car->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'car_type' => 'required|string|max:255',
            'daily_rent_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cars', 'public');
            $validated['image'] = $imagePath;
        }

        $car->update($validated);

        return redirect()->route('fleet.dashboard')->with('success', 'Car updated successfully.');
    }

    public function edit(Car $car)
    {
        $user = Auth::user();
        if ($car->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
        return view('fleet.edit-car', compact('car'));
    }

    public function updateAvailability(Request $request, Car $car)
    {
        $user = Auth::user();
        if ($car->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
        $validated = $request->validate([
            'availability' => 'required|boolean',
        ]);
        $car->availability = $validated['availability'];
        $car->save();
        return redirect()->route('fleet.dashboard')->with('success', 'Car availability updated successfully.');
    }

    public function destroy(Car $car)
    {
        $user = Auth::user();
        if ($car->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
        $car->delete();
        return redirect()->route('fleet.dashboard')->with('success', 'Car deleted successfully.');
    }

    public function carDetails(Car $car)
    {
        $user = Auth::user();
        
        if ($car->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $rentals = $car->rentals()->with('user')->latest()->paginate(10);
        $totalRevenue = $car->rentals()->sum('total_cost');

        return view('fleet.car-details', [
            'car' => $car,
            'rentals' => $rentals,
            'totalRevenue' => $totalRevenue,
        ]);
    }
}
