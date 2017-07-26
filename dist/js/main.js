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

function patternHTML (name="", phone="", address="", total_money ="0", products=[], _id_order="", _id_customer="") {
		var productsHtml = "";
		$.each(products, function(index, product) {
			productsHtml = productsHtml + patternProduct(product["id"], product["name"]);
		});

		return `<tr>
			<input type="hidden" name="_id_order" value="${_id_order}"/>
			<input type="hidden" name="_id_customer" value="${_id_customer}"/>
			<td class="stt"></td>
			<td class="hoten"><input type="text" name="name" value="${name}" maxlength="35" autocomplete="off"></td>
			<td class="phone"><input type="text" name="phone" value="${phone}" maxlength="11" autocomplete="off"></td>
			<td class="diachi address"><input type="text" name="address" value="${address}" maxlength="99" autocomplete="off"></td>
			<td class="sanpham">${productsHtml}<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td>
			<td class="tongtien moneys"><div class="label">${total_money} <span class="glyphicon glyphicon-plus" aria-hidden="true"></div></td>
			<td class='xacnhan functions'>
				<button type="button" class="btn btn-success btn-sm disabled"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Xác nhận</button>
				<button type="button" class="btn btn-danger btn-sm cancel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Xóa</button>
			</td>
		</tr>`;
}

function patternProduct (id="", name="") {
	return `<input type="text" id="${id}" name="product" value="${name}" placeholder="" autocomplete="off">`;
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
	$('#donmoi tbody').on('click', '.sanpham .glyphicon', function () {
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
/*
// Hiển thị mặc định đơn mới
(function viewDefaultAjax () {
	var datas = {
		url      : 'orders/view',
		type     : 'get',
		datas    : '',
		dataType : 'json',
		success  : function (orders) {
			if (orders != null) {
				// Cái này trả về hết dữ liệu dưới đây chỉ có một số.
				$.each(orders, function(index, order) {
					var _id_order    = order.id           ? order.id           : '';
					var _id_customer = order.id_customers ? order.id_customers : '';
					var name         = order.name         ? order.name         : '';
					var phone        = order.phone        ? order.phone        : '';
					var address      = order.address      ? order.address      : '';
					var total_money  = order.total_money  ? order.total_money  : '0';
					var products     = order.products.length > 0 ? order.products : [{'id':'', 'name':'', 'price':'0'}];

					$('#donmoi tbody').append(patternHTML(name, phone, address, total_money, products, _id_order, _id_customer));
				});
				helper.scrollTop();
				helper.incrementsOK();
			}
		}
	}
	$('#donmoi tbody').html('');
	Ajax(datas);
})();*/

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
				product      : $($this).val(),
			},
			success : function (result) {
				if (result.hasOwnProperty('id_product')) {
					$($this).attr('id', result.id_product);
					$($this).parent().parent().find('.money .label').text(result.total_money);
					return result;
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