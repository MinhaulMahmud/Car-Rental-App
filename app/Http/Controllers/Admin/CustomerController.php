<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rental;
use App\Models\Car;
use Illuminate\Http\Request;

class CustomerController extends Controller
{   
    //admin dasboard
    public function dashboard()
    {
        $totalCars = Car::count();
        $availableCars = Car::where('availability', 1)->count();
        $totalRentals = Rental::count();
        $totalEarnings = Rental::sum('total_cost');

        return view('admin.admindashboard', compact('totalCars', 'availableCars', 'totalRentals', 'totalEarnings'));
    }

    // Display a listing of the customers
    public function index()
    {
        $customers = User::where('role', '1')->get();
        return view('admin.customers.index', compact('customers'));
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
