@extends('layouts.base')

@section('title', 'Demo dinosa')

<!-- Content Chính ở đây-->
@section('content')
	<div class="row">
		<div class="tab-bills">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav nav-tabs" role="tablist" >
							<li role="presentation" class="active">
								<a href="#donmoi" aria-controls="home" role="tab" data-toggle="tab">
								<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>Đơn mới<span class="label label-danger">30</span></a>
							</li>
							<li role="presentation">
								<a href="#daxacnhan" aria-controls="profile" role="tab" data-toggle="tab">
								<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Đã xác nhận
								<span class="label label-danger">30</span></a>
							</li>
							<li role="presentation">
								<a href="#dainxong" aria-controls="profile" role="tab" data-toggle="tab">
								<span class="glyphicon glyphicon-print" aria-hidden="true"></span>Đã in xong
								<span class="label label-danger">30</span></a>
							</li>
							<li role="presentation">
								<a href="#dangchuyen" aria-controls="profile" role="tab" data-toggle="tab">
								<span class="glyphicon glyphicon-plane" aria-hidden="true"></span>Đang chuyển
								<span class="label label-danger">30</span></a>
							</li>
							<li role="presentation">
								<a href="#chuyenthanhcong" aria-controls="profile" role="tab" data-toggle="tab">
								<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>Chuyển thành công
								<span class="label label-danger">30</span></a>
							</li>
							<li role="presentation">
								<a href="#chuyenthatbai" aria-controls="profile" role="tab" data-toggle="tab">
								<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>Chuyển thất bại
								<span class="label label-danger">30</span></a>
							</li>
							<li role="presentation">
								<a href="#thungrac" aria-controls="profile" role="tab" data-toggle="tab">
								<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Thùng rác
								<span class="label label-danger">30</span></a>
							</li>
						</ul>  <!-- /.nav -->
					</div>  <!-- /.col-sm-12 -->
				</div>  <!-- /.row -->
			</div>  <!-- /.container-fluid -->
		</div> <!-- /.tab-bils -->

		<div class="list-bills">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12">
						<div class="tab-content">

							<!-- Tab Đơn Mới     /// bill > tab-content > donmoi.blade.php -->
							@include('bill.tab-content.donmoi')
							
							<!-- Tab Đã xác nhận /// bill > tab-content > daxacnhan.blade.php -->
							@include('bill.tab-content.daxacnhan')

							<!-- Tab Đã in xong /// bill > tab-content > dainxong.blade.php -->
							@include('bill.tab-content.dainxong')

							<!-- Tab Đamg chuyển /// bill > tab-content > dangchuyen.blade.php -->
							@include('bill.tab-content.dangchuyen')

							<!-- Tab Chuyển thành công /// bill > tab-content > chuyenthanhcong.blade.php -->
							@include('bill.tab-content.chuyenthanhcong')

							<!-- Tab Chuyển thất bại /// bill > tab-content > chuyenthatbai.blade.php -->
							@include('bill.tab-content.chuyenthatbai')

							<!-- Tab Thùng rác /// bill > tab-content > thungrac.blade.php -->
							@include('bill.tab-content.thungrac')
	
						</div> <!-- /.tab-content -->
					</div> <!-- /.col-sm-12 -->
				</div> <!-- /.row -->
			</div> <!-- /.container-fluid -->
		</div> <!-- /.list-bills -->
	</div>
@endsection