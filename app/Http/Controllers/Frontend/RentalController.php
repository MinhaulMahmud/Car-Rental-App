<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    public function index()
    {
        // Fetch rentals for the authenticated user
        $rentals = Rental::where('user_id', Auth::id()) // Use 'user_id' instead of 'id'
                        ->with('car') 
                        ->get();
    
        return view('frontend.customer.dashboard', compact('rentals'));
    }

    // Method to book a car (already implemented)
    public function book($carId)
    {
        $car = Car::findOrFail($carId); // Get car details
        return view('frontend.book', compact('car'));
    }

    // Store method to handle booking (already implemented)
    public function store(Request $request, $carId)
{
    // Validate the request data
    $request->validate([
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
    ]);

    // Find the car using the given ID
    $car = Car::findOrFail($carId);

    // Check if the car is available for booking
    if (!$car->availability) {
        return back()->with('error', 'This car is not available for the selected dates.');
    }

    // Calculate the total cost of the rental
    $days = \Carbon\Carbon::parse($request->start_date)->diffInDays(\Carbon\Carbon::parse($request->end_date)) + 1;
    $totalCost = $car->daily_rent_price * $days;

    // Create a new rental record in the database
    Rental::create([
        'user_id' => Auth::id(),  // Corrected to use 'user_id'
        'car_id' => $car->id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'total_cost' => $totalCost,
    ]);

    // Redirect back to the home page with a success message
    return redirect()->route('home')->with('success', 'Car booked successfully!');
}
    public function cancel($id)
{
    // Fetch the rental by ID
    $rental = Rental::where('id', $id)
                    ->where('user_id', Auth::id()) 
                    // Take
                    ->firstOrFail();

    // Check if the rental is ongoing
    $rental->delete();

        // Redirect back with a success message
        return redirect()->back()->with('status', 'Rental canceled successfully.');
    }

    
// rentals update funtion   

}