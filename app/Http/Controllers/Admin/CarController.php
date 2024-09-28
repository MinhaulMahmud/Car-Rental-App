<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('admin.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.managecar');
    }

    public function store(Request $request)
    {
        // Validate the input fields
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'car_type' => 'required|string',
            'daily_rent_price' => 'required|numeric',
            'availability' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB image size
        ]);
        
            // Otherwise, create a new car
            $car = Car::create($validatedData);

            // Handle file upload for the new car
            if ($request->hasFile('image')) {
                // Define the custom upload path
                $uploadPath = public_path('admin-assets/img/car img');

                // Create directory if it doesn't exist
                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true, true);
                }

                // Get the uploaded file and store it
                $file = $request->file('image');
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move($uploadPath, $filename);

                // Save the relative path to the database
                $car->image = 'admin-assets/img/car img/' . $filename;
                $car->save();
            }

            return redirect()->route('admin.cars.index')->with('status', 'Car added successfully.');
        
    }

    public function edit(Car $car)
    {
        return view('admin.editCars', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        // Validate and update the car
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'car_type' => 'required|string',
            'daily_rent_price' => 'required|numeric',
            'availability' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB image size
        ]);

        // Handle file upload and updating the database here
        $car->update($validatedData);

        // Handle file upload (if updating the image)
        if ($request->hasFile('image')) {
            // Define the custom upload path
            $uploadPath = public_path('admin-assets/img/car img');

            // Create directory if it doesn't exist
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }

            // Get the uploaded file and store it
            $file = $request->file('image');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move($uploadPath, $filename);

            // Save the relative path to the database
            $car->image = 'admin-assets/img/car img/' . $filename;
            $car->save();
        }

        return redirect()->route('admin.cars.index')->with('status', 'Car updated successfully!');
    }

    public function destroy(Car $car)
    {
        // Delete car and remove the image if exists
        $imagePath = public_path($car->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $car->delete();

        return redirect()->route('cars.index')->with('status', 'Car deleted successfully!');
    }
}
