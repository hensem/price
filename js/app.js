// Namespace to reduce global scope pollution
var App = {
	tabs: ["price_tab", "add_item_tab", "add_shop_tab", "add_unit_tab", "contact_tab"],
	navs: ["price_nav", "add_item_nav", "add_shop_nav", "add_unit_nav", "contact_nav"],
	items: [],
	units: [],
	shops: [],
	global_shops: {},
	global_item_detail: [],
	letterNumber: /^[0-9a-zA-Z.,':-\s\&()\+%]+$/,
	valid_url: /^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i
};

// Legacy shortcuts pointing to App namespace
var items = App.items;
var units = App.units;
var shops = App.shops;
var global_shops = App.global_shops;
var global_item_detail = App.global_item_detail;
var tabs = App.tabs;
var navs = App.navs;
var letterNumber = App.letterNumber;
var valid_url = App.valid_url;

function isValidPrice(val) {
  const n = parseFloat(val);
  return !isNaN(n) && n > 0;
}

function isValidText(val) {
  return letterNumber.test(val);
}

function renderTableHeader(itemId, itemName, unit, sort, dir, variant) {
    const shopDir = sort === "shop" ? (dir === "asc" ? "desc" : "asc") : "asc";
    const variantDir = sort === "variant" ? (dir === "asc" ? "desc" : "asc") : "asc";
    const priceDir = sort === "price_per_unit" ? (dir === "asc" ? "desc" : "asc") : "asc";

    return `
        <table border="1">
            <tr>
                <th>
                    <a href='javascript:void(0)' data-item-id='${itemId}' data-sort='shop' data-dir='${shopDir}' data-variant='${variant}' class='sort-link'>${itemName}</a>
                </th>
                <th>
                    <a href='javascript:void(0)' data-item-id='${itemId}' data-sort='variant' data-dir='${variantDir}' data-variant='${variant}' class='sort-link'>Variant</a>
                </th>
                <th>Price</th>
                <th>
                    <a href='javascript:void(0)' data-item-id='${itemId}' data-sort='price_per_unit' data-dir='${priceDir}' data-variant='${variant}' class='sort-link'>Price per ${unit}</a>
                </th>
                <th>Date</th>
                <th></th>
            </tr>
    `;
}


function renderItemRow(item, index, sort, dir, variant) {
    const now = new Date();
    const then = new Date(item.last_update);

	const months = 3;
    const monthsAgo = new Date(now);
    monthsAgo.setMonth(monthsAgo.getMonth() - months);

    const isOlderThanMonthsAgo = then < monthsAgo;

    let shop = item.shop;
    if (item.url !== "") {
        shop = `<a href="${item.url}" target="_blank">${shop}</a>`;
    }

    const price = isOlderThanMonthsAgo
        ? `<s><span style='color:grey;'>${Number(item.price).toFixed(2)}</span></s>`
        : Number(item.price).toFixed(2);

    const pricePerUnit = isOlderThanMonthsAgo
        ? `<s><span style='color:grey;'>${Number(item.price_per_unit).toFixed(2)}</span></s>`
        : Number(item.price_per_unit).toFixed(2);

    const lastUpdate = isOlderThanMonthsAgo
        ? `<span style='color:grey;'>${item.last_update}</span>`
        : item.last_update;

    return `
        <tr>
            <td>${shop}</td>
            <td>${item.variant}</td>
            <td>${price}</td>
            <td>${pricePerUnit}</td>
            <td>${lastUpdate}</td>
            <td>
                <input type="button" value="Modify" data-index="${index}" data-sort="${sort}" data-dir="${dir}" data-variant="${variant}" class="modify-price-btn" />
            </td>
        </tr>
    `;
}


function renderTableFooter(itemId) {
    return `
        </table>
        <br /><br />
        <input type="button" value="Add Shop" data-item-id="${itemId}" class="add-shop-btn" />
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" value="Add Variant" data-item-id="${itemId}" class="add-variant-btn" />
    `;
}

App.ajax = function (options) {
    $("#spinner").show();

    return $.ajax(options)
        .fail(function (jqXHR, textStatus, errorThrown) {
            App.showError(textStatus + ": " + errorThrown);
        })
        .always(function () {
            $("#spinner").hide();
        });
};

App.modal = function (title, msg) {
    $('#alertModal').modal({ backdrop: 'static', keyboard: false });
    $("#alertModalTitle").text(title);
    $("#alertModalText").text(msg);
};

App.showError = function (msg) {
    App.modal('Error', msg);
};



function loadInitialData() {
	App.ajax({
		url: "api.php?url=/initial_data",
		dataType: "json",
		success: function(data) {
			if (data.success) {
				// Populate items
				items = data.items;
				var select = document.getElementById("select-item");
				for (var i = 0; i < items.length; i++) {
					var option = new Option(items[i].item_variant, items[i].id);
					select.add(option);
				}

				// Populate units
				units = data.units;
				var selectUnit = document.getElementById("add_item_unit");
				for (var i = 0; i < units.length; i++) {
					var option = new Option(units[i].name, units[i].id);
					selectUnit.add(option);
				}

				// Populate shops
				shops = data.shops;
				var select1 = document.getElementById("itemAddShopModalShop");
				var select2 = document.getElementById("add_item_shop");
				for (var i = 0; i < shops.length; i++) {
					var option1 = new Option(shops[i].name, shops[i].id);
					select1.add(option1);
					var option2 = new Option(shops[i].name, shops[i].id);
					select2.add(option2);
					global_shops[shops[i].id] = shops[i];
				}

				$('.selectpicker').selectpicker('refresh');
			}
		}
	});
}

function hide(tab) {
	for (var j = 0; j < tabs.length; j++) {
		if (tabs[j] != tab) {
			$('#' + tabs[j]).hide();
			$('#' + navs[j]).removeClass("nav-link active");
			$('#' + navs[j]).addClass("nav-link");
		} else {
			$('#' + tabs[j]).show();
			$('#' + navs[j]).removeClass("nav-link");
			$('#' + navs[j]).addClass("nav-link active");
		}
	}
	
	if (tab == "add_item_tab") {
		$("#add_item_name_error_tr").hide();
		$("#add_item_variant_error_tr").hide();
		$("#add_item_total_unit_error_tr").hide();
		$("#add_item_url_error_tr").hide();
		$("#add_item_shop_error_tr").hide();
		$("#add_item_price_error_tr").hide();
	}
	
	if (tab == "add_shop_tab") {
		$("#add_shop_name_error_tr").hide();
		$("#add_shop_url_tr").hide();
		$("#add_shop_url_error_tr").hide();
		
		$("#add_shop_name").val("");
		$("#add_shop_is_online").val("1");
		$("#add_shop_url").val("");
	}
	
	if (tab == "add_unit_tab") {
		$("#add_unit_name_error_tr").hide();
		
		$("#add_unit_name").val("");
	}

	if (tab == "contact_tab") {
		$("#contact_subject_error_tr").hide();
		$("#contact_message_error_tr").hide();
	}
}

function item_select_item(value, sort, dir, variant) {
	if (value == "0") {
		$("#item_detail_content").html("");
		return;
	}

	App.ajax({
		url: "api.php?url=/item&item_id=" + value + "&sort=" + sort + "&dir=" + dir + "&variant=" + variant,
		dataType: "json",
		success: function(data, textStatus, jqXHR ) {
			if (!data.success) {
				App.modal('Error', data.error);
			} else {
				global_item_detail = data.items;
				const itemId = data.items[0].item_id;
				const itemName = data.items[0].item;
				const unit = data.items[0].unit;
				let html = renderTableHeader(itemId, itemName, unit, sort, dir, variant);
				html += data.items.map((item, index) => renderItemRow(item, index, sort, dir, variant)).join('');
				html += renderTableFooter(itemId);
				$("#item_detail_content").html(html);
				$("#item_detail").show();
			}
		}
	});
}

function item_modify_price(i, sort, dir, variant) {
	$('#modifyPriceModal').modal({
		backdrop: 'static',
		keyboard: false
	});
	
	$('#modifyPriceModalPriceErrorTr').hide();
	$('#modifyPriceModalURLErrorTr').hide();
	
	$('#modifyPriceModalItem').html(global_item_detail[0].item);
	$('#modifyPriceModalVariant').html(global_item_detail[i].variant);
	$('#modifyPriceModalShop').html(global_item_detail[i].shop);
	$('#modifyPriceModalPrice').val(global_item_detail[i].price);
	$('#modifyPriceModalURL').val(global_item_detail[i].url);
	$('#modifyPriceModalID').val(global_item_detail[i].item_shop_id);
	$('#modifyPriceModalURLRequired').val(global_item_detail[i].url_required);
	
	if (global_item_detail[i].url_required == "0") {
		$('#modifyPriceModalPriceNoteTr').hide();
		$("#modifyPriceModalTitle").html("Modify Price");
		$('#modifyPriceModalURLtr').hide();
	} else {
		$('#modifyPriceModalPriceNoteTr').show();
		$("#modifyPriceModalTitle").html("Modify Price / URL");
		$('#modifyPriceModalURLtr').show();
	}
}

function item_save_modify_price() {
	$('#modifyPriceModalPriceErrorTr').hide();
	$('#modifyPriceModalURLErrorTr').hide();
	
	var price = $("#modifyPriceModalPrice").val();

	if (price == "") {
		$("#modifyPriceModalPriceErrorTr").show();
		$("#modifyPriceModalPriceError").html("Price is required.");
		$("#modifyPriceModalPrice").focus();
		$("#modifyPriceModalPrice").select();
		return;
	}

	if (!isValidPrice(price)) {
		$("#modifyPriceModalPriceErrorTr").show();
		$("#modifyPriceModalPriceError").html("Invalid Price.");
		$("#modifyPriceModalPrice").focus();
		$("#modifyPriceModalPrice").select();
		return;
	}

	price = parseFloat(price);
	
	$("#modifyPriceModalPrice").val(price.toFixed(2));
	
	var url_required = $("#modifyPriceModalURLRequired").val();
	
	if (url_required == "1") {
		var url = $("#modifyPriceModalURL").val();
		if (url == "") {
			$('#modifyPriceModalURLErrorTr').show();
			$("#modifyPriceModalURLError").html("URL is required");
			$("#modifyPriceModalURL").focus();
			return;
		}
		if (valid_url.test(url)) {
			// do nothing
		} else {
			$("#modifyPriceModalURLErrorTr").show();
			$("#modifyPriceModalURLError").html("Invalid URL");
			$("#modifyPriceModalURL").focus();
			$("#modifyPriceModalURL").select();
			return;
		}
	} else {
		url = "";
	}
	
	var data = {
		id: $('#modifyPriceModalID').val(),
		url: url,
		price: price,
		email: email,
		csrf: CSRF_TOKEN
	}
	App.ajax({
		url: "api.php?url=/item/modify_price",
		method: "POST",
		dataType: "json",
		data: data,
		complete: function(jqXHR, textStatus) {
			$('#modifyPriceModal').modal('hide');
		},
		success: function(data, textStatus, jqXHR ) {
			if (!data.success) {
				App.modal('Error', data.error);
			} else {
				App.modal('Info submitted', 'Items updated.');

				var value = $("#select-item").val();
				item_select_item(value, 'price_per_unit', 'asc', 0);
			}
		}
	});
}

function item_add_shop(item_id) {
	$('#itemAddShopModalItem').html("");
	
	var length = document.getElementById("itemAddShopModalVariant").length;
	if (length > 1) {
		for (var k = 1; k < length; k++) {
			document.getElementById("itemAddShopModalVariant").remove(k);
		}
	}
	$('.selectpicker').selectpicker('refresh');
	
	$('#itemAddShopModalVariantErrorTr').hide();
	$('#itemAddShopModalShopErrorTr').hide();
	$('#itemAddShopModalURLErrorTr').hide();	
	$('#itemAddShopModalPriceErrorTr').hide();
	$('#itemAddShopModalError').html("");
	$('#itemAddShopModalError').hide();
	
	$('#itemAddShopModalShop').val("0");
	$('#itemAddShopModalURL').val("");	
	$('#itemAddShopModalPrice').val("");
	
	var items_index;
	
	for (var j = 0; j < items.length; j++) {
		if (items[j].id == item_id) {
			items_index = j;
			break;
		}
	}
	
	App.ajax({
		url: "api.php?url=/item/variant&item_id=" + item_id,
		dataType: "json",
		success: function(data, textStatus, jqXHR ) {
			if (!data.success) {
				$('#alertModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$("#alertModalTitle").html('Error');
				$("#alertModalText").html(data.error)
			} else {
				$('#itemAddShopModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$('#itemAddShopModalItem').html(items[items_index].name);
				$('#itemAddShopModalItemId').val(items[items_index].id);
				var select = document.getElementById("itemAddShopModalVariant");
				for (var m = 0; m < data.variant.length; m++) {
					var option = new Option(data.variant[m].name, data.variant[m].id);
					select.add(option);
				}
				$('.selectpicker').selectpicker('refresh');
				
			}
		}
	});
}

function item_add_shop_change_shop() {
	var shop = $("#itemAddShopModalShop").val();
	if (shop == "0") return;

	var shopObj = global_shops[shop];
	if (!shopObj) return;

	if (shopObj.url == "1") {
		$('#itemAddShopModalPriceNoteTr').show();
		$("#itemAddShopModalURLtr").show();
	} else {
		$('#itemAddShopModalPriceNoteTr').hide();
		$("#itemAddShopModalURLtr").hide();
	}
}

function item_add_shop_save() {
	$('#itemAddShopModalVariantErrorTr').hide();
	$('#itemAddShopModalShopErrorTr').hide();
	$('#itemAddShopModalURLErrorTr').hide();
	$('#itemAddShopModalPriceErrorTr').hide();
	
	var item = $("#itemAddShopModalItemId").val();
	
	var variant = $("#itemAddShopModalVariant").val();
	
	if (variant == 0) {
		$('#itemAddShopModalVariantErrorTr').show();
		$('#itemAddShopModalVariantError').html('Select variant.');
		return;
	}
	
	var shop = $("#itemAddShopModalShop").val();
	
	if (shop == 0) {
		$('#itemAddShopModalShopErrorTr').show();
		$('#itemAddShopModalShopError').html('Select shop.');
		return;
	}
	
	var shopObj = global_shops[shop];
	if (!shopObj) return;

	var url = "";
	if (shopObj.url == "1") {
		url = $("#itemAddShopModalURL").val();
		if (!valid_url.test(url)) {
			$("#itemAddShopModalURLErrorTr").show();
			$("#itemAddShopModalURLError").html("Invalid URL.");
			$("#itemAddShopModalURL").focus();
			$("#itemAddShopModalURL").select();
			return;
		}
	}

	
	var price = $("#itemAddShopModalPrice").val();

	if (!isValidPrice(price)) {
		$("#itemAddShopModalPriceErrorTr").show();
		$("#itemAddShopModalPriceError").html("Invalid Price.");
		$("#itemAddShopModalPrice").focus();
		$("#itemAddShopModalPrice").select();
		return;
	}

	price = parseFloat(price);
	
	var data = {
		item: item,
		variant: variant,
		shop: shop,
		url: url,
		price: price,
		email: email,
		csrf: CSRF_TOKEN
	};

	App.ajax({
		url: "api.php?url=/item/add_shop",
		method: 'post',
		dataType: "json",
		data: data,
		success: function(data, textStatus, jqXHR ) {
			if (!data.success) {
				$('#itemAddShopModalError').show();
				$('#itemAddShopModalError').html(data.error);
			} else {
				$('#itemAddShopModal').modal('hide');
				$('#alertModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$("#alertModalTitle").html('Info submitted');
				$("#alertModalText").html(data.msg)

				$('#itemAddShopModalShop').val("0");
				$('#itemAddShopModalURL').val("");
				$('#itemAddShopModalPrice').val("");
				$('#itemAddShopModalError').html("");
				$('#itemAddShopModalError').hide();
				var length = document.getElementById("itemAddShopModalVariant").length;
				if (length > 1) {
					for (var k = 1; k < length; k++) {
						document.getElementById("itemAddShopModalVariant").remove(k);
					}
				}
				$('.selectpicker').selectpicker('refresh');
			}
		}
	});
}

function item_add_variant(item_id) {
	$('#itemAddVariantModalVariant').val("");
	$('#itemAddVariantModalVariantErrorTr').hide();
	$('#itemAddVariantModalTotalUnit').val("");
	$('#itemAddVariantModalTotalUnitErrorTr').hide();
	$('#itemAddVariantModalError').hide();
	
	var items_index;
	
	for (var j = 0; j < items.length; j++) {
		if (items[j].id == item_id) {
			items_index = j;
			break;
		}
	}
	
	var units_index;
	
	for (var j = 0; j < units.length; j++) {
		if (units[j].id == items[items_index].unit) {
			units_index = j;
			break;
		}
	}

	$('#itemAddVariantModalItem').html(items[items_index].name);
	$('#itemAddVariantModalItemId').val(items[items_index].id);
	$('#itemAddVariantModalUnit').html(units[units_index].name);
	
	$('#itemAddVariantModal').modal({
		backdrop: 'static',
		keyboard: false
	});
}

function item_add_variant_save() {
	$('#itemAddVariantModalVariantErrorTr').hide();
	$('#itemAddVariantModalTotalUnitErrorTr').hide();
	$('#itemAddVariantModalError').hide();
	
	var variant = $('#itemAddVariantModalVariant').val();
	
	if (variant == "") {
		$('#itemAddVariantModalVariantErrorTr').show();
		$('#itemAddVariantModalVariantError').html('Variant is required.');
		$('#itemAddVariantModalVariant').focus();
		return;
	}

	if (!isValidText(variant)) {
		$("#itemAddVariantModalVariantErrorTr").show();
		$("#itemAddVariantModalVariantError").html("Only Latin characters, numbers and some common symbols are accepted for Variant. Use Feedback for any suggestion.");
		$("#itemAddVariantModalVariant").focus();
		$("#itemAddVariantModalVariant").select();
		return;
	}
	
	var total_unit = $('#itemAddVariantModalTotalUnit').val();
	
	total_unit = parseFloat(total_unit);
	
	if (isNaN(total_unit)) {
		$("#itemAddVariantModalTotalUnitErrorTr").show();
		$("#itemAddVariantModalTotalUnitError").html("Only number and decimal point is accepted for Price.");
		$("#itemAddVariantModalTotalUnit").focus();
		$("#itemAddVariantModalTotalUnit").select();
		return;
	}
	
	if (total_unit <= 0) {
		$("#itemAddVariantModalTotalUnitErrorTr").show();
		$("#itemAddVariantModalTotalUnitError").html("Invalid value.");
		$("#itemAddVariantModalTotalUnit").focus();
		$("#itemAddVariantModalTotalUnit").select();
		return;
	}
	
	var data = {
		variant: variant,
		item: $('#itemAddVariantModalItemId').val(),
		unit: total_unit,
		email: email,
		csrf: CSRF_TOKEN
	};

	App.ajax({
		url: "api.php?url=/item/add_variant",
		method: 'post',
		dataType: "json",
		data: data,
		success: function(data, textStatus, jqXHR ) {
			if (!data.success) {
				$('#itemAddVariantModalError').show();
				$('#itemAddVariantModalError').html(data.error);
			} else {
				$('#itemAddVariantModal').modal('hide');
				$('#alertModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$("#alertModalTitle").html('Info submitted');
				$("#alertModalText").html(data.msg)

				$('#itemAddVariantModalItem').html("");
				$('#itemAddVariantModalVariant').val("");
				$('#itemAddVariantModalUnit').html("");
				$('#itemAddVariantModalTotalUnit').val("");
			}
		}
	});
}


function add_item_select_shop(that) {
	
	if (that.value == 0) return;
	
	if (global_shops[that.value].url == "1") {
		$('#add_item_url_tr').show();
		$('#add_item_price_note_tr').show();
	} else {
		$('#add_item_url_tr').hide();
		$('#add_item_price_note_tr').hide();
	}
}

function add_item_save() {
	$("#add_item_name_error_tr").hide();
	$("#add_item_variant_error_tr").hide();
	$("#add_item_total_unit_error_tr").hide();
	$("#add_item_url_error_tr").hide();
	$("#add_item_shop_error_tr").hide();
	$("#add_item_price_error_tr").hide();
	
	var name = $("#add_item_name").val();
	
	if (name == "") {
		$("#add_item_name_error_tr").show();
		$("#add_item_name_error").html("Item name is required.");
		$("#add_item_name").focus();
		return;
	}

	if (!isValidText(name)) {
		$("#add_item_name_error_tr").show();
		$("#add_item_name_error").html("Only Latin characters, numbers and some common symbols are accepted for Item Name. Use Feedback for any suggestion.");
		$("#add_item_name").focus();
		$("#add_item_name").select();
		return;
	}
	
	var variant = $("#add_item_variant").val();

	if (variant == "") {
		$("#add_item_variant_error_tr").show();
		$("#add_item_variant_error").html("Variant is required.");
		$("#add_item_variant").focus();
		return;
	}

	if (!isValidText(variant)) {
		$("#add_item_variant_error_tr").show();
		$("#add_item_variant_error").html("Only Latin characters, numbers and some common symbols are accepted for Variant. Use Feedback for any suggestion.");
		$("#add_item_variant").focus();
		$("#add_item_variant").select();
		return;
	}
	
	var unit = $("#add_item_unit").val();
	
	var total_unit = $("#add_item_total_unit").val();
	
	var total_unit = parseFloat(total_unit);

	if (isNaN(total_unit)) {
		$("#add_item_total_unit_error_tr").show();
		$("#add_item_total_unit_error").html("Only number and decimal point is accepted for Total Unit.");
		$("#add_item_total_unit").focus();
		$("#add_item_total_unit").select();
		return;
	}
	
	var shop = $("#add_item_shop").val();
	
	if (shop == "0") {
		$("#add_item_shop_error_tr").show();
		$("#add_item_shop_error").html("Select shop");
		$("#add_item_shop").focus();
		$("#add_item_shop").select();
		return;
	}
	
	if (global_shops[shop].url == "1") {
		var url = $("#add_item_url").val();
		if (url == "") {
			$("#add_item_url_error_tr").show();
			$("#add_item_url_error").html("URL required.");
			$("#add_item_url").focus();
			return;
		}
		
		if (valid_url.test(url)) {
			// do nothing
		} else {
			$("#add_item_url_error_tr").show();
			$("#add_item_url_error").html("Invalid URL");
			$("#add_item_url").focus();
			$("#add_item_url").select();
			return;
		}
	} else {
		var url = "";
	}
	
	var price = $("#add_item_price").val();

	if (!isValidPrice(price)) {
		$("#add_item_price_error_tr").show();
		$("#add_item_price_error").html("Invalid price.");
		$("#add_item_price").focus();
		$("#add_item_price").select();
		return;
	}

	price = parseFloat(price);
	
	var data = {
		name: name,
		variant: variant,
		unit: unit,
		total_unit: total_unit,
		shop: shop,
		url: url,
		price: price,
		email: email,
		csrf: CSRF_TOKEN
	}
	App.ajax({
		url: "api.php?url=/add_item",
		method: "POST",
		dataType: "json",
		data: data,
		success: function(data, textStatus, jqXHR ) {
			if (!data.success) {
				$('#alertModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$("#alertModalTitle").html('Error');
				$("#alertModalText").html(data.error)
			} else {
				$('#alertModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$("#alertModalTitle").html('Item submitted');
				$("#alertModalText").html(data.msg)

				// clear form and refresh items data
				hide("add_item_tab");
				$("#add_item_name").val("");
				$("#add_item_variant").val("");
				$("#add_item_unit").val("1").trigger('change');
				$("#add_item_total_unit").val("");
				$("#add_item_shop").val("0").trigger('change');
				$("#add_item_url").val("");
				$("#add_item_price").val("");

				// Clear existing data before refreshing items
				items = [];

				// Refresh items data
				App.ajax({
					url: "api.php?url=/items",
					dataType: "json",
					success: function(data) {
						if (data.success) {
							items = data.items;
							var select = document.getElementById("select-item");
							select.innerHTML = '<option value="0">Select item....</option>';
							for (var i = 0; i < items.length; i++) {
								var option = new Option(items[i].item_variant, items[i].id);
								select.add(option);
							}
							$('.selectpicker').selectpicker('refresh');
						}
					}
				});
			}
		}
	});
}

function add_shop_select_is_online(that) {
	if ((that.value == "1") || contributor.includes(email)) {
		$("#add_shop_url_tr").hide();
	} else {
		$("#add_shop_url_tr").show();
	}
}

function add_shop_save() {
	$("#add_shop_name_error_tr").hide();
	$("#add_shop_url_error_tr").hide();
	
	var shop_name = $("#add_shop_name").val();
	
	if (shop_name == "") {
		$("#add_shop_name_error_tr").show();
		$("#add_shop_name_error").html("Shop Name is required.");
		$("#add_shop_name").focus();
		return;
	}

	if (!isValidText(shop_name)) {
		$("#add_shop_name_error_tr").show();
		$("#add_shop_name_error").html("Only Latin characters, numbers and some common symbols are accepted for Shop Name. Use Feedback for any suggestion.");
		$("#add_shop_name").focus();
		$("#add_shop_name").select();
		return;
	}
	
	var online = $("#add_shop_is_online").val();
	
	if ((online == 2) && !contributor.includes(email)) {
		var url = $("#add_shop_url").val();
		
		if (url == "") {
			$("#add_shop_url_error_tr").show();
			$("#add_shop_url_error").html("URL required.");
			$("#add_shop_url").focus();
			return;
		}
		
		if (valid_url.test(url)) {
			// do nothing
		} else {
			$("#add_shop_url_error_tr").show();
			$("#add_shop_url_error").html("Invalid URL");
			$("#add_shop_url").focus();
			$("#add_shop_url").select();
			return;
		}
	} else {
		var url = "";
	}
	
	var data = {
		name: shop_name,
		online: online,
		url: url,
		email: email,
		csrf: CSRF_TOKEN
	}

	App.ajax({
		url: "api.php?url=/add_shop",
		method: "POST",
		dataType: "json",
		data: data,
		success: function(data, textStatus, jqXHR ) {
			if (!data.success) {
				$('#alertModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$("#alertModalTitle").html('Error');
				$("#alertModalText").html(data.error)
			} else {
				$('#alertModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$("#alertModalTitle").html('Info submitted');
				$("#alertModalText").html(data.msg)

				// clear form and refresh shops data
				hide("add_shop_tab");

				// Clear existing data before refreshing shops
				shops = [];
				global_shops = [];

				// Refresh shops data
				App.ajax({
					url: "api.php?url=/shops",
					dataType: "json",
					success: function(data) {
						if (data.success) {
							shops = data.shops;
							var select1 = document.getElementById("itemAddShopModalShop");
							var select2 = document.getElementById("add_item_shop");
							select1.innerHTML = '<option value="0">Select shop....</option>';
							select2.innerHTML = '<option value="0">Select shop....</option>';
							for (var i = 0; i < shops.length; i++) {
								var option1 = new Option(shops[i].name, shops[i].id);
								select1.add(option1);
								var option2 = new Option(shops[i].name, shops[i].id);
								select2.add(option2);
								global_shops[shops[i].id] = shops[i];
							}
							$('.selectpicker').selectpicker('refresh');
						}
					}
				});
			}
		}
	});
}

function add_unit_save() {
	$("#add_unit_name_error_tr").hide();
	
	var unit_name = $("#add_unit_name").val();
	
	if (unit_name == "") {
		$("#add_unit_name_error_tr").show();
		$("#add_unit_name_error").html("Unit is required.");
		$("#add_unit_name").focus();
		return;
	}

	if (!isValidText(unit_name)) {
		$("#add_unit_name_error_tr").show();
		$("#add_unit_name_error").html("Only Latin characters, numbers and some common symbols are accepted for Unit. Use Feedback for any suggestion.");
		$("#add_unit_name").focus();
		$("#add_unit_name").select();
		return;
	}
	
	var data = {
		name: unit_name,
		email: email,
		csrf: CSRF_TOKEN
	}

	App.ajax({
		url: "api.php?url=/add_unit",
		method: "POST",
		dataType: "json",
		data: data,
		success: function(data, textStatus, jqXHR ) {
			if (!data.success) {
				$('#alertModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$("#alertModalTitle").html('Error');
				$("#alertModalText").html(data.error)
			} else {
				$('#alertModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$("#alertModalTitle").html('Info submitted');
				$("#alertModalText").html(data.msg)

				// clear form and refresh units data
				hide("add_unit_tab");

				// Clear existing data before refreshing units
				units = [];

				// Refresh units data
				App.ajax({
					url: "api.php?url=/units",
					dataType: "json",
					success: function(data) {
						if (data.success) {
							units = data.units;
							var select = document.getElementById("add_item_unit");
							select.innerHTML = '';
							for (var i = 0; i < units.length; i++) {
								var option = new Option(units[i].name, units[i].id);
								select.add(option);
							}
							$('.selectpicker').selectpicker('refresh');
						}
					}
				});
			}
		}
	});
}

function contact_send() {
	$("#contact_subject_error_tr").hide();
	$("#contact_message_error_tr").hide();
	var subject = $("#contact_subject").val();
	
	if (subject == "") {
		$("#contact_subject_error_tr").show();
		$("#contact_subject_error").html("Subject is required");
		$("#contact_subject").focus();
		return;
	}

	var message = $("#contact_message").val();
	
	if (message == "") {
		$("#contact_message_error_tr").show();
		$("#contact_message_error").html("Message is required");
		$("#contact_message").focus();
		return;
	}
	
	var data = {
		subject: subject,
		message: message,
		email: email,
		user_name: user_name,
		csrf: CSRF_TOKEN
	}

	App.ajax({
		url: "api.php?url=/feedback",
		method: "POST",
		dataType: "json",
		data: data,
		success: function(data, textStatus, jqXHR ) {
			if (!data.success) {
				$('#alertModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$("#alertModalTitle").html('Error');
				$("#alertModalText").html(data.error)
			} else {
				$('#alertModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$("#alertModalTitle").html('Feedback sent');
				$("#alertModalText").html(data.msg)

				// clear form
				hide("contact_tab");
				$("#contact_subject").val("");
				$("#contact_message").val("");
			}
		}
	});

}