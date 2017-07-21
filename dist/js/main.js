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

var orders = {
	html : function (name="", phone="", address="", _id_customer="") {
		var stt = helper.increments();
		return `<tr>
			<input type="hidden" name="_id_order" value=""/>
			<input type="hidden" name="_id_customer" value="${_id_customer}"/>
			<td class="stt">${stt}.</td>
			<td class="hoten"><input type="text" name="name" value="${name}" placeholder="Name"></td>
			<td class="phone"><input type="text" name="phone" value="${phone}" placeholder="09..."></td>
			<td class="address"><input type="text" name="address" value="${address}" placeholder="Address"></td>
			<td class="sanpham"><input type="text" name="produce" value="" placeholder=""><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td>
			<td class="moneys"><div class="label">250,000 <span class="glyphicon glyphicon-plus" aria-hidden="true"></div></td>
			<td class='functions'>
				<button type="button" class="btn btn-success btn-sm disabled"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Xác nhận</button>
				<button type="button" class="btn btn-danger btn-sm cancel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Xóa</button>
			</td>
		</tr>`;
	},

	create: function () {
		var $this = this;
		// Thêm đơn hàng
		$('#donmoi .add-order').click(function () {
			$('#donmoi tbody').append($this.html());
			return false;
		});
		// Xóa đơn hàng - Đơn xóa sẽ thêm vào trường Thùng rác
		$('#donmoi').on('click', '.functions .cancel', function () {
			$(this).parent().parent().hide('200', function() {
				$(this).remove();
			});;
			return false;
		});
		// Tạo thêm sản phẩm
		$('#donmoi tbody').on('click', '.sanpham .glyphicon', function () {
			$(this).before('<input type="text" name="" placeholder="">');
			return false;
		}).click();
	},

	flagAjax: true,
	Ajax: function (datas) {
		var $this = this;
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

		if ($this.flagAjax == false) return false;

		$this.flagAjax = false;

		$.ajax({
			url      : 'orders/add',
			type     : 'post',	
			dataType : 'text',	
			data     : datas,
			success  : function (result) {
				if (result != null) {
					$this.viewTemplate(result);
				}
			},
			error: function (xhr, status, errorThrown) {
		        //The message added to Response object in Controller can be retrieved as following.
		        $('html').html(xhr.responseText);
		    }
		}).always(function() {
			$this.flagAjax = true;
		});
	},

	viewTemplate: function (orders) {
		var $this  = this;
		var orders = $.parseJSON(orders);

		$('#donmoi tbody').html('');
		$.each(orders, function(index, order) {
			var html = $this.html(order.name, order.phone, order.address, order.id);
			$('#donmoi tbody').append(html);
		});
	},

	view: function () {
		this.Ajax({_action_order: 'view'});
	},

	timeout: null,
	add: function () {
		var $this = this;
		$('#donmoi tbody').on('keyup', 'input', function() {
			var this_order = $(this).parent().parent();

			var datas = {
				_action_order : 'add',
				_id_order     : this_order.find('input[name=_id_order]').val(),
				_id_customer  : this_order.find('input[name=_id_customer]').val(),
				name          : this_order.find('input[name=name]').val(),
				phone         : this_order.find('input[name=phone]').val(),
				address       : this_order.find('input[name=address]').val(),
				produces      : (function(){
								let produces = {};
								$.each(this_order.find('input[name=produce]'),function(index, produce) {
									produces[index] = $(produce).val();
								});
								return produces;
							})(),
			};

			if ($this.timeout) {
				clearTimeout($this.timeout);
			}
			$this.timeout = setTimeout(function() {
				$this.Ajax(datas);
			}, 3000);

			return false;
		});
	},
}


orders.view();
orders.create();
orders.add();


})(jQuery);