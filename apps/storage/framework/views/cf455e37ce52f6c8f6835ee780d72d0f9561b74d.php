<div role="tabpanel" class="tab-pane" id="daxacnhan"><!--Content Tab Đơn mới -->	

	<?php echo $__env->make('bill.tab-content.colums', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="table-tbody">
		<table class="table table-hover">
			<tbody>
				<?php $__currentLoopData = $orders_daXacNhan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stt => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<input type="hidden" name="_id_order" value="<?php echo e($order->id); ?>"/>
					<input type="hidden" name="_id_customer" value="<?php echo e($order->id_customers); ?>"/>
					<td class="stt"><?php echo e($stt + 1); ?>.</td>
					<td class="hoten"><?php echo e($order->name); ?></td>
					<td class="phone"><?php echo e($order->phone); ?></td>
					<td class="diachi address"><?php echo e($order->address); ?></td>
					<td class="sanpham">
					<?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="product_success" id="<?php echo e($product->id); ?>" url-image="<?php echo e($product->url_image->src_f_a3); ?>"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> <?php echo e($product->name); ?> </div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</td>
					<td class="tongtien moneys"><div class="label"><?php echo e($order->total_money); ?></div></td>
					<td class='xacnhan functions'>
						<div class="menu_funs">
							<a class="move-left" href="orders/move/status=<?php echo e(($order->id_orders_status-1)); ?>+id=<?php echo e($order->id); ?>+no_update=false"">
								<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Trở về đơn mới">
									<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
								</button>
							</a>
							<a class="move-right" href="orders/move/status=<?php echo e(($order->id_orders_status+1)); ?>+id=<?php echo e($order->id); ?>+no_update=false"">
								<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Đã in xong">
									<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
								</button>
							</a>
							<a class="delete" href="orders/move/status=9+id=<?php echo e($order->id); ?>+no_update=false"">
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

	<div class="funs-xacnhan">
		<a class="print-product" href="">
			<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="In toàn bộ sản phẩm">
				<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
			</button>
		</a>
	</div>
</div> <!--/.daxacnhan-->

