{{-- Chức năng xử riêng cho đơn mới --}}
<div class="funs-donmoi" {{ $funs_donmoi or 'style=display:none' }}>
	<div class="load-oldcustomer"><img src="upload/loads/load_1.gif" width="40px"></div>
	<div class="add-order">
		<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
	</div>
</div>
{{-- Chức năng xử riêng cho xác nhận --}}
<div class="funs-xacnhan" {{ $funs_xacnhan or 'style=display:none' }}>
	<a class="print-product" href="">
		<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="In toàn bộ sản phẩm">
			<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
		</button>
	</a>
</div>
{{-- Chức năng xử riêng cho đã in xong --}}
<div class="funs-dainxong" {{ $funs_dainxong or 'style=display:none' }}>
	<a class="print-orders" href="">
		<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="In nhãn">
			<span class="glyphicon glyphicon-print" aria-hidden="true"></span> In nhãn
		</button>
	</a>
	<a class="send-mail" href="">
		<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Gửi đơn hàng cho vnpost">
			<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Gửi Vnpost
		</button>
	</a>
</div>
{{-- Chức năng xử riêng cho thùng rác --}}
<div class="funs-thungrac" {{ $funs_thungrac or 'style=display:none' }}>
	<a class="delete-all" href="orders/delete-permanently/all">
		<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Dọn dẹp thùng rác">
			<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Dọn dẹp
		</button>
	</a>
</div>