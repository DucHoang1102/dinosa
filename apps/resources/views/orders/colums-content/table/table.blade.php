{{-- table --}}
<table class="table {{ $table_hover or 'table-hover' }}">
	<tbody>
		@foreach ($orders as $stt => $order)
			@include('orders.colums-content.table.tr')
		@endforeach
	</tbody>
</table>{{-- /table --}}