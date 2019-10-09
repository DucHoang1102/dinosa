<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title', 'Dinosa')</title>
	<link rel="shortcut icon" type="image/x-icon" href="\img\x-icon\dinosa-48x48.png" />
	<link href="{{ mix('/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ mix('/css/style.css') }}" rel="stylesheet" type="text/css">
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

	<script src="{{ mix('/js/lib.min.js') }}" type="text/javascript"></script>
	<script src="{{ mix('/js/main.js')    }}" type="text/javascript"></script>
</body>
</html>