<?php 
	$id               = 'donmoi';
	$getByDate        = false;
	$orders           = $orders_donMoi;
	$input            = true;
	$icon_add_product = true;
	$product_icon     = 'glyphicon-remove';
	$plus_icon        = 'glyphicon glyphicon-plus';
	$fun              = 1;
	$table_hover      = '';
	$button2          = 'style=display:inline-block';
	$button3          = 'style=display:inline-block';
	$funs_donmoi      = 'style=display:inline-block';
 ?>



<?php echo $__env->make('orders.colums-content.table.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>