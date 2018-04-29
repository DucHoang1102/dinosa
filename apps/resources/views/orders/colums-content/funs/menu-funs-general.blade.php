{{-- Chức năng chung cho các trường --}}
<div class="menu_funs">
	{{-- Nút trở về --}}
	<a class="move-left" href="orders/move/status={{ ($order->id_orders_status-1) }}+id={{ $order->id }}+no_update=false"" {{ $button1 or 'style=display:none' }}>
		<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Trở lại">
			<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
		</button>
	</a>
	{{-- Nút chuyển tiếp --}}
	<a class="move-right" href="orders/move/status={{ ($order->id_orders_status+1) }}+id={{ $order->id }}+no_update=false" {{ $button2 or 'style=display:none' }}>
		<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Chuyển tiếp">
			<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
		</button>
	</a>
	{{-- Nút xóa vào thùng rác --}}
	<a class="delete" href="orders/move/status=9+id={{ $order->id }}+no_update=false" {{ $button3 or 'style=display:none' }}>
		<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xóa">
			<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
		</button>
	</a>
	{{-- Nút phục hồi trong thùng rác --}}
	<a class="move-left" href="orders/move/status={{ 1 }}+id={{ $order->id }}+no_update=true" {{ $button4 or 'style=display:none' }}>
		<button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Phục hồi">
			<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
		</button>
	</a>
	{{-- Nút xóa vĩnh viễn --}}
	<a class="delete" href="orders/delete-permanently/{{ $order->id }}" {{ $button5 or 'style=display:none' }}>
		<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xóa vĩnh viễn">
			<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
		</button>
	</a>
	{{-- Nút chuyển thành công --}}
	<a class="move-right" href="orders/move/status=5+id={{ $order->id }}+no_update=false" {{ $button6 or 'style=display:none' }}>
		<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Chuyển thành công">
			<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
		</button>
	</a>
	{{-- Nút chuyển thất bại --}}
	<a class="delete" href="orders/move/status=7+id={{ $order->id }}+no_update=false" {{ $button7 or 'style=display:none' }}>
		<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Chuyển thất bại">
			<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
		</button>
	</a>
	{{-- Nhóm nút trường chuyển thành công --}}
	@if ($order->id_orders_status == 5)
		<a href="orders/move/status=6+id={{ $order->id }}+no_update=true" {{ $button8 or 'style=display:none' }}> 
			<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Trở lại">
				<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
				Chưa thanh toán
			</button>
		</a>
	@elseif ($order->id_orders_status == 6)
		<a href="orders/move/status=5+id={{ $order->id }}+no_update=true"" {{ $button9 or 'style=display:none' }}> 
			<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Trở lại">
				<span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
				Đã thanh toán
			</button>
		</a>
	@endif
	{{-- Nhóm nút trường chuyển thất bại --}}

	@if ($order->id_orders_status == 7)
		<a href="orders/move/status=8+id={{ $order->id }}+no_update=true" {{ $button10 or 'style=display:none' }}> 
			<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Chưa trả hàng">
				<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
				Chưa trả hàng
			</button>
		</a>
	@elseif ($order->id_orders_status == 8)
		<a class="datrahang" href="orders/move/status=7+id={{ $order->id }}+no_update=true" {{ $button11 or 'style=display:none' }}> 
			<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Đã trả hàng">
				<span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
				Đã trả hàng
			</button>
		</a>
	@endif
</div>{{-- /.menu_funs --}}
