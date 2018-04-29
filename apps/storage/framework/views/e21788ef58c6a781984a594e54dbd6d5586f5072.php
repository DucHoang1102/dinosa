
<div class="funs-donmoi" <?php echo e(isset($funs_donmoi) ? $funs_donmoi : 'style=display:none'); ?>>
	<div class="load-oldcustomer"><img src="upload/loads/load_1.gif" width="40px"></div>
	<div class="add-order">
		<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
	</div>
</div>

<div class="funs-xacnhan" <?php echo e(isset($funs_xacnhan) ? $funs_xacnhan : 'style=display:none'); ?>>
	<a class="print-orders" href="">
		<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="In nhãn">
			<span class="glyphicon glyphicon-print" aria-hidden="true"></span> In nhãn
		</button>
	</a>
	<a class="print-product" href="">
		<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="In toàn bộ sản phẩm">
			<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
		</button>
	</a>
</div>

<div class="funs-dainxong" <?php echo e(isset($funs_dainxong) ? $funs_dainxong : 'style=display:none'); ?>>
	<a class="send-mail" href="">
		<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Gửi đơn hàng cho vnpost">
			<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Gửi Vnpost
		</button>
	</a>
</div>

<div class="funs-thungrac" <?php echo e(isset($funs_thungrac) ? $funs_thungrac : 'style=display:none'); ?>>
	<a class="delete-all" href="orders/delete-permanently/all">
		<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Dọn dẹp thùng rác">
			<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Dọn dẹp
		</button>
	</a>
</div>