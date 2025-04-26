<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Owner Dashboard') }}
            </h2>
            @if (!$car)
                <a href="{{ route('owner.cars.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    List Your Car
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if (!$car)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="text-center">
                            <h3 class="text-xl font-medium mb-4">Start Earning with Your Car</h3>
                            <p class="text-gray-600 mb-4">You haven't listed a car yet. List your car and start earning today!</p>
                            <a href="{{ route('owner.cars.create') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                List Your Car Now
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Car Details -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-medium mb-4">Your Listed Car</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p><strong>Name:</strong> {{ $car->name }}</p>
                                        <p><strong>Brand:</strong> {{ $car->brand }}</p>
                                        <p><strong>Model:</strong> {{ $car->model }}</p>
                                    </div>
                                    <div>
                                        <p><strong>Year:</strong> {{ $car->year }}</p>
                                        <p><strong>Type:</strong> {{ $car->car_type }}</p>
                                        <p><strong>Daily Rate:</strong> ${{ number_format($car->daily_rent_price, 2) }}</p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <p><strong>Total Revenue:</strong> ${{ number_format($totalRevenue, 2) }}</p>
                                </div>
                            </div>
                            <div>
                                <img src="{{ Storage::url($car->image) }}" alt="{{ $car->name }}" class="w-48 h-48 object-cover rounded">
                            </div>
                        </div>
                        <div class="mt-4 flex space-x-4">
                            <button onclick="toggleEditForm()" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                                Edit Car
                            </button>
                            <form action="{{ route('owner.cars.destroy', $car) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md" onclick="return confirm('Are you sure you want to remove this listing?')">
                                    Remove Listing
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Form (Hidden by default) -->
                <div id="editForm" class="hidden bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium mb-4">Edit Car Details</h3>
                        <form action="{{ route('owner.cars.update', $car) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block">Name</label>
                                    <input type="text" name="name" value="{{ $car->name }}" class="mt-1 block w-full rounded-md" required>
                                </div>
                                <div>
                                    <label class="block">Brand</label>
                                    <input type="text" name="brand" value="{{ $car->brand }}" class="mt-1 block w-full rounded-md" required>
                                </div>
                                <div>
                                    <label class="block">Model</label>
                                    <input type="text" name="model" value="{{ $car->model }}" class="mt-1 block w-full rounded-md" required>
                                </div>
                                <div>
                                    <label class="block">Year</label>
                                    <input type="number" name="year" value="{{ $car->year }}" class="mt-1 block w-full rounded-md" required>
                                </div>
                                <div>
                                    <label class="block">Car Type</label>
                                    <select name="car_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                    <option value="Sedan" {{ $car->car_type == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                                    <option value="SUV" {{ $car->car_type == 'SUV' ? 'selected' : '' }}>SUV</option>
                                    <option value="Hatchback" {{ $car->car_type == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                                    <option value="Pickup" {{ $car->car_type == 'Pickup' ? 'selected' : '' }}>Pickup</option>
                                    <option value="Van" {{ $car->car_type == 'Van' ? 'selected' : '' }}>Van</option>
                                    <option value="Luxury" {{ $car->car_type == 'Luxury' ? 'selected' : '' }}>Luxury</option>
                                </select>
                                </div>
                                <div>
                                    <label class="block">Daily Rent Price</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">$</span>
                                        </div>
                                        <input type="number" step="0.01" name="daily_rent_price" value="{{ $car->daily_rent_price }}" class="pl-7 mt-1 block w-full rounded-md" required>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="block">Car Image (Leave empty to keep current image)</label>
                                    <input type="file" name="image" class="mt-1 block w-full">
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                                    Update Car
                                </button>
                                <button type="button" onclick="toggleEditForm()" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded-md">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Rental History -->
                @if ($rentals->count() > 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium mb-4">Rental History</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full table-auto">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2">Customer</th>
                                            <th class="px-4 py-2">Start Date</th>
                                            <th class="px-4 py-2">End Date</th>
                                            <th class="px-4 py-2">Total Cost</th>
                                            <th class="px-4 py-2">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rentals as $rental)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $rental->user->name }}</td>
                                                <td class="border px-4 py-2">{{ $rental->start_date }}</td>
                                                <td class="border px-4 py-2">{{ $rental->end_date }}</td>
                                                <td class="border px-4 py-2">${{ number_format($rental->total_cost, 2) }}</td>
                                                <td class="border px-4 py-2">{{ ucfirst($rental->status) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleEditForm() {
            const editForm = document.getElementById('editForm');
            editForm.classList.toggle('hidden');
        }
    </script>
    @endpush
</x-app-layout>