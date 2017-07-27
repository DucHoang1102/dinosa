(function ($) {
"use strict";

var flagAjax = true;
var timeout  = null;
var errors = {};

var helper = { 
	getToday  : function () {
		var date = new Date();
		return (date.getDate()) + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
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
	validateProduct: function (string) {
		var re = /^(A|D)([0-9]*)(CT1|CT2|DT1|DT2|AK1|AK2|AK3)(\s*)\((S|M|L|XL|XXL)\)$/;
		var string = string.toUpperCase().trim();
		return re.test(string);
	},
};

function patternHTML () {
		return `<tr>
			<input type="hidden" name="_id_order" value=""/>
			<input type="hidden" name="_id_customer" value=""/>
			<td class="stt"></td>
			<td class="hoten"><input type="text" name="name" value="" maxlength="35" autocomplete="off"></td>
			<td class="phone"><input type="text" name="phone" value="" maxlength="11" autocomplete="off"></td>
			<td class="diachi address"><input type="text" name="address" value="" maxlength="99" autocomplete="off"></td>
			<td class="sanpham"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td>
			<td class="tongtien moneys"><div class="label">0 <span class="glyphicon glyphicon-plus" aria-hidden="true"></div></td>
			<td class='xacnhan functions'>
				<button type="button" class="btn btn-success btn-sm disabled"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Xác nhận</button>
				<button type="button" class="btn btn-danger btn-sm cancel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Xóa</button>
				<span class="glyphicon glyphicon-info-sign"></span>
			</td>
		</tr>`;
}

function patternProduct () {
	return '<input type="text" id="" name="product" value="" placeholder="" autocomplete="off">';
}

function patternProductSuccess(id="", name="") {
	var name = name.toUpperCase();
	return `<div class="product_success" id="${id}">${name}<span class="glyphicon glyphicon-remove"></span></div>`;
}

// Thêm đơn hàng
(function createOrdersNode () {
	$('#donmoi .add-order').click(function () {
		$(patternHTML()).appendTo('#donmoi tbody')
						.find('.sanpham .glyphicon').click().parent().parent()
					    .hide()
					    .show(400, function () {
					        $(this).find('input[name=name]')
					    	    .focus();
					    });
		helper.incrementsOK();
		helper.scrollTop();
		return false;

	});
})();

// Tạo thêm sản phẩm
(function createProductsNode () {
	$('#donmoi tbody').on('click', '.sanpham .glyphicon-ok-circle', function () {
		$(this).before(patternProduct());
		return false;
	});
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

// Thêm đơn hàng vào cơ sở dữ liệu
(function addOrdersAjax () {
	$('#donmoi tbody').on('keyup', 'input', function () {
		var $this = this;
		var datas = {
			url     : 'orders/add',
			type    : 'post',
			dataType: 'json',
			data    : {
				_id_order    : $($this).parent().parent().find('input[name=_id_order]').val(),
				_id_customer : $($this).parent().parent().find('input[name=_id_customer]').val(),
				colum        : $($this).attr('name'),
				value        : $($this).val(),
			},
			success : function (result) {
				if (result._id_order && result._id_customer) {
					$($this).parent().parent().find('input[name=_id_order]').val(result._id_order);
					$($this).parent().parent().find('input[name=_id_customer]').val(result._id_customer);
				}
			},
			error: function (xhr, status, errorThrown) {
		        //The message added to Response object in Controller can be retrieved as following.
		        $('html').html(xhr.responseText);
		    }
		};

		// Có function xử lý product riêng, không xử lý tại đây
		if ($($this).attr('name') == 'product')
		{
			return false;
		}

		// Validate dấu cách
		if ($($this).val().trim() == "") return false;

		if (timeout) clearTimeout(timeout);

		timeout = setTimeout(function() {
			Ajax(datas);
		}, 2000);

		return false;
	});

})();

// Thêm sản phẩm vào đơn hàng
(function addProductAjax () {
	// Validate sản phẩm trước khi gửi Ajax, Vứt ra hàm khác
	$('#donmoi tbody').on('keyup', 'input[name=product]', function () {
		var $this = this;
		var datas = {
			url     : 'orders/addproduct',
			type    : 'post',
			dataType: 'json',
			data    : {
				_id_order    : $($this).parent().parent().find('input[name=_id_order]').val(),
				_id_customer : $($this).parent().parent().find('input[name=_id_customer]').val(),
				_id_product  : $($this).attr('id'),
				product      : $($this).val(),
			},
			success : function (result) {
				if (result.hasOwnProperty('id_product') && result.hasOwnProperty('total_money')) {
					$('.sanpham').find($this)
								 .after(patternProductSuccess(result.id_product, datas.data.product))
								 .remove();
					$('#donmoi .table-tbody .moneys .label').html(result.total_money + ' <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>');
				}
			},
			error: function (xhr, status, errorThrown) {
		        //The message added to Response object in Controller can be retrieved as following.
		        $('html').html(xhr.responseText);
		    }
		};

		var check = helper.validateProduct($($this).val())
		if (check == true) {
			$($this).css({
				"border-bottom": '3px solid #4fdd4f',
			});
		}
		else {
			$($this).css({
				"border-bottom": '3px solid red',
			});
			return false;
		}

		if (! $($this).parent().parent().find('input[name=_id_order]').val()) return false;

		if (timeout) clearTimeout(timeout);

		timeout = setTimeout(function() {
			Ajax(datas);
		}, 500);

		return false;
	});
})(); 

// Xóa sản phẩm khỏi đơn hàng
(function DeleteProductAjax () {
	$('#donmoi .table-tbody tbody').on('click', '.sanpham .glyphicon-remove', function () {
		var $this = this;

		var datas = {
			url     : 'orders/deleteproduct',
			type    : 'post',
			dataType: 'json',
			data    : {
				_id_order   : $($this).parent().parent().parent().find('input[name=_id_order]').val(),
				_id_product : $($this).parent().attr('id'),
			},
			success : function (result) {
				if (result.hasOwnProperty('total_money')) {
					$('#donmoi .table-tbody .moneys .label').html(result.total_money + ' <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>');
				}
			},
			error: function (xhr, status, errorThrown) {
		        //The message added to Response object in Controller can be retrieved as following.
		        $('html').html(xhr.responseText);
		    }
		};

		$($this).parent().hide('300', function() {
			$(this).remove();
			Ajax(datas);
		});

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