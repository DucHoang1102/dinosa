(function ($) {
"use strict";

var helper = { 
	getToday  : function() {
		var date = new Date();
		return (date.getDate()) + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
	},

	increments: function() {
		var getSttLast = Array.from($('#donmoi tbody td.stt')).reverse()[0];
		getSttLast = parseInt($(getSttLast).text());
		getSttLast = isNaN(getSttLast) ? 0 : getSttLast;
		return getSttLast + 1;
	},
};

// Tạo đơn hàng - createOrders
(function createOrders() {
	function orderHtml() {
		var today = helper.getToday();
		var stt   = helper.increments();
		var order_html = 
		`<tr>
			<td class="stt">${stt}.</td>
			<td><input type="text" name="" placeholder="Name"></td>
			<td><input type="text" name="" placeholder="09..."></td>
			<td><input type="text" name="" placeholder="Address"></td>
			<td class="sanpham"><input type="text" name="" placeholder=""><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td>
			<td><div class="moneys">0 vnđ</div></td>
			<td class='chucnang'>
				<button type="button" class="btn btn-success btn-sm disabled"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Xác nhận</button>
				<button type="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Xóa</button>
			</td>
		</tr>`;
		return order_html;
	}
	$('#donmoi .add-bill').click(function () {
		$('#donmoi tbody').append(orderHtml());
		return false;
	});
})();

// Tạo sản phẩm: create products
(function createProduct() {
	var newProduceHtml = '<input type="text" name="" placeholder="">';
	$('#donmoi tbody').on('click', '.sanpham .glyphicon', function () {
		$(this).before(newProduceHtml);
		return false;
	}).click();
})();


(function testajax()
{
	$.ajax({
		url: 'ajax',
		type: 'post',
		dataType: 'text',
		data: {
			hoang: '123',
		},
		success: function (result){
			console.log(result);
		}
	});
	
})();

})(jQuery);