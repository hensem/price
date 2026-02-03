<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	
	<link rel="stylesheet" href="css/style.css">

    <title>Hello, World!</title>
  </head>
  <body>
	<div class="container-fluid">
	<?php if (!empty($template_vars['login_button'])): ?>
		<div style="text-align: center;"><?= $template_vars['login_button'] ?></div>
	<?php else: ?>
		<div>
			<img src="<?= htmlspecialchars($template_vars['user_image'], ENT_QUOTES) ?>" class="img-responsive img-circle img-thumbnail" />
			<span>Welcome <?= htmlspecialchars($template_vars['user_name'], ENT_QUOTES) ?></span>
			<span style="float:right;text-align:right;margin-right: 5px;"><a href="logout.php" class="ui-btn ui-shadow">Logout</a></span>
		</div>
		
		<hr />
		
		<div class="spinner-border"></div>
		<ul class="nav nav-pills nav-fill" role="navigation">
		  <li class="nav-item">
			<a class="nav-link active" href="javascript:void(0)" data-tab="price_tab" id="price_nav">Price</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="javascript:void(0)" data-tab="add_item_tab" id="add_item_nav">Add Item</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="javascript:void(0)" data-tab="add_shop_tab" id="add_shop_nav">Add Shop</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="javascript:void(0)" data-tab="add_unit_tab" id="add_unit_nav">Add Unit</a>
		  </li>
		   <li class="nav-item">
			<a class="nav-link" href="javascript:void(0)" data-tab="contact_tab" id="contact_nav">Feedback</a>
		  </li>
		</ul>
		
		<br />
			
		<div id="price_tab">
			<select id="select-item" data-native-menu="false" class="selectpicker" data-live-search="true">
				<option value="0">Select item....</option>
			</select>
			
			<div id="item_detail"  style="display: none;">
				<br />
				<span id="item_detail_content"></span>
			</div>
		</div>
		
		<div id="add_item_tab" style="display: none;">
			<table>
				<tr>
					<th>Name</th>
					<td><input type="text" id="add_item_name" required></td>
				</tr><tr id="add_item_name_error_tr">
					<td colspan="2"><div class="alert alert-danger" role="alert" id="add_item_name_error"></div></td>
				</tr><tr>
					<th>Variant</th>
					<td><input type="text" id="add_item_variant"></td>
				</tr><tr>
					<td colspan="2">E.g. 1kg, 12x200g, 3 pieces, 500's tablets, 500ml ....</td>
				</tr><tr id="add_item_variant_error_tr">
					<td colspan="2"><div class="alert alert-danger" role="alert" id="add_item_variant_error"></div></td>
				</tr><tr>
					<th>Unit</th>
					<td>
						<select id="add_item_unit" data-native-menu="false" class="selectpicker" data-live-search="true">
						</select>
					</td>
				</tr><tr>
					<th>Total Unit</th>
					<td><input type="number" id="add_item_total_unit" pattern="[0-9]*"></td>
				</tr><tr>
					<td colspan="2">Number divided by unit. E.g for kg, 600g is 0.6 and 1.2kg is 1.2; for litre, 200ml is 0.2</td>
				</tr><tr id="add_item_total_unit_error_tr">
					<td colspan="2"><div class="alert alert-danger" role="alert" id="add_item_total_unit_error"></div></td>
				</tr><tr>
					<th>Shop</th>
					<td>
						<select id="add_item_shop" data-native-menu="false" class="selectpicker" data-live-search="true">
							<option value="0">Select shop....</option>
						</select>
					</td>
				</tr><tr id="add_item_shop_error_tr">
					<td colspan="2"><div class="alert alert-danger" role="alert" id="add_item_shop_error"></div></td>
				</tr><tr id="add_item_url_tr">
					<th>URL</th>
					<td><input type="text" id="add_item_url"></td>
				</tr><tr id="add_item_url_error_tr">
					<td colspan="2"><div class="alert alert-danger" role="alert" id="add_item_url_error"></div></td>
				</tr><tr>
					<th>Price</th>
					<td><input type="number" pattern="[0-9]*" id="add_item_price"></td>
				</tr><tr id="add_item_price_note_tr">
					<td colspan="2">Price must include shipping</td>
				</tr><tr id="add_item_price_error_tr">
					<td colspan="2"><div class="alert alert-danger" role="alert" id="add_item_price_error"></div></td>
				</tr><tr>
					<td colspan="2"><input type="button" value="Save" data-theme="a" data-action="add_item_save" /></td>
				</tr>
			</table>
		</div>
		
		<div id="add_shop_tab" style="display: none;">
			<table>
				<tr>
					<th>Shop Name</th>
					<td><input type="text" id="add_shop_name" required></td>
				</tr><tr id="add_shop_name_error_tr">
					<td colspan="2">
						<div class="alert alert-danger" role="alert" id="add_shop_name_error"></div>
					</td>
				</tr><tr>
					<th>Online Shop?</th>
					<td>
						<select id="add_shop_is_online">
							<option value="1">No</option>
							<option value="2">Yes</option>
						</select>
					</td>
				</tr><tr id="add_shop_url_tr">
					<th>Shop Website</th>
					<td><input type="text" id="add_shop_url"></td>
				</tr><tr id="add_shop_url_error_tr">
					<td colspan="2">
						<div class="alert alert-danger" role="alert" id="add_shop_url_error"></div>
					</td>
				</tr><tr>
					<td colspan="2"><input type="button" value="Save" data-theme="a" data-action="add_shop_save" /></td>
				</tr>
			</table>
		</div>
		
		<div id="add_unit_tab" style="display: none;">
			<table>
				<tr>
					<th>Unit</th>
					<td><input type="text" id="add_unit_name" required></td>
				</tr><tr id="add_unit_name_error_tr">
					<td colspan="2">
						<div class="alert alert-danger" role="alert" id="add_unit_name_error"></div>
					</td>
				</tr><tr>
					<td colspan="2"><input type="button" value="Save" data-theme="a" data-action="add_unit_save" /></td>
				</tr>
			</table>
		</div>
		
		<div id="contact_tab" style="display: none;">
			<table>
				<tr>
					<th>Subject</th>
				</tr><tr>
					<td><input type="text" id="contact_subject" required></td>
				</tr><tr id="contact_subject_error_tr">
					<td>
						<div class="alert alert-danger" role="alert" id="contact_subject_error"></div>
					</td>
				</tr><tr>
					<th>Message</th>
				</tr><tr>
					<td><textarea class="form-control" id="contact_message" rows="3"></textarea></td>
				<tr id="contact_message_error_tr">
					<td>
						<div class="alert alert-danger" role="alert" id="contact_message_error"></div>
					</td>
				</tr><tr>
					<td><input type="button" value="Send" data-theme="a" data-action="contact_send" /></td>
				</tr>
			</table>
		</div>
		
		<div class="sk-fading-circle" style="display: none;" id="spinner">
		  <div class="sk-circle1 sk-circle"></div>
		  <div class="sk-circle2 sk-circle"></div>
		  <div class="sk-circle3 sk-circle"></div>
		  <div class="sk-circle4 sk-circle"></div>
		  <div class="sk-circle5 sk-circle"></div>
		  <div class="sk-circle6 sk-circle"></div>
		  <div class="sk-circle7 sk-circle"></div>
		  <div class="sk-circle8 sk-circle"></div>
		  <div class="sk-circle9 sk-circle"></div>
		  <div class="sk-circle10 sk-circle"></div>
		  <div class="sk-circle11 sk-circle"></div>
		  <div class="sk-circle12 sk-circle"></div>
		</div>
		
		<div class="modal" tabindex="-1" id="alertModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="alertModalTitle"></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<p id="alertModalText"></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal" tabindex="-1" id="modifyPriceModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="modifyPriceModalTitle"></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<p id="modifyPriceModalText">
							<table border="0">
								<tr>
									<th>Item</th>
									<td><span id="modifyPriceModalItem"></span></td>
								</tr><tr>
									<th>Variant</th>
									<td><span id="modifyPriceModalVariant"></span></td>
								</tr><tr>
									<th>Shop</th>
									<td><span id="modifyPriceModalShop"></span></td>
								</tr><tr>
									<th>Price</th>
									<td><input type="number" id="modifyPriceModalPrice" /></td>
								</tr><tr id="modifyPriceModalPriceNoteTr">
									<td colspan="2">Price must include shipping</td>
								</tr><tr id="modifyPriceModalPriceErrorTr">
									<td colspan="2">
										<div class="alert alert-danger" role="alert" id="modifyPriceModalPriceError"></div>
									</td>
								</tr><tr id="modifyPriceModalURLtr">
									<th>URL</th>
									<td><input type="text" id="modifyPriceModalURL" /></td>
								</tr><tr id="modifyPriceModalURLErrorTr">
									<td colspan="2">
										<div class="alert alert-danger" role="alert" id="modifyPriceModalURLError"></div>
									</td>
								</tr>
							</table>
							<input type="hidden" id="modifyPriceModalID" />
							<input type="hidden" id="modifyPriceModalURLRequired" />
						</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-action="item_save_modify_price">Save</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal" tabindex="-1" id="itemAddShopModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="itemAddShopModalTitle">Add Shop</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<p id="itemAddShopModalBody">
							<table border="0">
								<tr>
									<th>Item</th>
									<td><span id="itemAddShopModalItem"></span></td>
									<input type="hidden" id="itemAddShopModalItemId" />
								</tr><tr>
									<th>Variant</th>
									<td>
										<select id="itemAddShopModalVariant" data-native-menu="false" class="selectpicker" data-live-search="true">
											<option value="0">Select variant....</option>
										</select>
									</td>
								</tr><tr id="itemAddShopModalVariantErrorTr">
									<td colspan="2">
										<div class="alert alert-danger" role="alert" id="itemAddShopModalVariantError"></div>
									</td>
								</tr><tr>
									<th>Shop</th>
									<td>
										<select id="itemAddShopModalShop" data-native-menu="false" class="selectpicker" data-live-search="true">
											<option value="0">Select shop....</option>
										</select>
									</td>
								</tr><tr id="itemAddShopModalShopErrorTr">
									<td colspan="2">
										<div class="alert alert-danger" role="alert" id="itemAddShopModalShopError"></div>
									</td>
								</tr><tr id="itemAddShopModalURLtr">
									<th>URL</th>
									<td><input type="text" id="itemAddShopModalURL" /></td>
								</tr><tr id="itemAddShopModalURLErrorTr">
									<td colspan="2">
										<div class="alert alert-danger" role="alert" id="itemAddShopModalURLError"></div>
									</td>
								</tr><tr>
									<th>Price</th>
									<td><input type="number" id="itemAddShopModalPrice" /></td>
								</tr><tr id="itemAddShopModalPriceNoteTr">
									<td colspan="2">Price must include shipping</td>
								</tr><tr id="itemAddShopModalPriceErrorTr">
									<td colspan="2">
										<div class="alert alert-danger" role="alert" id="itemAddShopModalPriceError"></div>
									</td>
								</tr>
							</table>
							<div class="alert alert-danger" role="alert" id="itemAddShopModalError"></div>
						</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-action="item_add_shop_save">Save</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal" tabindex="-1" id="itemAddVariantModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="itemAddVariantModalTitle">Add Variant</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<p id="itemAddVariantModalBody">
							<table border="0">
								<tr>
									<th>Item</th>
									<td><span id="itemAddVariantModalItem"></span></td>
									<input type="hidden" id="itemAddVariantModalItemId" />
								</tr><tr>
									<th>Variant</th>
									<td><input type="text" id="itemAddVariantModalVariant" /></td>
								</tr><tr>
									<td colspan="2">E.g. 1kg, 12x200g, 3 pieces, 500's tablets, 500ml ....</td>
								</tr><tr id="itemAddVariantModalVariantErrorTr">
									<td colspan="2">
										<div class="alert alert-danger" role="alert" id="itemAddVariantModalVariantError"></div>
									</td>
								</tr><tr>
									<th>Unit</th>
									<td><span id="itemAddVariantModalUnit"></span></td>
								</tr><tr id="itemAddVariantModalTotalUnittr">
									<th>Total Unit</th>
									<td><input type="number" id="itemAddVariantModalTotalUnit" /></td>
								</tr><tr>
									<td colspan="2">Number divided by unit. E.g for kg, 600g is 0.6 and 1.2kg is 1.2; for litre, 200ml is 0.2</td>
								</tr><tr id="itemAddVariantModalTotalUnitErrorTr">
									<td colspan="2">
										<div class="alert alert-danger" role="alert" id="itemAddVariantModalTotalUnitError"></div>
									</td>
								</tr>
							</table>
							<div class="alert alert-danger" role="alert" id="itemAddVariantModalError"></div>
						</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-action="item_add_variant_save">Save</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		
		<script>
		var contributor = [<?php foreach($template_vars['contributor'] as $c): ?>"<?= htmlspecialchars($c, ENT_QUOTES) ?>",<?php endforeach; ?>];
		var email = "<?= htmlspecialchars($template_vars['user_email'], ENT_QUOTES) ?>";
		var user_name = "<?= htmlspecialchars($template_vars['user_name'], ENT_QUOTES) ?>";
		var CSRF_TOKEN = "<?= htmlspecialchars($template_vars['csrf_token'], ENT_QUOTES) ?>";

		$(document).ready(function() {
			loadInitialData();
			
			$(document).on('click', '[data-tab]', function(e) {
				e.preventDefault();
				hide($(this).data('tab'));
			});
			
			$(document).on('click', '[data-action]', function(e) {
				e.preventDefault();
				const action = $(this).data('action');
				window[action]();
			});
			
			$(document).on('click', '.sort-link', function(e) {
				e.preventDefault();
				const $this = $(this);
				item_select_item($this.data('item-id'), $this.data('sort'), $this.data('dir'), $this.data('variant'));
			});
			
			$(document).on('click', '.modify-price-btn', function(e) {
				e.preventDefault();
				const $this = $(this);
				item_modify_price($this.data('index'), $this.data('sort'), $this.data('dir'), $this.data('variant'));
			});
			
			$(document).on('click', '.add-shop-btn', function(e) {
				e.preventDefault();
				item_add_shop($(this).data('item-id'));
			});
			
			$(document).on('click', '.add-variant-btn', function(e) {
				e.preventDefault();
				item_add_variant($(this).data('item-id'));
			});
			
			$(document).on('change', '#select-item', function() {
				item_select_item(this.value, 'price_per_unit', 'asc', 0);
			});
			
			$(document).on('change', '#add_item_shop', function() {
				add_item_select_shop(this);
			});
			
			$(document).on('change', '#add_shop_is_online', function() {
				add_shop_select_is_online(this);
			});
			
			$(document).on('change', '#itemAddShopModalShop', function() {
				item_add_shop_change_shop();
			});
		});
		</script>
		<script src="js/app.js"></script>
	<?php endif; ?>
	</div>
	
	<br /><br />
	
	<div id="right"><div style="text-align: center">
		<a href="http://www.aprelium.com/abyssws/" alt="Powered By Abyss Web Server" title="Powered By Abyss Web Server" border="0">
			<img src="/pwrabyss.gif" galleryimg="no" id="pwrabyss"></a>
		<br>
		© 2001-<?= $template_vars['current_year'] ?> Aprelium
	</div></div>
</body>
</html>