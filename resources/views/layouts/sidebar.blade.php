<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand">
          <span class="align-middle">Car Rentals</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Main
					</li>

					<li class="sidebar-item {{ request()->routeIs('admin')?'active' : ''}}">
						<a class="sidebar-link" href="{{ route('admin') }}">
              				<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            			</a>
					</li>

					<li class="sidebar-item {{ request()->routeIs('profile.edit')?'active' : '' }}">
						<a class="sidebar-link" href="{{ route('profile.edit')}}">
              				<i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
            			</a>
					</li>

					
					<li class="sidebar-header">
						Components
					</li>

					<li class="sidebar-item {{ request()->routeIs('cars.index')?'active' : '' }}">
						<a class="sidebar-link" href="{{ route('cars.index')}}">
              				<i class="align-middle" data-feather="list"></i> <span class="align-middle">Car List</span>
            			</a>
					</li>

					<li class="sidebar-item {{ request()->routeIs('cars.create')?'active' : '' }}">
						<a class="sidebar-link" href="{{ route('cars.create')}}">
              				<i class="align-middle" data-feather="grid"></i> <span class="align-middle">Register Car</span>
            			</a>
					</li>

					<li class="sidebar-item {{ request()->routeIs('customers.index')?'active' : '' }}">
						<a class="sidebar-link" href="{{ route('customers.index')}}">
              				<i class="align-middle" data-feather="user"></i> <span class="align-middle">Customers</span>
            			</a>
					</li>

					<li class="sidebar-item {{ request()->routeIs('rentals.index')?'active' : '' }}">
						<a class="sidebar-link" href="{{ route('rentals.index')}}">
              				<i class="align-middle" data-feather="user"></i> <span class="align-middle">All Rentals</span>
            			</a>
					</li>

					<!-- <li class="sidebar-item">
						<a class="sidebar-link" href="ui-typography.html">
              				<i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Typography</span>
            			</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="icons-feather.html">
              				<i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
            			</a>
					</li> -->

					<!-- <li class="sidebar-header">
						Plugins & Addons
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="charts-chartjs.html">
              				<i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
           				</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="maps-google.html">
              				<i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
           				 </a>
					</li>
				</ul> -->

				<!-- <div class="sidebar-cta">
					<div class="sidebar-cta-content">
						<strong class="d-inline-block mb-2">Upgrade to Pro</strong>
						<div class="mb-3 text-sm">
							Are you looking for more components? Check out our premium version.
						</div>
						<div class="d-grid">
							<a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>
						</div>
					</div>
				</div> -->
			</div>
		</nav>