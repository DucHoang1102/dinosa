@php
	$result = [];

	foreach ($orders_daXacNhan as $key => $order) {
		foreach ($order->products as $key => $product) {

			$embryo_tshirt = $product->name_embryo_tshirt;
			$size = $product->size;

			if (!array_key_exists($embryo_tshirt, $result)) { 
				$result[$embryo_tshirt] = ["S" => 0, "M" => 0, "L" => 0, "XL" => 0, "XXL" => 0];
				$result[$embryo_tshirt][$size] = $result[$embryo_tshirt][$size] + 1;
			}
			else {
				$result[$embryo_tshirt][$size] = $result[$embryo_tshirt][$size] + 1;
			}

		}
	}
@endphp

<div class="row">
	<div class="col-xs-7 count-embryo-tshirt" style="font-size:1.5em; height: 1550px;">
		<table class="table" style="border: 2px solid black">
		    <thead>
		      <tr>
		        <th> Phôi áo </th>
		        <th> S </th>
		        <th> M </th>
		        <th> L </th>
		        <th> XL </th>
		        <th> XXL </th>
		      </tr>
		    </thead>
		    <tbody>
		      @foreach ($result as $embryo_tshirt => $size)
		      	<tr>
		          <td><b> {{ $embryo_tshirt }} </b></td>
		          <td> {{ $size['S'] }} </td>
		          <td> {{ $size['M'] }} </td>
		          <td> {{ $size['L'] }} </td>
		          <td> {{ $size['XL'] }} </td>
		          <td> {{ $size['XXL'] }} </td>
		        </tr>
		      @endforeach
		    </tbody>
		  </table>
	</div>
</div>