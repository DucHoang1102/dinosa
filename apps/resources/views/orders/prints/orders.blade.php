<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Print Orders</title>
	<!-- Bootstrap 3.3.7 CSS -->
	<link href="\dist\plugins\bootstrap\css\bootstrap.min.css" rel="stylesheet" type="text/css">

	<!-- Jquery 3.2.1 -->
	<script src="\dist\plugins\jquery\jquery-3.2.1.min.js" type="text/javascript"></script>

	<style type="text/css">
		.print {
			padding: 15px 15px;
			width: 100%;
			height: 100%;
		}
		.print .labels {
			position: relative;
			padding: 7px 5px;
			border: 2px solid black;
			border-radius: 5px;
			width: 100%;
			height: 100%;
		}
		.print .labels h3 {
			color: #000000;
			margin-top: 15px;
			padding-top: 5px;
			border-top: 2px solid #cecece;
		}
		.print .labels .stt {
			border-radius: 7px;
			border: 3px solid black;
			padding: 0px 7px;
		}
		.print .labels .glyphicon {
			font-size: 0.8em;
			margin-right: 0.3em;
		}
		.print .labels div {
			position: relative;
			margin-bottom: 5px;
			border-bottom: 1px solid #eaeaea;
		}
		.print .labels-left {
			display: inline-block;
			font-size: 1.3em;
			width: 20%;
			text-align: right;
			font-weight: bold;
		}
		.print .labels-right {
			display: inline-block;
			vertical-align: top;
			padding-left: 3px;
			font-size: 1.2em;
			width: 79%;
			color: #333333;
			font-weight: bold;
		}
		.print .col-xs-6 {
			overflow: hidden;
			margin-top: 10px;
			margin-bottom: 15px;
			height: 370px;
		}
		.print .glyphicon-remove-circle {
			cursor: pointer;
			display: none;
			position: absolute;
			margin: 0px !important;
			top: 5px;
			right: 5px;
			font-size: 1.9em !important;
		}
		.print .labels:hover .glyphicon-remove-circle{
			display: block;
		}
		.print .labels:hover {
			border: 2px solid red;
		}
		@media only print  {
			.print .labels:hover {
				border: 2px solid black;
			}
			.print .labels:hover .glyphicon-remove-circle {
				display: none;
			}
		}
	</style>
</head>
<body>
	<div class="print">
		@include('orders.prints.countEmbryoTshirt')

		<div class="row">
			@foreach ($orders_daXacNhan as $stt => $order)
				<div class="col-xs-6">
					<div class="labels">
						<h3 style="border:none; margin-top:0px;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Thông khách hàng </h3>
						<div>
							<span class="labels-left">HỌ TÊN: </span>    <span class="labels-right">{{ $order->name or "" }}</span>
						</div>
						<div>
							<span class="labels-left">SĐT: </span>       <span class="labels-right">{{ $order->phone or "" }}</span>
						</div>
						<div>
							<span class="labels-left">ĐỊA CHỈ:</span>    <span class="labels-right">{{ $order->address or "" }}</span>
						</div>
						<div style="border: none">
							<span class="labels-left">TỔNG THU: </span>  <span class="labels-right">{{ $order->total_money or 0 }} vnđ</span>
						</div>
						<h3><span class="glyphicon glyphicon glyphicon-home" aria-hidden="true"></span>Thông tin shop</h3>
						<div>
							<span class="">SDT : </span>  <span class=""><b>0972 982 082</b></span>
						</div>
						<div>
							<span class="">FB : </span>   <span class=""><b>fb/aodoitinhyeu</b></span>
						</div>
						<div style="border:none">
							<span class="">Chú ý :</span> <span class=""><b>Bưu tá vui lòng cho khách xem hàng và liên hệ với Shop trong trường hợp không giao được hàng. Sự phát triển của chúng tôi phụ thuộc phần lớn vào cách làm việc của các bạn. Cảm ơn rất nhiều!!!</b></span>
						</div>
						<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
					</div><!--/.labels-->
				</div><!--/.col-xs-6-->
			@endforeach
		</div><!--/.row-->
	</div> <!--/.print-->

	<script type="text/javascript">
		(function ($) {
			
			$('.print').on('click', '.glyphicon-remove-circle', function(){
				$(this).parent().parent().hide(400, function(){
					$(this).remove();
				});
			});

		})(jQuery);
	</script>
</body>
</html>