<?php 
	$id               = 'chuyenthatbai';
	$getByDate        = true;
	$ordersByDate     = $orders_chuyenThatBai;
	$fun              = 4;
	$input            = false;
	$icon_add_product = false;
	$button10         = 'style=display:inline-block';
	$button11         = 'style=display:inline-block';
 ?>


<?php echo $__env->make('orders.tab-content.base.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>