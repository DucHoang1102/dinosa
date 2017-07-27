<div role="tabpanel" class="tab-pane active" id="donmoi"><!--Content Tab Đơn mới -->
	<div class="table-thead">
		<table class="table">
			<thead>
				<tr>
					<th class="stt"></th>
					<th class="hoten"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Họ tên</th>
					<th class="phone"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>Phone</th>
					<th class="diachi"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>Địa chỉ</th>
					<th class="sanpham"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span>Sản phẩm</th>
					<th class="tongtien"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span>Tổng tiền</th>
					<th class="chucnang"></th>
				</tr>
			</thead>
		</table>
	</div>
	<div class="table-tbody">
		<table class="table">
			<tbody>
				@foreach ($orders_donMoi as $stt => $order)
				<tr>
					<input type="hidden" name="_id_order" value="{{ $order->id }}"/>
					<input type="hidden" name="_id_customer" value="{{ $order->id_customers }}"/>
					<td class="stt">{{ $stt + 1 }}.</td>
					<td class="hoten"><input type="text" name="name" value="{{ $order->name }}" maxlength="35" autocomplete="off"></td>
					<td class="phone"><input type="text" name="phone" value="{{ $order->phone }}" maxlength="11" autocomplete="off"></td>
					<td class="diachi address"><input type="text" name="address" value="{{ $order->address }}" maxlength="99" autocomplete="off"></td>

					<td class="sanpham">
					@foreach ($order->products as $product)
						<div class="product_success" id="{{ $product->id }}">{{ $product->name }}<span class="glyphicon glyphicon-remove"></span></div>
					@endforeach
					<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
					</td>

					<td class="tongtien moneys"><div class="label">{{ $order->total_money }} <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></div></td>
					<td class='xacnhan functions'>
					<button type="button" class="btn btn-success btn-sm disabled"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Xác nhận</button>
					<button type="button" class="btn btn-danger btn-sm cancel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Xóa</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="add-order">
		<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
	</div>
</div> <!--/.donmoi-->

