<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title', 'Dinosa')</title>
	<link rel="shortcut icon" type="image/x-icon" href="\upload\x-icon\dinosa-48x48.png" />
	<!-- Bootstrap 3.3.7 CSS -->
	<link href="\plugins\bootstrap\css\bootstrap.min.css" rel="stylesheet" type="text/css">
	<!-- Dinosa CSS -->
	<link href="\css\main.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div class="wrapper">

		<!-- Header -->
		@include('layouts.header')
		
		<!-- Sidebar-left -->
		@include('layouts.sidebar-left')

		<!-- Content -->
		@section('content')

		@show

		<!-- Footer -->
		@include('layouts.footer')

	</div>

	<!-- Jquery 3.2.1 -->
	<script src="\plugins\jquery\jquery-3.2.1.min.js" type="text/javascript"></script>
	<!-- Jquery IU -->
	<script src="\plugins\jquery-ui\jquery-ui.min.js" type="text/javascript"></script>
	<!-- Bootstrap 3.3.7 JS -->
	<script src="\plugins\bootstrap\js\bootstrap.min.js" type="text/javascript"></script>
	<!-- Dinosa JS -->
	<script src="\js\main.js" type="text/javascript"></script>
</body>
</html>