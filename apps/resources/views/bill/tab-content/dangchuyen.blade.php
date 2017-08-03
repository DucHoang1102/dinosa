<div role="tabpanel" class="tab-pane" id="dangchuyen">
	@include('bill.tab-content.colums')

	<div class="table-tbody">
		@foreach ($orders_dangChuyen as $date => $orders)
		<div class="date">{{ $date }}</div>
		<table class="table table-hover">
			<tbody>
				@foreach ($orders as $stt => $order)
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
								<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Trở lại">
									<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
								</button>
							</a>
							<a class="move-right" href="orders/move/status=5+id={{ $order->id }}+no_update=false"">
								<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Chuyển thành công">
									<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
								</button>
							</a>
							<a class="delete" href="orders/move/status=7+id={{ $order->id }}+no_update=false"">
								<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Chuyển thất bại">
									<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
								</button>
							</a>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@endforeach
	</div>
</div> <!--/.dangchuyen-->