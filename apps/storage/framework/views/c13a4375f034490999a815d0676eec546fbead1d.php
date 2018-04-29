<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<title><?php echo $__env->yieldContent('title', 'Dinosa'); ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="\upload\x-icon\dinosa-48x48.png" />
	<!-- Bootstrap 3.3.7 CSS -->
	<link href="\dist\plugins\bootstrap\css\bootstrap.min.css" rel="stylesheet" type="text/css">
	<!-- Dinosa CSS -->
	<link href="\dist\css\main.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div class="wrapper">

		<!-- Header -->
		<?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
		<!-- Sidebar-left -->
		<?php echo $__env->make('layouts.sidebar-left', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<!-- Content -->
		<?php $__env->startSection('content'); ?>

		<?php echo $__env->yieldSection(); ?>

		<!-- Footer -->
		<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	</div>

	<!-- Jquery 3.2.1 -->
	<script src="\dist\plugins\jquery\jquery-3.2.1.min.js" type="text/javascript"></script>
	<!-- Jquery IU -->
	<script src="\dist\plugins\jquery-ui\jquery-ui.min.js" type="text/javascript"></script>
	<!-- Bootstrap 3.3.7 JS -->
	<script src="\dist\plugins\bootstrap\js\bootstrap.min.js" type="text/javascript"></script>
	<!-- Dinosa JS -->
	<script src="\dist\js\main.js" type="text/javascript"></script>
</body>
</html>