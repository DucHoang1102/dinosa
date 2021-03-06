(function ($) {
"use strict";

var flagAjax = true;
var timeout  = null;
var timeout1 = null;

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
		var re = /^(A|D)([0-9]*)([A-Z]?)(CT1|CT2|DT1|DT2|AK1|AK2|AK3|BL1)(\s*)\((S|M|L|XL|XXL)\)$/;
		var string = string.toUpperCase().trim();
		return re.test(string);
	},
	viewBackground: function($this='', show=true) {
		if (show == false){
			$('#donmoi .load-oldcustomer').hide();
			return false;
		}

		function setSize($this) {
			var width  = $($this).width();
			var height = $($this).height();
			var top    = $($this).position().top;
			var left   = $($this).position().left;

			$('#donmoi .load-oldcustomer').css({
				width  : width,
				height : height,
				top    : top,
				left   : left
			});
		}
		$(window).resize(function(){
			setSize($this);
		});

		setSize($this);

		$('#donmoi .load-oldcustomer').show();

		return false;
	},
	ConvertMoney: function(number) {
		if (isNaN(number)) return '';
		var result = "";
		var div    = 0;
		var number = number.toString().replace(',','').split("").reverse().join('');
        var count  = number.length;

        for (let i=0; i < count ; i++) {
            if (div == 3) {
                result = ',' + result;
                div = 0;
            }
            result = number[i] + result;

            div+=1;
        }
        return result;
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
			</td>
			<td class="diachi address"><input type="text" name="address" value="" maxlength="99" autocomplete="off"></td>
			<td class="sanpham"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td>
			<td class="tongtien moneys"><div class="label">0 <span class="glyphicon glyphicon-plus" aria-hidden="true"></div></td>
			<td class='xacnhan functions'>
				<div class="menu_funs">
					<a class="move-right" href="">
						<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Chuyển tiếp">
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

function patternProductSuccess(id="", name="", url_image="", status="0") {
	var name = name.toUpperCase();
	return `<div class="product-success bg-${status}" status="${status}" id="${id}" url-image="${url_image}">${name}<span class="glyphicon glyphicon-remove"></span></div>`;
}

function patternAutocomplete(phone="", name="") {
	return `<span class="atc-item">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				<span class="atc-phone">${phone}</span>
				<span class="atc-name">(${name})</span>
			</span>`;
}

function patternPlusMoney(total_money, ship_money, phuphi_money) {
	var ship_money   = helper.ConvertMoney(ship_money);
	var phuphi_money = helper.ConvertMoney(phuphi_money);
	if (ship_money == 0)   ship_money = '';
	if (phuphi_money == 0) phuphi_money = '';
	return `<div class="plus-money"><span>Ship:</span><input type="text" name="ship" value="${ship_money}"/>
			<span>Phụ phí:</span><input type="text" name="phuphi" value="${phuphi_money}"/>
			<span class='total_money'>${total_money}</span>
			<button type="button" class="btn btn-primary ok">OK</button>
			<button type="button" class="btn btn-danger cancel">Cancel</button></div>`;
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

		// Xóa chữ: Dữ liệu trống
		if ( $('#donmoi .data-empty').html() ) {
			$('#donmoi .data-empty').remove();
		}

		// Kích hoạt title black background
		$('[data-toggle="tooltip"]').tooltip();
		
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

// Move right chuyển tab 
(function moveRight() {
	$('body').on('click', '.menu_funs .move-right', function(){
		var $this = this;
		var lenght = $(window).width() + 'px';
		$($this).parent().parent().parent()
				.css({
					transition: "all 0.3s",
					transform: `translateX(${lenght})`,
				});
	});
})();

// Move left chuyển tab 
(function moveLeft() {
	$('body').on('click', '.menu_funs .move-left', function(){
		var $this = this;
		var lenght = $(window).width() + 'px';
		$($this).parent().parent().parent() 
				.css({
					transition: "all 0.3s",
					transform: `translateX(-${lenght})`,
				});
	});
})();

// Delete xóa tab vào thùng rác 
(function moveDelete() {
	$('body').on('click', '.menu_funs .delete', function(){
		var $this = this;
		var height = $(window).height() + 10 + 'px';
		var this_order = $($this).parent().parent().parent();
		this_order.css({
				transition: "all 0.6s",
				transform: `translateY(-${height})`,
			});
	});
})();

// Xóa tất cả - Dọn dẹp thùng rác
(function deleteAll() {
	$('#thungrac .delete-all').click(function() {
		$('#thungrac .table-tbody').css({
			transition : 'all 0.6s',
			transform  : `scale(0.001,0.001)`,
		});

	});
})();

// Bấm ảnh sản phẩm view ảnh
(function viewImageProduct() {
	$('.table-tbody').on('mousedown', '.sanpham .product-success', function (event) {
		if (!($(event.target).attr('class') == "glyphicon glyphicon-remove")){

			// Tắt chức năng này tại chuột phải và chuột giữa
			if ( event.which == 3 || event.which == 2 ) return false;

			// Tắt chức năng này khi mousedown vào nút in một sp
			if ($(event.target).attr('class') == 'glyphicon glyphicon-print') return false;
			
			var url_image = $(this).attr('url-image') ? $(this).attr('url-image') : '';
			var status    = $(this).attr('status');
			var label     = "";
			if (status == 1) {
				label = "Sản phẩm đã tồn tại";
			}

			$(`<div class="img_product"><span class="label">${label}</span><img src="${url_image}" width="300"></div>`)
				.appendTo('body')
				.css({
					position : "absolute",
					overfolow: "hidden",
					top      : "50%",
					left     : "50%",
					transform: "translate(-50%, -50%)",
					border   : "3px solid #ba1010",
				})
				.children('.label')
				.css({
					position       : "absolute",
					color          : "#ffffff",
					width          : "100%",
					"border-radius": "0px",
					padding        : "30px 0px",
					"font-size"    : "2em",
					top            : "40%",
					background     : "rgba(229, 0, 0, 0.7)"
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
	$('#daxacnhan').on('click', '.sanpham .product-success .glyphicon-print', function(){
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
		window.open("orders/print/products/all/all", "windowChild", 'width=1100, height=600').print();
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
	$('[data-toggle="tooltip"]').tooltip();
})();

// Cảnh báo khi đơn đã trả hàng chuyển trở về chư trả hàng
(function daTraHang(){
	$('#chuyenthatbai .datrahang').click(function () {
		alert('CẢNH BÁO: LƯU Ý KHI CHUYỂN TRỞ VỀ CHƯA TRẢ HÀNG');
	});
})();

// Nút hiển thị chi tiết đơn hàng
(function () {
	var eye_node    = $('.table-tbody tbody span.eye-node');

	eye_node.hover(
				function(event){
					var id_order = $(this).parent().parent().find('input[name=_id_order]').val();
					var top    = event.pageY;
					var left   = event.pageX;
					$('.detail-'+id_order)
					  .css({
					  	'top'    : top-10,
					  	'left'   : left-10
					  })
					  .show(50);
				}
			)
			.click(function () {
				alert(123);
				return false;
			});

	$('.detail').hover(
		function(){
			$(this).show(150);
			return false;
		},
		function(){
			$(this).hide(150);
			return false;
		}
	);

})();

// Nút hiển thị trạng thái đơn hàng tại hãng vận chuyển
// Trả lời câu hỏi hàng đang ở đâu
(function orderWhere() {
	$('.d-o-where').click(function(event) {
		var id_post = $(this).parents(".detail").attr("id_post");
		if (id_post == "" || id_post == undefined) {
			alert("TRẠNG THÁI ĐƠN HÀNG HIỆN TẠI CHƯA CÓ!");
		}
		else {
			var link_vnpost = "http://www.vnpost.vn/vi-vn/dinh-vi/buu-pham?key=" + id_post;
			window.open(link_vnpost, "windowChild", 'width=1100, height=600')
		}
		return false;
	});
})();

// Tiền ship và phụ phi
(function plusMoney() {
	$('#donmoi').on('click', '.tongtien .glyphicon-plus', function(){
		$(this).hide();
		$(this).parents('tr').find('.sanpham .glyphicon-ok-circle').hide();

		var ship_money   = $(this).parents('.tongtien').find('#ship_money').text();
		var phuphi_money = $(this).parents('.tongtien').find('#phuphi_money').text();
		var total_money  = $(this).parents('.tongtien').find('.label').hide().text();
		var pattern      = patternPlusMoney(total_money, ship_money, phuphi_money);

		$(pattern).prependTo($(this).parent().parent())
				  .hide()
				  .show(100)
	});

	$('#donmoi .tongtien').on('keyup', 'input[name=ship], input[name=phuphi]', function() {
		var total_money    = parseInt($(this).parents('.tongtien').find('.label').text().replace(',',''));
		var ship_money     = parseInt($(this).parents('.tongtien').find('#ship_money').text());
		var phuphi_money   = parseInt($(this).parents('.tongtien').find('#phuphi_money').text());
		var products_money = total_money - (ship_money + phuphi_money);

		var i_ship_money   = parseInt($(this).parent().find('input[name=ship]').val().replace(',', ''));
		var i_phuphi_money = parseInt($(this).parent().find('input[name=phuphi]').val().replace(',', ''));

		// Hiển dị dạng tiền tệ trong ô nhập
		$(this).parent().find('input[name=ship]').val(helper.ConvertMoney(i_ship_money));
		$(this).parent().find('input[name=phuphi]').val(helper.ConvertMoney(i_phuphi_money));

		// Validate
		if (isNaN(i_ship_money))   i_ship_money   = 0;
		if (isNaN(i_phuphi_money)) i_phuphi_money = 0;

		// Cộng tổng tiền
		var i_total_money = products_money + (i_ship_money + i_phuphi_money);
		$(this).parent().find('.total_money').text(helper.ConvertMoney(i_total_money));
	});

	// Nút cancel
	$('#donmoi').on('click', '.tongtien .cancel', function() {
		$(this).parents('tr').find('.sanpham .glyphicon-ok-circle').show
		();
		$(this).parent().parent().find('.label')
								 .show(100)
								 .find('.glyphicon-plus')
								 .show(100);

		$(this).parent().hide(100, function() {
			$(this).remove();
		});
	});

	// Nút Ok cộng phụ phí, ship
	$('#donmoi').on('click', '.tongtien .ok', function() {
		var $this = $(this);
		var datas = {
			url     : 'orders/plus-money',
			type    : 'post',
			dataType: 'json',
			data    : {
				_id_order : $this.parents('tr').find('input[name=_id_order]').val(),
				_ship     : $this.parent().find('input[name=ship]').val().replace(',', ''),
				_phuphi   : $this.parent().find('input[name=phuphi]').val().replace(',', ''),
			},
			success : function (result) {
				if (result.total_money) {
					$this.parents('.tongtien')
						 .find('.label')
						 .html(result.total_money + ' <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>');
					
					$this.parents('.tongtien')
						 .find('#ship_money')
						 .text(result.ship_money);
					
					$this.parents('.tongtien')
						 .find('#phuphi_money')
						 .text(result.phuphi_money);
						 
					$this.parent().find('.cancel').click();
				}
				else {
					$this.parent().find('.cancel').click();
				}
			},
			error: function (xhr, status, errorThrown) {
		        //The message added to Response object in Controller can be retrieved as following.
		       $('html').html(xhr.responseText);
		    }
		};

		// Validate
		if (isNaN(datas.data._ship) || isNaN(datas.data._phuphi)) {
			alert("BẠN HÃY NHẬP SỐ!");

			if (isNaN(datas.data._ship)) {
				// Làm thế này để focus vào cuối kí tự
				var val = datas.data._ship;
				$($this).parent().find('input[name=ship]').val(val).focus().val(val);
			}
			else if (isNaN(datas.data._phuphi)) {
				var val = datas.data._phuphi;
				$($this).parent().find('input[name=phuphi]').val('').focus().val(val);
			}

			return false;
		}
		// Dữ liệu trống
		if (datas.data._ship === "" && datas.data._phuphi === "") {
			$($this).parent().find('input[name=ship]').focus();
			return false;
		}
		// Số âm
		if (datas.data._ship < 0 || datas.data._phuphi < 0) {
			alert("Vui lòng không nhập số âm!");
			return false;
		}

		Ajax(datas);
	});
})();

/*
 *
 * AJAX
 * 
 *
 * Thêm, sửa đơn hàng | Thêm, sửa, xóa sản phẩm | Autocomplete | Thay đổi trạng thái sản phẩm
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
	$('#donmoi tbody').on('keyup', 'input[name=name],input[name=phone],input[name=address]', function () {
		var $this = this;
		var datas = {
			url     : 'orders/add',
			type    : 'post',
			dataType: 'json',
			data    : {
				_id_order    : $($this).parent().parent().find('input[name=_id_order]').val(),
				_id_customer : $($this).parent().parent().find('input[name=_id_customer]').val(),
				name         : $($this).parent().parent().find('input[name=name]').val(),
				phone        : $($this).parent().parent().find('input[name=phone]').val(),
				address      : $($this).parent().parent().find('input[name=address]').val(),
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
					var name    = $($this).parent().parent().find('input[name=name]').val(c.name);
					var phone   = $($this).parent().parent().find('input[name=phone]').val(c.phone);
					var address = $($this).parent().parent().find('input[name=address]').val(c.address);
					helper.viewBackground('',false);
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

		if (timeout) {
			clearTimeout(timeout);;
		}

		timeout = setTimeout(function() {
			Ajax(datas);
		}, 1100);

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

					if (result.inventory) {
						alert('THÔNG BÁO: SẢN PHẨM ĐÃ CÓ. KHÔNG IN MỚI');
						var pattern = patternProductSuccess(result.id_product, datas.data.product, result.url_image, 1);
						$('body').find('div[id='+result.inventory+']').removeClass('bg-1').addClass('bg-0');
					}
					else var pattern = patternProductSuccess(result.id_product, datas.data.product, result.url_image, 0); 
					
					$('.sanpham').find($this)
								 .after(pattern)
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

		// Chưa có orders thì chưa cho phép gửi ajax sản phẩm
		if (! $($this).parent().parent().find('input[name=_id_order]').val()) return false;

		if (timeout) clearTimeout(timeout);

		timeout = setTimeout(function() {
			Ajax(datas);
		}, 50);

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
					$($this).parent().fadeOut('100', function() {
						$(this).remove();
					});
				}
			},
			error: function (xhr, status, errorThrown) {
		        //The message added to Response object in Controller can be retrieved as following.
		        $('html').html(xhr.responseText);
		    }
		};

		Ajax(datas);

		return false;
	});
})();

// Auto Complete: 1 mình một ajax riêng vì tiến trình này phải xử lý song song
(function autoCompleteAjax () {
	$('#donmoi tbody').on('keyup', 'input[name=phone]', function (){
		var $this = this;

		// Dưới 6 chữ số không gửi ajax autocomplete
		if ($($this).val().length < 6) return false;

		if (timeout1) clearTimeout(timeout1);
		timeout1 = setTimeout(function(){
			$.ajax({
				url      : 'orders/autocomplete/phone',
				type     : 'get',
				dataType : 'json',
				data     : {
					phoneInput : $($this).val()
				},
				success  : function (result) {
					if (result) {
						$('#donmoi .autocomplete').remove();
						
						var html = '';

						$.each(result, function(index, customer) {
							html = html + patternAutocomplete(customer.phone, customer.name);
						});

						html = `<div class="autocomplete">${html}</div>`;

						$(html).appendTo($($this).parent());

						$('#donmoi').on('click', '.atc-item', function () {

							var phone_number = $(this).find('.atc-phone').text();

							$(this).parent().parent().parent()
								   .find('input[name=phone]')
								   .val(phone_number).keyup();

							helper.viewBackground( $(this).parent().parent().parent() );
						});

						$(window).click(function(){
							$('#donmoi .autocomplete').fadeOut(100, function() {
								$(this).remove();
							});
							return false;
						});

					}
				},
				error: function (xhr, status, errorThrown) {
			        //The message added to Response object in Controller can be retrieved as following.
			        $('html').html(xhr.responseText);
			    }
			});
		}, 1);

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

// Click chuột phải vào sản phẩm tại inxong, 
// thay đổi trạng thái sản phẩm.
(function changeStatusProduct() {
	$('#donmoi, #daxacnhan, #dainxong, #chuyenthatbai').on('contextmenu', '.product-success', function(){
		var $this = this;
		var datas = {
			url      : 'orders/change-status',
			type     : 'get',
			data     : {
				_status     : $($this).attr('status'),
				_id_order   : $($this).parent().parent().find('input[name=_id_order]').val(),
				_id_product : $($this).attr('id'),
			},
			dataType : 'json',
			success  : function(result) {
				if (result.status) {
					$($this).removeClass('bg-' + $($this).attr('status'))
							.attr('status', result.status)
							.addClass('bg-' + result.status);
				}
			}
		};

		Ajax(datas)

		return false;
	});
})();


})(jQuery);