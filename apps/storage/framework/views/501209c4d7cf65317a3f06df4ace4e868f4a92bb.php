<?php 
	$id               = 'dainxong';
	$getByDate        = false;
	$orders           = $orders_daInXong;
	$fun              = 3;
	$input            = false;
	$icon_add_product = false;
	$button1          = 'style=display:inline-block';
	$button2          = 'style=display:inline-block';
	$button3          = 'style=display:inline-block';
	$funs_dainxong    = 'style=display:inline-block';
 ?>



<?php echo $__env->make('orders.tab-content.base.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>