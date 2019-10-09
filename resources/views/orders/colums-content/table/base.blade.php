<div role="tabpanel" class="tab-pane active" id={{ $id }}><!--Content Tab Đơn mới -->
	<div class="table-thead">
		@include('orders.colums-list.colums')
	</div>
	<div class="table-tbody">
		@if ( isset($orders) && count($orders)==0 || isset($ordersByDate) && count($ordersByDate)==0 ){!! '<div class="data-empty" style="font-style:italic;font-weight:bold;padding-left:10px">Dữ liệu trống</div>' !!}@endif

		{{-- Lấy orders theo ngày --}}
		@if ($getByDate == true)
			@foreach ($ordersByDate as $date => $orders)  
				<div class="date">{{ $date }}</div>
				@include('orders.colums-content.table.table')
			@endforeach
		{{-- Orders không theo ngày --}}
		@else
			@include('orders.colums-content.table.table')
		@endif
	</div>
	@include('orders.colums-content.funs.menu-funs-colums')
</div>