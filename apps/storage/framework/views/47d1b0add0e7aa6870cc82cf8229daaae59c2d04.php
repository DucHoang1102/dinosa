<div role="tabpanel" class="tab-pane active" id=<?php echo e($id); ?>><!--Content Tab Đơn mới -->
	<div class="table-thead">
		<?php echo $__env->make('orders.layouts.colums', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
	<div class="table-tbody">
		<?php if( isset($orders) && count($orders)==0 || isset($ordersByDate) && count($ordersByDate)==0 ): ?><?php echo '<div class="data-empty" style="font-style:italic;font-weight:bold;padding-left:10px">Dữ liệu trống</div>'; ?><?php endif; ?>

		
		<?php if($getByDate == true): ?>
			<?php $__currentLoopData = $ordersByDate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date => $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
				<div class="date"><?php echo e($date); ?></div>
				<?php echo $__env->make('orders.tab-content.base.table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		
		<?php else: ?>
			<?php echo $__env->make('orders.tab-content.base.table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endif; ?>
	</div>
	<?php echo $__env->make('orders.tab-content.funs.menu-funs-colums', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>