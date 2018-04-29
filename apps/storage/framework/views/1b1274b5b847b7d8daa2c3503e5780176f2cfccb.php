<?php 
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
 ?>

<div class="row">
	<div class="col-xs-7 count-embryo-tshirt" style="font-size:1.5em; height: 780px;">
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
		      <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $embryo_tshirt => $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		      	<tr>
		          <td><b> <?php echo e($embryo_tshirt); ?> </b></td>
		          <td> <?php echo e($size['S']); ?> </td>
		          <td> <?php echo e($size['M']); ?> </td>
		          <td> <?php echo e($size['L']); ?> </td>
		          <td> <?php echo e($size['XL']); ?> </td>
		          <td> <?php echo e($size['XXL']); ?> </td>
		        </tr>
		      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		    </tbody>
		  </table>
	</div>
</div>