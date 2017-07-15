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

// Tạo đơn hàng - createBill
function addBill() {
	var today = helper.getToday();
	var stt   = helper.increments();
	var bill_html = 
	`<tr>
		<td class="stt">${stt}.</td>
		<td><input type="text" value="${today}" disabled/></td>
		<td><input type="text" name="" placeholder="Name"></td>
		<td><input type="text" name="" placeholder="09..."></td>
		<td><input type="text" name="" placeholder="Address"></td>
		<td><input type="text" name="" placeholder="A12..."></td>
		<td><input type="number" name=""></td>
		<td class='chucnang'>
			<button type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Ok</button>
			<button type="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Xóa</button>
		</td>
	</tr>`;

	return bill_html;
};
$('#donmoi .add-bill').click(function () {
	$('#donmoi tbody').append(addBill());
	return false;
});


// TEst sẽ xóa sau
helper.increments();

})(jQuery);