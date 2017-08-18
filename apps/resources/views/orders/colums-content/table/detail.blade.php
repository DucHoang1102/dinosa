@php use App\functions\helpers\ConvertMoney; @endphp

<div class="detail detail-{{ $order->id }}">
	<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>

	<div class="d d-customer">
		<h3><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Thông tin khách hàng</h3>

		<div class="d-i"> <span class="d-label">Mã post: </span> <span class="d-info">{{ $order->id_post }}</span> </div> 
		<div class="d-i"> <span class="d-label">Họ tên:  </span> <span class="d-info">{{ $order->name }}</span> </div>
		<div class="d-i"> <span class="d-label">Phone:   </span> <span class="d-info">{{ $order->phone }}</span> </div>
		<div class="d-i"> <span class="d-label">Địa chỉ: </span> <span class="d-info">{{ $order->address }}</span> </div>
	</div>

	<div class="d d-order">
		<h3> <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Thông tin đơn hàng</h3>

		<div class="d-i">
			@foreach ($order->products as $product)
			<span class="d-label-b b">{{ $product->name }}</span> <span class="d-info-b">{{ ConvertMoney::get($product->price) }}</span><br>
			@endforeach
			<span class="d-label-b b">Phụ phí</span> <span class="d-info-b">{{ $order->surcharge_money }}</span><br>
			<span class="d-label-b b">Tiền ship</span> <span class="d-info-b">{{ $order->ship_customer_money }}</span><br>
			<span class="d-label-b r b"> <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>Tổng tiền</span> <span class="d-info-b r b">{{ $order->total_money }} vnđ</span> 
		</div>
	</div>

	<div class="d d-status">
		<h3> <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> Trạng thái đơn hàng</h3>
	</div>

</div>