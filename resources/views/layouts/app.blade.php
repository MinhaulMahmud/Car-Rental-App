<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>
		@yield('title')
	</title>

	<link href="{{ asset('admin-assets/css/app.css')}}" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<!-- <style>
        .card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #007bff, #6f42c1);
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #28a745, #20c997);
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #ffc107, #fd7e14);
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #17a2b8, #6610f2);
        }

        .icon-size {
            font-size: 3rem;
            margin-bottom: 10px;
        }
    </style> -->
</head>

<body>
	<div id="loader" class="LoadingOverlay d-none">
		<div class="Line-Progress">
			<div class="indeterminate"></div>
		</div>
	</div>
	<div>
		<div class="wrapper">
			<div class="min-h-screen bg-gray-100">
				@include('layouts.sidebar')
			</div>
			<div class="main">
				@include('layouts.navbar')
				<main class="content">
					<div class="container-fluid p-0">
						@yield('content')
					</div>
				</main>
			</div>
		</div>
	</div>
	
	<script src="{{asset('admin-assets/js/app.js')}}"></script>
	
</body>

</html>