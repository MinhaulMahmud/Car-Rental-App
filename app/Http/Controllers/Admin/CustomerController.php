<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rental;
use App\Models\Car;
use Illuminate\Http\Request;
// user_type,

class CustomerController extends Controller
{   
    //admin dasboard
    public function dashboard()
    {
        // Basic stats for all cars
        $totalCars = Car::count();
        $availableCars = Car::where('availability', 1)->count();
        $totalRentals = Rental::count();

        // Car listings and earnings by user role (join with users table)
        $adminCars = Car::whereHas('user', function($q) {
            $q->where('role', 'admin');
        })->with('rentals')->get();
        $fleetProviderCars = Car::whereHas('user', function($q) {
            $q->where('role', 'fleet_provider');
        })->with(['rentals', 'user'])->get();
        $ownerCars = Car::whereHas('user', function($q) {
            $q->where('role', 'owner');
        })->with(['rentals', 'user'])->get();

        // Calculate earnings
        $adminEarnings = Rental::whereIn('car_id', $adminCars->pluck('id'))->sum('total_cost');
        // Fleet provider earnings (70% to provider, 30% to admin)
        $fleetProviderTotalEarnings = Rental::whereIn('car_id', $fleetProviderCars->pluck('id'))->sum('total_cost');
        $fleetProviderEarnings = $fleetProviderTotalEarnings * 0.7;
        $adminFleetEarnings = $fleetProviderTotalEarnings * 0.3;
        // Owner earnings (80% to owner, 20% to admin)
        $ownerTotalEarnings = Rental::whereIn('car_id', $ownerCars->pluck('id'))->sum('total_cost');
        $ownerEarnings = $ownerTotalEarnings * 0.8;
        $adminOwnerEarnings = $ownerTotalEarnings * 0.2;
        // Total admin earnings (admin cars + commission from others)
        $totalAdminEarnings = $adminEarnings + $adminFleetEarnings + $adminOwnerEarnings;
        // Recent rentals with customer details
        $recentRentals = Rental::with(['user', 'car'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        // Cars by status
        $carStatus = Car::selectRaw('
            SUM(CASE WHEN availability = 1 THEN 1 ELSE 0 END) as available,
            SUM(CASE WHEN availability = 0 THEN 1 ELSE 0 END) as rented
        ')
        ->get();

        // Fetch all cars with their user for admin dashboard listing
        $carsWithUsers = Car::with('user')->get();

        return view('admin.admindashboard', compact(
            'totalCars',
            'availableCars',
            'totalRentals',
            'adminCars',
            'fleetProviderCars',
            'ownerCars',
            'adminEarnings',
            'fleetProviderEarnings',
            'ownerEarnings',
            'totalAdminEarnings',
            'recentRentals',
            'carStatus',
            'carsWithUsers' // add this to the view
        ));
    }

    // Display a listing of all users except admin
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.customers.index', compact('users'));
    }

    // Show the form for editing the customer details
    public function edit($id)
    {
        $customer = User::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    // Update customer details
    public function updated(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
        ]);

        $customer = User::findOrFail($id);
        $customer->update($request->all());

        return redirect()->route('customers.index')->with('status', 'Customer updated successfully.');
    }

    public function update(Request $request, User $customer)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'number' => 'required|string|max:15', // Adjust validation rules as needed
        ]);

        // Update the customer's information
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->number = $request->number;

        // Save the updated customer information
        $customer->save();

        // Redirect back to the customer index page with a success message
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }


    // Delete a customer
    public function destroy($id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('status', 'Customer deleted successfully.');
    }

    // Show the rental history of a customer
    public function showRentalHistory($id)
    {
        $customer = User::findOrFail($id);
        $rentalHistory = Rental::where('user_id', $id)->with('car')->get();
        return view('admin.customers.rental-history', compact('customer', 'rentalHistory'));
    }

}
