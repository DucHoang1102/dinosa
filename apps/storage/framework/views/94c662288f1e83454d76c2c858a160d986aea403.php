
<table class="table <?php echo e(isset($table_hover) ? $table_hover : 'table-hover'); ?>">
	<?php if(count($orders) == 0): ?><?php echo '<div class="data-empty" style="font-style:italic;font-weight:bold;padding-left:10px">Dữ liệu trống</div>'; ?><?php endif; ?>
	<tbody>
		<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stt => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php echo $__env->make('orders.tab-content.tr', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>