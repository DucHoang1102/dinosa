@extends('layouts.base')

@section('title', 'Dinosa manage')

<!-- Content Chính ở đây-->
@section('content')
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
					<span class="label label-danger count">{{ $count_donMoi or 0 }}</span></a>
				</li>
				<li role="presentation">
					<a href="#daxacnhan" aria-controls="profile" role="tab" data-toggle="tab">
					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Xác nhận
					<span class="label label-danger count">{{ $count_daXacNhan or 0 }}</span></a>
				</li>
				<li role="presentation">
					<a href="#dainxong" aria-controls="profile" role="tab" data-toggle="tab">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span>In xong
					<span class="label label-danger count">{{ $count_daInXong or 0 }}</span></a>
				</li>
				<li role="presentation">
					<a href="#dangchuyen" aria-controls="profile" role="tab" data-toggle="tab">
					<span class="glyphicon glyphicon-plane" aria-hidden="true"></span>Đang chuyển
					<span class="label label-danger count">{{ $count_dangChuyen or 0 }}</span></a>
				</li>
				<li role="presentation">
					<a href="#chuyenthanhcong" aria-controls="profile" role="tab" data-toggle="tab">
					<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>Thành công
					<span class="label label-danger count">{{ $count_chuyenThanhCong or 0 }}</span></a>
				</li>
				<li role="presentation">
					<a href="#chuyenthatbai" aria-controls="profile" role="tab" data-toggle="tab">
					<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>Thất bại
					<span class="label label-danger count">{{ $count_chuyenThatBai or 0 }}</span></a>
				</li>
				<li role="presentation">
					<a href="#thungrac" aria-controls="profile" role="tab" data-toggle="tab">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Thùng rác
					<span class="label label-danger count">{{ $count_thungRac or 0 }}</span></a>
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

		<!-- Tab Đơn Mới  -->
		@include('orders.colums-content.colums.donmoi')
		
		<!-- Tab Đã xác nhận -->
		@include('orders.colums-content.colums.daxacnhan')

		<!-- Tab Đã in xong -->
		@include('orders.colums-content.colums.dainxong')

		<!-- Tab Đamg chuyển -->
		@include('orders.colums-content.colums.dangchuyen')

		<!-- Tab Chuyển thành công -->
		@include('orders.colums-content.colums.chuyenthanhcong')

		<!-- Tab Chuyển thất bại -->
		@include('orders.colums-content.colums.chuyenthatbai')

		<!-- Tab Thùng rác -->
		@include('orders.colums-content.colums.thungrac')

	</div> <!-- /.tab-content -->
</div> <!-- /.list-bills -->
@endsection