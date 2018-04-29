<tr>
	<input type="hidden" name="_id_order" value="<?php echo e($order->id); ?>"/>
	<input type="hidden" name="_id_customer" value="<?php echo e($order->id_customers); ?>"/>
	<td class="stt"><?php echo e($stt + 1); ?>.<span class="glyphicon glyphicon-info-sign eye-node" aria-hidden="true"></span></td>
	<td class="hoten">
		<?php if($input == true): ?>
		<input type="text" name="name" value="<?php echo e($order->name); ?>" maxlength="35" autocomplete="off">
		<?php else: ?>
		<?php echo e($order->name); ?>

		<?php endif; ?>
	</td>
	<td class="phone">
		<?php if($input == true): ?>
		<input type="text" name="phone" value="<?php echo e($order->phone); ?>" maxlength="11" autocomplete="off">
		<?php else: ?>
		<?php echo e($order->phone); ?>

		<?php endif; ?>
	</td>
	<td class="diachi address">
		<?php if($input == true): ?>
		<input type="text" name="address" value="<?php echo e($order->address); ?>" maxlength="99" autocomplete="off">
		<?php else: ?>
		<?php echo e($order->address); ?>

		<?php endif; ?>
	</td>
	<td class="sanpham">
	<?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="product-success bg-<?php echo e($product->status); ?>" status=<?php echo e($product->status); ?> id="<?php echo e($product->id); ?>" url-image="<?php echo e($product->url_image); ?>"><?php echo e($product->name); ?><span class="glyphicon <?php echo e($product_icon); ?>" aria-hidden="true"></span></div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php if($icon_add_product): ?>
		<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
	<?php endif; ?>
	</td>
	<td class="tongtien moneys">
		<div class="label"><?php echo e($order->total_money); ?> <span class="<?php echo e(isset($plus_icon) ? $plus_icon : ''); ?>" aria-hidden="true"></span></div>
		<span id="ship_money" hidden><?php echo e($order->ship_customer_money); ?></span>
		<span id="phuphi_money" hidden><?php echo e($order->surcharge_money); ?></span>
	</td>
	<td class='xacnhan functions'>
		<?php echo $__env->make('orders.colums-content.funs.menu-funs-general', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</td>
</tr>