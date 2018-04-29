<div role="tabpanel" class="tab-pane active" id="donmoi"><!--Content Tab Đơn mới -->

	<?php echo $__env->make('bill.tab-content.colums', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="table-tbody">
		<table class="table">
			<tbody>
				<?php $__currentLoopData = $orders_donMoi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stt => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<input type="hidden" name="_id_order" value="<?php echo e($order->id); ?>"/>
					<input type="hidden" name="_id_customer" value="<?php echo e($order->id_customers); ?>"/>
					<td class="stt"><?php echo e($stt + 1); ?>.</td>
					<td class="hoten"><input type="text" name="name" value="<?php echo e($order->name); ?>" maxlength="35" autocomplete="off"></td>
					<td class="phone"><input type="text" name="phone" value="<?php echo e($order->phone); ?>" maxlength="11" autocomplete="off"></td>
					<td class="diachi address"><input type="text" name="address" value="<?php echo e($order->address); ?>" maxlength="99" autocomplete="off"></td>

					<td class="sanpham">
					<?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="product_success" id="<?php echo e($product->id); ?>" url-image="<?php echo e($product->url_image->src_f_a3); ?>"><?php echo e($product->name); ?><span class="glyphicon glyphicon-remove"></span></div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
					</td>

					<td class="tongtien moneys"><div class="label"><?php echo e($order->total_money); ?> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></div></td>
					<td class='xacnhan functions'>
						<div class="menu_funs">
							<a class="move-right" href="orders/move/status=<?php echo e(($order->id_orders_status+1)); ?>+id=<?php echo e($order->id); ?>+no_update=false">
								<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Đã xác nhận">
									<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
								</button>
							</a>
							<a class="delete" href="orders/move/status=9+id=<?php echo e($order->id); ?>+no_update=false">
								<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xóa">
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
								</button>
							</a>
						</div>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
	<div class="add-order">
		<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
	</div>
</div> <!--/.donmoi-->