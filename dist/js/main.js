(function ($) {
"use strict";

var flagAjax = true;
var timeout  = null;

var helper = { 
	getToday  : function () {
		var date = new Date();
		return (date.getDate()) + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
	},
	increments: function () {
		var getSttLast = Array.from($('#donmoi tbody td.stt')).reverse()[0];
		getSttLast = parseInt($(getSttLast).text());
		getSttLast = isNaN(getSttLast) ? 0 : getSttLast;
		return getSttLast + 1;
	},
	incrementsOK: function () {
		var getSttLast = $('#donmoi tbody td.stt');
		$.each(getSttLast, function(index, stt) {
			$(stt).text((index+1)+'.');
		});
	},
	scrollTop: function () {
		var tbody = $('#donmoi .table-tbody');
		var scrollTop = parseInt(tbody.prop('scrollHeight') - tbody.height()) + 10;
		tbody.scrollTop(scrollTop);
	},
};

function patternHTML (name="", phone="", address="", _id_customer="") {
	//var stt = helper.incrementsOK();
		return `<tr>
			<input type="hidden" name="_id_order" value=""/>
			<input type="hidden" name="_id_customer" value="${_id_customer}" maxlength="9"/>
			<td class="stt"></td>
			<td class="hoten"><input type="text" name="name" value="${name}" maxlength="35"></td>
			<td class="phone"><input type="text" name="phone" value="${phone}" maxlength="11"></td>
			<td class="diachi address"><input type="text" name="address" value="${address}" maxlength="99"></td>
			<td class="sanpham"><input type="text" name="produce" value="" placeholder=""><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td>
			<td class="tongtien moneys"><div class="label">250,000 <span class="glyphicon glyphicon-plus" aria-hidden="true"></div></td>
			<td class='xacnhan functions'>
				<button type="button" class="btn btn-success btn-sm disabled"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Xác nhận</button>
				<button type="button" class="btn btn-danger btn-sm cancel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Xóa</button>
			</td>
		</tr>`;
}

// Thêm đơn hàng
(function createOrdersNode () {
	$('#donmoi .add-order').click(function () {
		$(patternHTML()).appendTo('#donmoi tbody')
					    .hide()
					    .show(300, function () {
					        $(this).find('input[name=name]')
					    	     .focus();
					    });
		helper.incrementsOK();
		helper.scrollTop();
		return false;

	});
})();

// Tạo thêm sản phẩm
(function createProducesNode () {
	$('#donmoi tbody').on('click', '.sanpham .glyphicon', function () {
		$(this).before('<input type="text" name="" placeholder="">');
		return false;
	}).click();
})();

// Xóa đơn hàng - Đơn xóa sẽ thêm vào trường Thùng rác
(function deleteOrdersNode () {
	$('#donmoi').on('click', '.functions .cancel', function () {
		$(this).parent().parent().hide('200', function() {
			$(this).remove();
			helper.incrementsOK();
		});;
		return false;
	});
})();

// Ajax xử lý chung
function Ajax (datas) {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

	if (flagAjax == false) return false;

	flagAjax = false;

	$.ajax(datas)
	 .always(function() {
		flagAjax = true;
	});
}

// Hiển thị mặc định đơn mới
(function viewDefaultAjax () {
	var datas = {
		url     : 'orders/view',
		type    : 'get',
		datas   : '',
		success : function (result) {
			if (result != null) {
				var result = $.parseJSON(result);
				$.each(result.orders, function(index, order) {
					var name         = order.name         ? order.name         : '';
					var phone        = order.phone        ? order.phone        : '';
					var address      = order.address      ? order.address      : '';
					var _id_customer = order.id           ? order.id           : '';
					$('#donmoi tbody').append(patternHTML(name, phone, address, _id_customer));
				});
				helper.scrollTop();
				helper.incrementsOK();
			}
		}
	}
	$('#donmoi tbody').html('');
	Ajax(datas);
})();

// Thêm đơn hàng vào cơ sở dữ liệu
(function addOrdersAjax () {
	$('#donmoi tbody').on('keyup', 'input', function () {
		var $this = this;
		var datas = {
			url     : 'orders/add',
			type    : 'post',
			dataType: 'json',
			data    : {
				_id_customer : $(this).parent().parent().find('input[name=_id_customer]').val(),
				colum        : $(this).attr('name'),
				value        : $(this).val(),
			},
			success : function (result) {
				if (result._id_customer) {
					$($this).parent().parent().find('input[name=_id_customer]').val(result._id_customer);
				}
			},
		};

		if (timeout) clearTimeout(timeout);
		timeout = setTimeout(function() {
			Ajax(datas);
		}, 2000);
		return false;
	});

})();

// Auto Complete
(function autoCompleteAjax () {
	$('#donmoi tbody').on('keyup', 'input[name=phone]', function (){
		var $this = this;
		var datas = {
			url     : 'orders/autocomplete/phone',
			type    : 'post',
			data    : {
				phoneInput : $($this).val()
			},
			success : function (result) {
				var result = $.parseJSON(result);
				var items = [];
				$.each(result, function(index, result) {
					if (result.name){
						items[index] = result.phone + '(' + result.name + ')';
					}
				});
				$($this).autocomplete({
					source: items
				});
			},//error: function (xhr, status, errorThrown) {
		        //The message added to Response object in Controller can be retrieved as following.
		    //    $('html').html(xhr.responseText);
		    //}
		};
		Ajax(datas);
	});
})();

// Nhớ tab khi load lại trang
(function saveTabReload () {
	if(typeof(Storage) !== 'undefined'){
		var tabElement        = $('.tab-bills .nav-tabs li');
		var tabContentElement = $('.list-bills .tab-content .tab-pane');

		tabElement.removeClass('active');
		tabContentElement.removeClass('active');

		tabElement.click(function () {
			sessionStorage.tabNow = $(this).find('a').attr('href');
		});

		var tabNow = sessionStorage.tabNow ? sessionStorage.tabNow : '#donmoi';

		tabElement.find('a[href="' + tabNow + '"]').parent().addClass('active');
		tabContentElement.filter(tabNow).addClass('active');
	}
})();


})(jQuery);