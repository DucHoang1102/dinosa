<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Print products</title>
	<style type="text/css">
		@media only screen {
			body {
				cursor: pointer;
				font-family: arial;
				background: #F5F5F5;
			}
			.container-print-product {
				max-width: 1300px;
				margin: 0 auto;
			}
			.print-product {
				padding-left: 50px;
			}
			.print-product .product {
				position: relative;
				overflow: hidden;
				display: inline-block;
				width: 200px;
				padding: 5px;
				margin: 10px;
				border: 2px solid black;
			}
			.print-product .product:hover {
				border: 2px solid red;
			}
			.print-product img {
				max-width: 100%;
			}
			.print-product .del {
				position: absolute;
				background: #595959;
				text-align: center;
				color: white;
				padding: 4px 8px;
				top: 0px;
				right: 0px;
				font-size: 0.8em;
			}
			.print-product .del:hover {
				background: black;
			}
			.print-product  .description {
				position: absolute;
				display: none;
				padding-top: 15%;
				padding-left: 3%;
				width: 100%;
				height: 100%;
				top: 0px;
				left: 0px;
				background: rgba(255, 255, 255, 0.8);
			}
			.print-product .product:hover .description{
				display: block;
			}
			.print-product  .description .info {
				display: inline-block;
				padding-left: 8%;
				padding-bottom: 3%;
			}
			.print-product  .description b {
				padding-bottom: 2%;
				display: block;
			}
			.print-product  .description hr {
				width: 90%;
			}
		}

		@media only print  {
			.print-product .product img {
				display: block !important;
				overflow: hidden;
				top: 0px !important;
				left: 0px !important;
				width: 1489px !important;
			}
			.print-product .product .del, .print-product .product .description, hr, br {
				display: none;
			}
		}
	</style>
</head>
<body>
	<div class="container-print-product">
		<div class="print-product">
			@foreach ($orders_daXacNhan as $order)
				@foreach ($order->products as $product)
					<div class="product">
						<img src="/{{ $product->url_image->src_f_a3 }}">
						<span class="description">
							<b>Tên KH:</b> 
							<span class="info"> {{ $order->name }}</span>
							<hr>
							<b>SDT:</b> 
							<span class="info"> {{ $order->phone }}</span>
							<hr>
							<b>Sản phẩm | Mã:</b> 
							<span class="info"> {{ $product->name }} | {{ $product->id_image_print }}</span>
							<hr>
							<b>Tổng tiền:</b> 
							<span class="info">{{ $order->total_money }} vnđ</span>
						</span>
						<span class="del">XÓA</span>
					</div>
				@endforeach
				<br>
			@endforeach
		</div>
	</div>

	<!-- Jquery 3.2.1 -->
	<script src="\dist\plugins\jquery\jquery-3.2.1.min.js" type="text/javascript"></script>

	<script type="text/javascript">
		(function($){

			$('.print-product').on('click', '.product .del', function() {
				$(this).parent().hide(500, function(){
					$(this).remove();
				});
			});

		})(jQuery);
	</script>
</body>
</html>