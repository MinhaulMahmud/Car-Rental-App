<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-3xl md:text-4xl font-bold text-center mb-8 text-indigo-600">Book {{ $car->name }} - {{ $car->brand }}</h1>

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <form action="{{ route('rentals.book', $car->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6 mb-6">
        @csrf
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Rental Start Date</label>
                <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" name="start_date" required>
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Rental End Date</label>
                <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" name="end_date" required>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg mb-6">
            <h4 class="text-xl font-semibold text-indigo-600 mb-4">Car Details</h4>
            <div class="grid md:grid-cols-2 gap-4 text-gray-700">
                <p><span class="font-medium">Type:</span> {{ $car->car_type }}</p>
                <p><span class="font-medium">Price:</span> ${{ $car->daily_rent_price }}/day</p>
                <p><span class="font-medium">Year:</span> {{ $car->year }}</p>
                <p><span class="font-medium">Status:</span> 
                    <span class="{{ $car->availability ? 'text-green-600' : 'text-red-600' }}">
                        {{ $car->availability ? 'Available' : 'Not Available' }}
                    </span>
                </p>
            </div>
        </div>

        <button onclick="" type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition duration-300 ease-in-out">
            Confirm Booking
        </button>
    </form>

    <!-- <script>
        async function sendEmail(rentalId) {
            try {
                const response = await fetch("{{ url('/send-email') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ rental_id: rentalId }),
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    alert('Email sent successfully!');
                } else {
                    alert('Failed to send email.');
                }
            } catch (error) {
                console.error('Error sending email:', error);
            }
        }
    </script>
</div> -->
