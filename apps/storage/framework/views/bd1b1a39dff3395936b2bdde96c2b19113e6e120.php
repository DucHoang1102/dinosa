
<div class="menu_funs">
	
	<a class="move-left" href="orders/move/status=<?php echo e(($order->id_orders_status-1)); ?>+id=<?php echo e($order->id); ?>+no_update=false"" <?php echo e(isset($button1) ? $button1 : 'style=display:none'); ?>>
		<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Trở lại">
			<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
		</button>
	</a>
	
	<a class="move-right" href="orders/move/status=<?php echo e(($order->id_orders_status+1)); ?>+id=<?php echo e($order->id); ?>+no_update=false" <?php echo e(isset($button2) ? $button2 : 'style=display:none'); ?>>
		<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Chuyển tiếp">
			<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
		</button>
	</a>
	
	<a class="delete" href="orders/move/status=9+id=<?php echo e($order->id); ?>+no_update=false" <?php echo e(isset($button3) ? $button3 : 'style=display:none'); ?>>
		<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xóa">
			<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
		</button>
	</a>
	
	<a class="move-left" href="orders/move/status=<?php echo e(1); ?>+id=<?php echo e($order->id); ?>+no_update=true" <?php echo e(isset($button4) ? $button4 : 'style=display:none'); ?>>
		<button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Phục hồi">
			<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
		</button>
	</a>
	
	<a class="delete" href="orders/delete-permanently/<?php echo e($order->id); ?>" <?php echo e(isset($button5) ? $button5 : 'style=display:none'); ?>>
		<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xóa vĩnh viễn">
			<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
		</button>
	</a>
	
	<a class="move-right" href="orders/move/status=5+id=<?php echo e($order->id); ?>+no_update=false" <?php echo e(isset($button6) ? $button6 : 'style=display:none'); ?>>
		<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Chuyển thành công">
			<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
		</button>
	</a>
	
	<a class="delete" href="orders/move/status=7+id=<?php echo e($order->id); ?>+no_update=false" <?php echo e(isset($button7) ? $button7 : 'style=display:none'); ?>>
		<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Chuyển thất bại">
			<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
		</button>
	</a>
	
	<?php if($order->id_orders_status == 5): ?>
		<a href="orders/move/status=6+id=<?php echo e($order->id); ?>+no_update=true" <?php echo e(isset($button8) ? $button8 : 'style=display:none'); ?>> 
			<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Trở lại">
				<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
				Chưa thanh toán
			</button>
		</a>
	<?php elseif($order->id_orders_status == 6): ?>
		<a href="orders/move/status=5+id=<?php echo e($order->id); ?>+no_update=true"" <?php echo e(isset($button9) ? $button9 : 'style=display:none'); ?>> 
			<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Trở lại">
				<span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
				Đã thanh toán
			</button>
		</a>
	<?php endif; ?>
	
	<div class="menu_funs">
		<?php if($order->id_orders_status == 7): ?>
			<a href="orders/move/status=8+id=<?php echo e($order->id); ?>+no_update=true" <?php echo e(isset($button10) ? $button10 : 'style=display:none'); ?>> 
				<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Chưa trả hàng">
					<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
					Chưa trả hàng
				</button>
			</a>
		<?php elseif($order->id_orders_status == 8): ?>
			<a class="datrahang" href="orders/move/status=7+id=<?php echo e($order->id); ?>+no_update=true" <?php echo e(isset($button11) ? $button11 : 'style=display:none'); ?>> 
				<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Đã trả hàng">
					<span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
					Đã trả hàng
				</button>
			</a>
		<?php endif; ?>
	</div>
</div>
