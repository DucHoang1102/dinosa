<div role="tabpanel" class="tab-pane" id="dainxong">
	@include('orders.layouts.colums')

	<div class="table-tbody">
		<table class="table table-hover">
			<tbody>
				@foreach ($orders_daInXong as $stt => $order)
				<tr>
					<input type="hidden" name="_id_order" value="{{ $order->id }}"/>
					<input type="hidden" name="_id_customer" value="{{ $order->id_customers }}"/>
					<td class="stt">{{ $stt + 1 }}.</td>
					<td class="hoten">{{ $order->name }}</td>
					<td class="phone">{{ $order->phone }}</td>
					<td class="diachi address">{{ $order->address }}</td>
					<td class="sanpham">
					@foreach ($order->products as $product)
						<div class="product_success" id="{{ $product->id }}" url-image="{{ $product->url_image->src_f_a3 }}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> {{ $product->name }} </div>
					@endforeach
					</td>
					<td class="tongtien moneys"><div class="label">{{ $order->total_money }}</div></td>
					<td class='xacnhan functions'>
						<div class="menu_funs">
							<a class="move-left" href="orders/move/status={{ ($order->id_orders_status-1) }}+id={{ $order->id }}+no_update=false"">
								<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Trở về xác nhận">
									<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
								</button>
							</a>
							<a class="move-right" href="orders/move/status={{ ($order->id_orders_status+1) }}+id={{ $order->id }}+no_update=false"">
								<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Gửi vận chuyển">
									<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
								</button>
							</a>
							<a class="delete" href="orders/move/status=9+id={{ $order->id }}+no_update=false"">
								<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xóa">
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
								</button>
							</a>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="funs-dainxong">
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

</div> <!--/.dainxong-->