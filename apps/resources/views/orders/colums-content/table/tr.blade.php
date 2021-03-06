<tr>
	<input type="hidden" name="_id_order" value="{{ $order->id }}"/>
	<input type="hidden" name="_id_customer" value="{{ $order->id_customers }}"/>
	<td class="stt">{{ $stt + 1 }}.<span class="glyphicon glyphicon-info-sign eye-node" aria-hidden="true"></span></td>
	<td class="hoten">
		@if ($input == true)
		<input type="text" name="name" value="{{ $order->name }}" maxlength="35" autocomplete="off">
		@else
		{{ $order->name }}
		@endif
	</td>
	<td class="phone">
		@if ($input == true)
		<input type="text" name="phone" value="{{ $order->phone }}" maxlength="11" autocomplete="off">
		@else
		{{ $order->phone }}
		@endif
	</td>
	<td class="diachi address">
		@if ($input == true)
		<input type="text" name="address" value="{{ $order->address }}" maxlength="99" autocomplete="off">
		@else
		{{ $order->address }}
		@endif
	</td>
	<td class="sanpham">
	@foreach ($order->products as $product)
		<div class="product-success bg-{{ $product->status }}" status={{ $product->status }} id="{{ $product->id }}" url-image="{{ $product->url_image }}">{{ $product->name }}<span class="glyphicon {{ $product_icon }}" aria-hidden="true"></span></div>
	@endforeach
	@if ($icon_add_product)
		<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
	@endif
	</td>
	<td class="tongtien moneys">
		<div class="label">{{ $order->total_money }} <span class="{{ $plus_icon or '' }}" aria-hidden="true"></span></div>
		<span id="ship_money" hidden>{{ $order->ship_customer_money }}</span>
		<span id="phuphi_money" hidden>{{ $order->surcharge_money }}</span>
	</td>
	<td class='xacnhan functions'>
		@include('orders.colums-content.funs.menu-funs-general')
	</td>
</tr>