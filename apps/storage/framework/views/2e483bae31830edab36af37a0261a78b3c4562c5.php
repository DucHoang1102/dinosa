<?php 
	$id               = 'chuyenthanhcong';
	$getByDate        = true;
	$ordersByDate     = $orders_chuyenThanhCong;
	$fun              = 4;
	$input            = false;
	$icon_add_product = false;
	$button8          = 'style=display:inline-block';
	$button9          = 'style=display:inline-block';
 ?>


<?php echo $__env->make('orders.tab-content.base.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>