<div role="tabpanel" class="tab-pane" id="chuyenthatbai">
	@include('orders.layouts.colums')

	<div class="table-tbody">
		@if (count($orders_chuyenThatBai) == 0){!! '<div style="font-style:italic;font-weight:bold;padding-left:10px">Dữ liệu trống</div>' !!}@endif
		@foreach ($orders_chuyenThatBai as $date => $orders)
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
						<div class="product-success bg-{{ $product->status }}" id="{{ $product->id }}" url-image="{{ $product->url_image->src_f_a3 }}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> {{ $product->name }} </div>
					@endforeach
					</td>
					<td class="tongtien moneys"><div class="label">{{ $order->total_money }}</div></td>
					<td class='xacnhan functions'>
						<div class="menu_funs">
							@if ($order->id_orders_status == 7)
								<a href="orders/move/status=8+id={{ $order->id }}+no_update=true"> 
									<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Chưa trả hàng">
										<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
										Chưa trả hàng
									</button>
								</a>
							@elseif ($order->id_orders_status == 8)
								<a class="datrahang" href="orders/move/status=7+id={{ $order->id }}+no_update=true""> 
									<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Đã trả hàng">
										<span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
										Đã trả hàng
									</button>
								</a>
							@endif
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@endforeach
	</div>
</div> <!--/.chuyenthatbai-->