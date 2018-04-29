<?php 
	$id               = 'thungrac';
	$getByDate        = false;
	$orders           = $orders_thungRac;
	$fun              = 9;
	$input            = false;
	$icon_add_product = false;
	$product_icon     = 'glyphicon-ban-circle';
	$button4          = 'style=display:inline-block';
	$button5          = 'style=display:inline-block';
	$funs_thungrac    = 'style=display:inline-block';
 ?>



<?php echo $__env->make('orders.colums-content.table.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>