<div role="tabpanel" class="tab-pane active" id={{ $id }}><!--Content Tab Đơn mới -->
	<div class="table-thead">
		@include('orders.layouts.colums')
	</div>
	<div class="table-tbody">
		{{-- Lấy orders theo ngày --}}
		@if ($getByDate == true)
			@foreach ($ordersByDate as $date => $orders)  
				<div class="date">{{ $date }}</div>
				@include('orders.tab-content.base.table')
			@endforeach
		@else
			{{-- Orders không theo ngày --}}
			@include('orders.tab-content.base.table')
		@endif
	</div>
	@include('orders.tab-content.funs.menu-funs-colums')
</div>