<?php  use App\functions\helpers\ConvertMoney;  ?>

<div class="detail detail-<?php echo e($order->id); ?>" id_post="<?php echo e($order->id_post); ?>">
	<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>

	<div class="d d-customer">
		<h3><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Thông tin khách hàng</h3>

		<div class="d-i"> <span class="d-label">Mã post: </span> <span class="d-info"><?php echo e($order->id_post); ?></span> </div> 
		<div class="d-i"> <span class="d-label">Họ tên:  </span> <span class="d-info"><?php echo e($order->name); ?></span> </div>
		<div class="d-i"> <span class="d-label">Phone:   </span> <span class="d-info"><?php echo e($order->phone); ?></span> </div>
		<div class="d-i"> <span class="d-label">Địa chỉ: </span> <span class="d-info"><?php echo e($order->address); ?></span> </div>
	</div>

	<div class="d d-order">
		<h3> <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Thông tin đơn hàng</h3>

		<div class="d-i">
			<?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<span class="d-label-b b"><?php echo e($product->name); ?></span> <span class="d-info-b"><?php echo e(ConvertMoney::get($product->price)); ?></span><br>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<span class="d-label-b b">Phụ phí</span> <span class="d-info-b"><?php echo e($order->surcharge_money); ?></span><br>
			<span class="d-label-b b">Tiền ship</span> <span class="d-info-b"><?php echo e($order->ship_customer_money); ?></span><br>
			<span class="d-label-b r b"> <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>Tổng tiền</span> <span class="d-info-b r b"><?php echo e($order->total_money); ?> vnđ</span> 
		</div>
	</div>

	<div class="d d-status">
		<h3> <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> Trạng thái đơn hàng</h3>
		<a href="#" class="d-o-where">
			<button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Xem hàng đang ở đâu?</button>
		</a>
	</div>

</div>