<?php $__env->startSection('title', 'Demo dinosa'); ?>

<!-- Content Chính ở đây-->
<?php $__env->startSection('content'); ?>
<div class="tab-bills">
	<nav class="navbar navbar-inverse">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-tabs">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
		</div>
		<div class="navbar-collapse collapse" id="menu-tabs">
			<ul class="nav navbar-nav nav-tabs" role="tablist" >
				<li role="presentation" class="active">
					<a href="#donmoi" aria-controls="home" role="tab" data-toggle="tab">
					<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>Đơn mới 
					<span class="label label-danger count"><?php echo e(isset($count_donMoi) ? $count_donMoi : 0); ?></span></a>
				</li>
				<li role="presentation">
					<a href="#daxacnhan" aria-controls="profile" role="tab" data-toggle="tab">
					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Xác nhận
					<span class="label label-danger count"><?php echo e(isset($count_daXacNhan) ? $count_daXacNhan : 0); ?></span></a>
				</li>
				<li role="presentation">
					<a href="#dainxong" aria-controls="profile" role="tab" data-toggle="tab">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span>In xong
					<span class="label label-danger count"><?php echo e(isset($count_daInXong) ? $count_daInXong : 0); ?></span></a>
				</li>
				<li role="presentation">
					<a href="#dangchuyen" aria-controls="profile" role="tab" data-toggle="tab">
					<span class="glyphicon glyphicon-plane" aria-hidden="true"></span>Đang chuyển
					<span class="label label-danger count"><?php echo e(isset($count_dangChuyen) ? $count_dangChuyen : 0); ?></span></a>
				</li>
				<li role="presentation">
					<a href="#chuyenthanhcong" aria-controls="profile" role="tab" data-toggle="tab">
					<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>Thành công
					<span class="label label-danger count"><?php echo e(isset($count_chuyenThanhCong) ? $count_chuyenThanhCong : 0); ?></span></a>
				</li>
				<li role="presentation">
					<a href="#chuyenthatbai" aria-controls="profile" role="tab" data-toggle="tab">
					<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>Thất bại
					<span class="label label-danger count"><?php echo e(isset($count_chuyenThatBai) ? $count_chuyenThatBai : 0); ?></span></a>
				</li>
				<li role="presentation">
					<a href="#thungrac" aria-controls="profile" role="tab" data-toggle="tab">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Thùng rác
					<span class="label label-danger count"><?php echo e(isset($count_thungRac) ? $count_thungRac : 0); ?></span></a>
				</li>
			</ul>  <!-- /.nav -->
			 <form action="" class="navbar-form navbar-right" method="post">
                <div class="form-group has-success has-feedback">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
                </div>
            </form>
		</div>
	</nav>
</div> <!-- /.tab-bils -->

<div class="list-bills">
	<div class="tab-content">

		<!-- Tab Đơn Mới     /// bill > tab-content > donmoi.blade.php -->
		<?php echo $__env->make('bill.tab-content.donmoi', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
		<!-- Tab Đã xác nhận /// bill > tab-content > daxacnhan.blade.php -->
		<?php echo $__env->make('bill.tab-content.daxacnhan', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<!-- Tab Đã in xong /// bill > tab-content > dainxong.blade.php -->
		<?php echo $__env->make('bill.tab-content.dainxong', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<!-- Tab Đamg chuyển /// bill > tab-content > dangchuyen.blade.php -->
		<?php echo $__env->make('bill.tab-content.dangchuyen', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<!-- Tab Chuyển thành công /// bill > tab-content > chuyenthanhcong.blade.php -->
		<?php echo $__env->make('bill.tab-content.chuyenthanhcong', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<!-- Tab Chuyển thất bại /// bill > tab-content > chuyenthatbai.blade.php -->
		<?php echo $__env->make('bill.tab-content.chuyenthatbai', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<!-- Tab Thùng rác /// bill > tab-content > thungrac.blade.php -->
		<?php echo $__env->make('bill.tab-content.thungrac', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	</div> <!-- /.tab-content -->
</div> <!-- /.list-bills -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>