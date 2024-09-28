<nav class="bg-gray-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <!-- Left side (Logo and Links) -->
      <div class="flex items-center">
        <a href="{{ route('home') }}" class="text-white text-lg font-semibold">
          Car Rental
        </a>
        <div class="hidden md:block ml-10">
          <div class="flex space-x-4">
            <!-- Dynamic Active State -->
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
              Home
            </a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
              About
            </a>
            <a href="{{ route('cars.index') }}" class="{{ request()->routeIs('cars.index') ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
              Listed Cars
            </a>
            @auth
            <a href="{{ route('rentals.dashboard') }}" class="{{ request()->routeIs('rentals.dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
              My Bookings
            </a>
            @endauth
          </div>
        </div>
      </div>

      <!-- Right side (User Profile and Auth Links) -->
      <div class="hidden md:block">
        <div class="ml-4 flex items-center md:ml-6">
          @guest
          <!-- Show Login/Signup for guests -->
          <a href="{{ route('login') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
          <a href="{{ route('register') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Signup</a>
          @else
          <!-- Dropdown for authenticated users -->
          <div class="relative">
            <button class="text-white focus:outline-none" id="user-menu" aria-expanded="false" aria-haspopup="true">
              {{ Auth::user()->name }}
              <svg class="ml-2 h-5 w-5 text-gray-400 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
              </svg>
            </button>
            <!-- Dropdown Menu -->
            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20 hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu" id="dropdownMenu">
              <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Profile</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Logout</button>
              </form>
            </div>
          </div>
          @endguest
        </div>
      </div>

      <!-- Mobile Menu Button -->
      <div class="-mr-2 flex md:hidden">
        <button type="button" class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div class="md:hidden" id="mobile-menu">
    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-gray-900 text-white' : 'text-gray-300' }} block px-3 py-2 rounded-md text-base font-medium">Home</a>
      <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'bg-gray-900 text-white' : 'text-gray-300' }} block px-3 py-2 rounded-md text-base font-medium">About</a>
      @auth
      <a href="{{ route('rentals.dashboard') }}" class="{{ request()->routeIs('rentals.dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300' }} block px-3 py-2 rounded-md text-base font-medium">My Bookings</a>
      @endauth
    </div>
    <div class="pt-4 pb-3 border-t border-gray-700">
      @guest
      <div class="px-2 space-y-1">
        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Login</a>
        <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Signup</a>
      </div>
      @else
      <div class="px-5">
        <span class="text-white">{{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Logout</button>
        </form>
      </div>
      @endguest
    </div>
  </div>
</nav>

<script>
  document.getElementById('user-menu').addEventListener('click', function() {
    var dropdown = document.getElementById('dropdownMenu');
    dropdown.classList.toggle('hidden');
  });
</script>
