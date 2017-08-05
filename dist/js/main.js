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
		var re = /^(A|D)([0-9]*)([A-Z]?)(CT1|CT2|DT1|DT2|AK1|AK2|AK3)(\s*)\((S|M|L|XL|XXL)\)$/;
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
			<td class="phone">
				<input type="text" name="phone" value="" maxlength="11" autocomplete="off">
				<div class="autocomplete"></div>
			</td>
			<td class="diachi address"><input type="text" name="address" value="" maxlength="99" autocomplete="off"></td>
			<td class="sanpham"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td>
			<td class="tongtien moneys"><div class="label">0 <span class="glyphicon glyphicon-plus" aria-hidden="true"></div></td>
			<td class='xacnhan functions'>
				<div class="menu_funs">
					<a class="move-right" href="">
						<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Xác nhận">
							<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
						</button>
					</a>
					<a class="delete" href="">
						<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xóa">
							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</button>
					</a>
				</div>
			</td>
		</tr>`;
}

function patternProduct () {
	return '<input type="text" id="" name="product" value="" placeholder="" autocomplete="off">';
}

function patternProductSuccess(id="", name="", url_image="") {
	var name = name.toUpperCase();
	return `<div class="product_success" id="${id}" url-image="${url_image}">${name}<span class="glyphicon glyphicon-remove"></span></div>`;
}

function patternAutocomplete(phone="", name="") {
	return `<span class="atc-item">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				<span class="atc-phone">${phone}</span>
				<span class="atc-name">(${name})</span>
			</span>`;
}

/*
 *
 * CÁC NÚT CHỨC NĂNG FRONT END
 *
 *
 **/

// Thêm đơn hàng
(function createOrdersNode () {
	$('#donmoi .add-order').click(function () {
		$(patternHTML()).appendTo('#donmoi tbody')
						.find('.sanpham .glyphicon').click().parent().parent()
						.find('input[name=name]').focus()
					    .hide()
					    .fadeIn(400);
		helper.incrementsOK();
		helper.scrollTop();
		return false;

	});
})();

// Tạo thêm sản phẩm
(function createProductsNode () {
	$('#donmoi tbody').on('click', '.sanpham .glyphicon-ok-circle', function () {
		$(patternProduct()).insertBefore(this).focus();
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

// Move right chuyển tab 
(function moveRight() {
	$('body').on('click', '.menu_funs .move-right', function(){
		var $this = this;
		var lenght = $(window).width() + 50 + 'px';
		$($this).parent().parent().parent()
				.css({
					transition: "all 0.5s",
					transform: `translateX(${lenght})`,
				});
		setTimeout(function(){
			$($this).parent().parent().parent().remove()
		},550);

	});
})();

// Move left chuyển tab 
(function moveLeft() {
	$('body').on('click', '.menu_funs .move-left', function(){
		var $this = this;
		var lenght = $(window).width() + 50 + 'px';
		$($this).parent().parent().parent() 
				.css({
					transition: "all 0.5s",
					transform: `translateX(-${lenght})`,
				});
		setTimeout(function(){
			$($this).parent().parent().parent().remove()
		},550);

	});
})();

// Delete xóa tab vào thùng rác 
(function moveDelete() {
	$('body').on('click', '.menu_funs .delete', function(){
		var $this = this;
		var height = $(window).height() + 10 + 'px';
		var this_order = $($this).parent().parent().parent();
		this_order
			.css({
				transition: "all 0.6s",
				transform: `translateY(-${height})`,
			});
		setTimeout(function(){
			this_order.remove()
		},650);
	});
})();

// Bấm ảnh sản phẩm view ảnh
(function viewImageProduct() {
	$('.table-tbody').on('mousedown', '.sanpham .product_success', function (event) {
		if (!($(event.target).attr('class') == "glyphicon glyphicon-remove")){

			var url_image = $(this).attr('url-image') ? $(this).attr('url-image') : '';

			$(`<div class="img_product"><img src="${url_image}" width="300"></div>`)
				.appendTo('body')
				.css({
					position : "absolute",
					top      : "50%",
					left     : "50%",
					transform: "translate(-50%, -50%)",
					border   : "3px solid #ba1010",
				});

			return false;
		}
	});

	$('html').on('mouseup', 'body', function(){
		$('.img_product').remove();
		return false;
	});
})();

// Bấm nút in một sản phẩm
(function printProduct() {
	$('.table-tbody').on('mousedown', '.sanpham .product_success .glyphicon-print', function(){
		var id_order   = $(this).parent().parent().parent().find('input[name=_id_order]').val();
		var id_product = $(this).parent().attr('id');

		var url_image = 'orders/print/products/' + id_order + '/' + id_product;
		window.open(url_image, "windowChild", 'width=1100, height=600').print();

		return false;
	});
})();

// Bấm nút in nhiều sản phẩm
(function printProducts() {
	$('.funs-xacnhan .print-product').click(function(){
		window.open("orders/print/products/all/all", "windowChild", 'width=1100, height=600').print()
		return false;
	});
})();

// Nút in nhãn đơn hàng
(function printOrders() {
	$('.print-orders').click(function () {
		window.open('orders/print/orders', "windowChild", 'width=1100, height=600').print();
		return false;
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

// Title các nút chức năng
(function () {
  $('[data-toggle="tooltip"]').tooltip()
})();


/*
 *
 * AJAX
 * 
 *
 * Thêm, sửa đơn hàng | Thêm, sửa, xóa sản phẩm | Autocomplete
 *
 **/

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

					$($this).parent().parent().find('.menu_funs .move-right').attr('href', 'orders/move/status=2+id=' + result._id_order + '+no_update=false');
					$($this).parent().parent().find('.menu_funs .delete').attr('href', 'orders/move/status=9+id=' + result._id_order + '+no_update=false');
				}
				if (result.customer_old) {
					var c = result.customer_old;
					$($this).parent().parent().find('input[name=name]').val(c.name);
					$($this).parent().parent().find('input[name=phone]').val(c.phone);
					$($this).parent().parent().find('input[name=address]').val(c.address);
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
		}, 500);

		return false;
	});

})();

// Thêm sản phẩm vào đơn hàng
(function addProductAjax () {
	// Validate sản phẩm trước khi gửi Ajax, Vứt ra hàm khác
	$('#donmoi tbody').on('keyup', 'input[name=product]', function () {
		var $this = this;
		var datas = {
			url     : 'orders/add-product',
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

					$($this).parent().parent().find('.moneys .label')
							.html(result.total_money + ' <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>');

					$('.sanpham').find($this)
								 .after(patternProductSuccess(result.id_product, datas.data.product, result.url_image.src_f_a3))
								 .remove(); // Remove đã xóa $(this) nên phải ghi tổng tiền ở phía trên
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
			url     : 'orders/delete-product',
			type    : 'post',
			dataType: 'json',
			data    : {
				_id_order   : $($this).parent().parent().parent().find('input[name=_id_order]').val(),
				_id_product : $($this).parent().attr('id'),
			},
			success : function (result) {
				if (result.hasOwnProperty('total_money')) {
					$($this).parent().parent().parent()
							.find('.moneys .label')
							.html(result.total_money + ' <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>');
					$($this).parent().remove();
				}
			},
			error: function (xhr, status, errorThrown) {
		        //The message added to Response object in Controller can be retrieved as following.
		        $('html').html(xhr.responseText);
		    }
		};

		$($this).parent().hide('300', function() {
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
			dataType: 'json',
			data    : {
				phoneInput : $($this).val()
			},
			success : function (result) {
				if (result) {

					var html = '';

					$.each(result, function(index, customer) {
						html = html + patternAutocomplete(customer.phone, customer.name);
					});

					function atc(html) {
						$($this).parent()
						    .parent()
						    .find('.autocomplete')
						    .html(html);
					}; atc(html);

					$('#donmoi').on('click', '.atc-item', function () {

						var phone_number = $(this).find('.atc-phone').text();

						$(this).parent().parent().parent()
							   .find('input[name=phone]')
							   .val(phone_number).focus(function(){$(this).keyup()}).focus();

						$(this).parent().fadeOut(300, function(){atc('');});

						return false;
					});

					$(document).click(function (event) {	
						atc('');
						return false;
					});
				} 
			},
		};
		
		Ajax(datas);
		return false;
	});
})();

// Nút gửi Email VnPost
(function sendMail() {
	$('.funs-dainxong .send-mail').click(function () {
		var $this = this;

		// Button
		$($this).find('button')
				.css({
					background: "#000000",
				})
				.html('<img src="upload/loads/load_1.gif" width="20px"> Đang gửi...');

		var datas = {
			url      : 'orders/send-mail',
			type     : 'get',
			data     : {},
			dataType : 'json',
			success  : function(result) {
				if (result.hasOwnProperty('status')) {
					if (result.status == 1) {
						$($this).find('button')
								.css({
									background: "#009fcc",
								})
								.html('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Gửi thành công')
					}
					else {
						$($this).find('button')
								.css({
									background: "#C9302C",
								})
								.html('<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Gửi thất bại');
					}
				}
				else alert('Lỗi send Mail Ajax');
			}
		};

		Ajax(datas);

		return false;
	});
})();

})(jQuery);