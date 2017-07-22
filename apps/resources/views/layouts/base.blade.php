<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title', 'Dinosa')</title>
	<!-- Bootstrap 3.3.7 CSS -->
	<link href="dist\plugins\bootstrap\css\bootstrap.min.css" rel="stylesheet" type="text/css">
	<!-- Dinosa CSS -->
	<link href="dist\css\main.css" rel="stylesheet" type="text/css">
	
	<!-- Jquery-ui CSS -->
	<link href="dist\plugins\jquery-ui\jquery-ui.min.css" rel="stylesheet" type="text/css">


</head>
<body>

	<div class="wrapper container-fluid">

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
	<script src="dist\plugins\jquery\jquery-3.2.1.min.js" type="text/javascript"></script>
	<!-- Jquery IU -->
	<script src="dist\plugins\jquery-ui\jquery-ui.min.js" type="text/javascript"></script>
	<!-- Bootstrap 3.3.7 JS -->
	<script src="dist\plugins\bootstrap\js\bootstrap.min.js" type="text/javascript"></script>
	<!-- Dinosa JS -->
	<script src="dist\js\main.js" type="text/javascript"></script>
</body>
</html>