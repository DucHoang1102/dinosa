<div role="tabpanel" class="tab-pane" id="thungrac">
	@include('orders.layouts.colums')

	<div class="table-tbody">
		<table class="table table-hover">
			<tbody>
				@foreach ($orders_thungRac as $stt => $order)
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
							<a class="move-left" href="orders/move/status={{ 1 }}+id={{ $order->id }}+no_update=true">
								<button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Phục hồi">
									<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
								</button>
							</a>
							<a class="delete" href="orders/delete-permanently/{{ $order->id_customers }}/{{ $order->id }}">
								<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xóa vĩnh viễn">
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
</div> <!--/.daxacnhan-->
