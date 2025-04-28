<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $car = Car::where('user_id', $user->id)->first();
        
        // Calculate total revenue for the owner's car
        $totalRevenue = $car ? $car->rentals()->sum('total_cost') : 0;
        
        return view('owner.dashboard', [
            'car' => $car,
            'rentals' => $car ? $car->rentals()->with('user')->latest()->get() : collect(),
            'totalRevenue' => $totalRevenue,
        ]);
    }

    private function userHasCar($user)
    {
        return Car::where('user_id', $user->id)->exists();
    }

    public function create()
    {
        $user = Auth::user();
        
        // Check if user already has a car listed
        if ($this->userHasCar($user)) {
            return redirect()->route('owner.dashboard')->with('error', 'You can only list one car.');
        }

        return view('owner.create-car');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        // Check if user already has a car listed
        if ($this->userHasCar($user)) {
            return redirect()->back()->with('error', 'You can only list one car.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'car_type' => 'required|string|max:255',
            'daily_rent_price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('cars', 'public');
                $validated['image'] = $imagePath;
            }

            $validated['user_id'] = $user->id;
            $validated['availability'] = true;

            Car::create($validated);

            return redirect()->route('owner.dashboard')->with('success', 'Car listed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create car listing. Please try again.');
        }
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

        return redirect()->route('owner.dashboard')->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        $user = Auth::user();
        
        if ($car->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $car->delete();

        return redirect()->route('owner.dashboard')->with('success', 'Car listing removed successfully.');
    }
}
