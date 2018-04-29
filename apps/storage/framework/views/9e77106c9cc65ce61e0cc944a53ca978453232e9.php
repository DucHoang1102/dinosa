

<?php $__env->startSection('title', 'Demo dinosa'); ?>

<?php $__env->startSection('demo'); ?>
	<div class="wrapper container-fluid">
		<div class="row">
			<div class="header">
			</div><!-- /.header-->
		</div>

		<div class="row">
			<div class="col-sm-1">
				a
			</div>
			<div class="col-sm-11 content">
				<!-- Nav tabs . This tab bils-->
				<ul class="nav nav-tabs tab-bills" role="tablist" >
					<li role="presentation" class="active">
						<a href="#donmoi" aria-controls="home" role="tab" data-toggle="tab">
						<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>Đơn mới</a>
					</li>
					<li role="presentation">
						<a href="#daxacnhan" aria-controls="profile" role="tab" data-toggle="tab">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Đã xác nhận</a>
					</li>
					<li role="presentation">
						<a href="#dainxong" aria-controls="profile" role="tab" data-toggle="tab">
						<span class="glyphicon glyphicon-print" aria-hidden="true"></span>Đã in xong</a>
					</li>
					<li role="presentation">
						<a href="#dangchuyen" aria-controls="profile" role="tab" data-toggle="tab">
						<span class="glyphicon glyphicon-plane" aria-hidden="true"></span>Đang chuyển</a>
					</li>
					<li role="presentation">
						<a href="#chuyenthanhcong" aria-controls="profile" role="tab" data-toggle="tab">
						<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>Chuyển thành công</a>
					</li>
					<li role="presentation">
						<a href="#chuyenthatbai" aria-controls="profile" role="tab" data-toggle="tab">
						<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>Chuyển thất bại</a>
					</li>
					<li role="presentation">
						<a href="#thungrac" aria-controls="profile" role="tab" data-toggle="tab">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Thùng rác</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="donmoi">
						<h1>Đơn mới</h1>
						<table class="table table-bills">
							<thead>
								<tr>
									<th></th>
									<th class="ngaynhan"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>Ngày nhận</th>
									<th class="hoten"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Họ tên</th>
									<th class="phone"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>Phone</th>
									<th class="diachi"><span class="glyphicon glyphicon-road" aria-hidden="true"></span>Địa chỉ</th>
									<th class="sanpham"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span>Sản phẩm</th>
									<th class="tongtien"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span>Tổng tiền</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										1.
									</td>
									<td>
										<input type="text" name="">
									</td>
									<td>
										<input type="text" name="">
									</td>
									<td>
										<input type="text" name="">
									</td>
									<td>
										<input type="text" name="">
									</td>
									<td>
										<input type="text" name="">
									</td>
									<td>
										<input type="number" name="">
									</td>
								</tr>
							</tbody>
						</table>
						<div class="add-item"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></div>
					</div>
					<div role="tabpanel" class="tab-pane" id="daxacnhan">
						<th class="trangthai"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>Trạng thái</th>
						Đơn đã xác nhận
					</div>
					<div role="tabpanel" class="tab-pane" id="dangin">
						Đang in
					</div>
					<div role="tabpanel" class="tab-pane" id="dainxong">
						Đã in xong
					</div>
					<div role="tabpanel" class="tab-pane" id="dangchuyen">
						Đang chuyển
					</div>
					<div role="tabpanel" class="tab-pane" id="chuyenthanhcong">
						Chuyển thành công
					</div>
					<div role="tabpanel" class="tab-pane" id="chuyenthatbai">
						Chuyển thất bại
					</div>
					<div role="tabpanel" class="tab-pane" id="thungrac">
						Thùng rác
					</div>
				</div>

			</div> <!-- /.content-->
		</div>
		
		<div class="row">
			<div id="footer">
				
			</div><!-- /.footer-->
		</div>
	</div> <!-- /.wrapper-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>