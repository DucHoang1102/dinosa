{{-- table --}}
<table class="table {{ $table_hover or 'table-hover' }}">
	@if (count($orders) == 0){!! '<div class="data-empty" style="font-style:italic;font-weight:bold;padding-left:10px">Dữ liệu trống</div>' !!}@endif
	<tbody>
		@foreach ($orders as $stt => $order)
			@include('orders.tab-content.base.tr')
		@endforeach
	</tbody>
</table>{{-- /table --}}