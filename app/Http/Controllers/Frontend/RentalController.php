<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use App\Mail\CarRentalConfirmation;
use Illuminate\Support\Facades\Mail;
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
    public function stored(Request $request, $carId)
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

    // Send an email to the user
    $rental = Rental::where('user_id', Auth::id())
                    ->where('car_id', $car->id)
                    ->first();
   
     Mail::to(Auth::user()->email)->send(new CarRentalConfirmation($rental));
    

    // Redirect back to the home page with a success message
    return redirect()->route('home')->with('success', 'Car booked successfully!');
    }

public function store(Request $request, $carId)
{
    // Validate the request data
    $request->validate([
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
    ]);

    // Find the car using the given ID
    $car = Car::findOrFail($carId);

    // Check if the car is available for the selected dates
    $overlappingRentals = Rental::where('car_id', $carId)
        ->where(function ($query) use ($request) {
            $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                ->orWhere(function ($query) use ($request) {
                    $query->where('start_date', '<=', $request->start_date)
                          ->where('end_date', '>=', $request->end_date);
                });
        })->exists();

    if ($overlappingRentals) {
        return back()->with('error', 'This car is already booked for the selected dates.');
    }

    // Calculate the total cost of the rental
    $days = \Carbon\Carbon::parse($request->start_date)->diffInDays(\Carbon\Carbon::parse($request->end_date)) + 1;
    $totalCost = $car->daily_rent_price * $days;

    // Create a new rental record in the database
    $rental = Rental::create([
        'user_id' => Auth::id(),
        'car_id' => $car->id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'total_cost' => $totalCost,
    ]);

    // Check if rental creation was successful
    if (!$rental) {
        return back()->with('error', 'Failed to create rental record.');
    }

    // Send email to the user
    $user = Auth::user(); // Get the authenticated user
    Mail::to($user->email)->send(new CarRentalConfirmation($rental, $car, $user));

    // Redirect back to the home page with a success message
    return redirect()->route('home')->with('success', 'Car booked successfully!');
}


// public function storeddd(Request $request, $carId)
// {
//     // Validate the request data
//     $request->validate([
//         'start_date' => 'required|date|after_or_equal:today',
//         'end_date' => 'required|date|after:start_date',
//     ]);

//     // Find the car using the given ID
//     $car = Car::findOrFail($carId);

//     // Check if the car is available for booking
//     if (!$car->availability) {
//         return response()->json(['error' => 'This car is not available for the selected dates.'], 400);
//     }

//     // Calculate the total cost of the rental
//     $days = \Carbon\Carbon::parse($request->start_date)->diffInDays(\Carbon\Carbon::parse($request->end_date)) + 1;
//     $totalCost = $car->daily_rent_price * $days;

//     // Create a new rental record in the database
//     $rental = Rental::create([
//         'user_id' => Auth::id(),
//         'car_id' => $car->id,
//         'start_date' => $request->start_date,
//         'end_date' => $request->end_date,
//         'total_cost' => $totalCost,
//     ]);

//     // Check if rental creation was successful
//     if (!$rental) {
//         return response()->json(['error' => 'Failed to create rental record.'], 500);
//     }

//     // Retrieve the user information using the user_id from the rental
//     $user = Auth::user();

//     // Ensure the rental has valid data
//     if ($rental->id && $user) {
//         // Send an email to the user
//         Mail::to($user->email)->send(new CarRentalConfirmation($rental));
//     } else {
//         return response()->json(['error' => 'Invalid rental data or user.'], 400);
//     }

//     // Return success response with rental details
//     return response()->json(['message' => 'Car booked successfully!', 'rental' => $rental], 201);
// }


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
}