


<!-- Nghiên cứu tối ưu sau -->





<tr>
	<input type="hidden" name="_id_order" value="{{ $order->id }}"/>
	<input type="hidden" name="_id_customer" value="{{ $order->id_customers }}"/>
	<td class="stt">{{ $stt + 1 }}.</td>
	<td class="hoten"><input type="text" name="name" value="{{ $order->name }}" maxlength="35" autocomplete="off"></td>
	<td class="phone"><input type="text" name="phone" value="{{ $order->phone }}" maxlength="11" autocomplete="off"></td>
	<td class="diachi address"><input type="text" name="address" value="{{ $order->address }}" maxlength="99" autocomplete="off"></td>

	<td class="sanpham">
	@foreach ($order->products as $product)
		<div class="product-success bg-{{ $product->status }}" id="{{ $product->id }}" url-image="{{ $product->url_image->src_f_a3 }}">{{ $product->name }}<span class="glyphicon glyphicon-remove"></span></div>
	@endforeach
	<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
	</td>

	<td class="tongtien moneys"><div class="label">{{ $order->total_money }} <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></div></td>
	<td class='xacnhan functions'>
		<div class="menu_funs">
			<a class="move-right" href="orders/move/status={{ ($order->id_orders_status+1) }}+id={{ $order->id }}+no_update=false">
				<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Đã xác nhận">
					<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
				</button>
			</a>
			<a class="delete" href="orders/move/status=9+id={{ $order->id }}+no_update=false">
				<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xóa">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				</button>
			</a>
		</div>
	</td>
</tr>