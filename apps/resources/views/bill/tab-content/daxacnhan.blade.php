<div role="tabpanel" class="tab-pane" id="daxacnhan"><!--Content Tab Đơn mới -->	
	<h1>Đã xác nhận</h1>
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
		<tbody>
			@php $i = 0; @endphp
			@foreach ($orders_donMoi as $stt => $order)
			<tr>
				<td class="stt">
					{{ $stt + 1}}.
				</td>
				<td class="hoten">
					{{ $order->name }}
				</td>
				<td class="phone">
					{{ $order->phone }}
				</td>
				<td class="address">
					{{ $order->address }}
				</td>
				<td class="sanpham">
					@foreach ($order->produces as $produces)
						<span> {{ $produces->name }} <span class="size">({{ $produces->size }})</span> </span>
					@endforeach
				</td>
				<td class="moneys">
					<div class="label">
						{{ $order->money }}
					</div>
				</td>
				<td>
					<td class='functions'>
						<button type="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></button>
						<button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
					</td>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div> 