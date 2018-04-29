<div role="tabpanel" class="tab-pane" id="dainxong">
	<?php echo $__env->make('bill.tab-content.colums', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="table-tbody">
		<table class="table table-hover">
			<tbody>
				<?php $__currentLoopData = $orders_daInXong; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stt => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<input type="hidden" name="_id_order" value="<?php echo e($order->id); ?>"/>
					<input type="hidden" name="_id_customer" value="<?php echo e($order->id_customers); ?>"/>
					<td class="stt"><?php echo e($stt + 1); ?>.</td>
					<td class="hoten"><?php echo e($order->name); ?></td>
					<td class="phone"><?php echo e($order->phone); ?></td>
					<td class="diachi address"><?php echo e($order->address); ?></td>
					<td class="sanpham">
					<?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="product_success" id="<?php echo e($product->id); ?>" url-image="<?php echo e($product->url_image->src_f_a3); ?>"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> <?php echo e($product->name); ?> </div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</td>
					<td class="tongtien moneys"><div class="label"><?php echo e($order->total_money); ?></div></td>
					<td class='xacnhan functions'>
						<div class="menu_funs">
							<a class="move-left" href="orders/move/status=<?php echo e(($order->id_orders_status-1)); ?>+id=<?php echo e($order->id); ?>+no_update=false"">
								<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Trở về xác nhận">
									<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
								</button>
							</a>
							<a class="move-right" href="orders/move/status=<?php echo e(($order->id_orders_status+1)); ?>+id=<?php echo e($order->id); ?>+no_update=false"">
								<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Gửi vận chuyển">
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

	<div class="funs-dainxong">
		<a class="print-orders" href="">
			<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="In nhãn">
				<span class="glyphicon glyphicon-print" aria-hidden="true"></span> In nhãn
			</button>
		</a>
		<a class="send-mail" href="">
			<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Gửi đơn hàng cho vnpost">
				<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Gửi Vnpost
			</button>
		</a>
	</div>

</div> <!--/.dainxong-->