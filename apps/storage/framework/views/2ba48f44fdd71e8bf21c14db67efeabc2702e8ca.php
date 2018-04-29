
<table class="table <?php echo e(isset($table_hover) ? $table_hover : 'table-hover'); ?>">
	<tbody>
		<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stt => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php echo $__env->make('orders.colums-content.table.tr', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('orders.colums-content.table.detail', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>