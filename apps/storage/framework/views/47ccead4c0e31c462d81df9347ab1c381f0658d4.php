<?php 
	$id               = 'dangchuyen';
	$getByDate        = true;
	$ordersByDate     = $orders_dangChuyen;
	$fun              = 4;
	$input            = false;
	$icon_add_product = false;
	$product_icon     = 'glyphicon-ok';
	$button1          = 'style=display:inline-block';
	$button6          = 'style=display:inline-block';
	$button7          = 'style=display:inline-block';
 ?>



<?php echo $__env->make('orders.colums-content.table.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>