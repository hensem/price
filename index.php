<?php
//index.php
//Include Configuration File
require_once '../../config/config_price.php';

$login_button = '';

if (!isLoggedIn() && isset($_GET["code"])) {

    // Verify state parameter for CSRF protection
    if (!isset($_GET['state']) || !isset($_SESSION['oauth_state']) || $_GET['state'] !== $_SESSION['oauth_state']) {
        // Invalid state - potential CSRF attack
        header('Location: index.php?error=invalid_state');
        exit();
    }

    // Clear the stored state
    unset($_SESSION['oauth_state']);

    // Exchange code → token
    $token = $google_provider->getAccessToken('authorization_code', ['code' => $_GET['code']]);

    if (!$token->getToken()) {
        // Token exchange failed
        header('Location: index.php?error=token_exchange_failed');
        exit();
    }

    // Regenerate session ID for security after successful OAuth
    session_regenerate_id(true);

    // Store tokens securely
    $_SESSION['access_token'] = $token->getToken();
    $_SESSION['refresh_token'] = $token->getRefreshToken();
    $_SESSION['token_expires'] = $token->getExpires();

    // Get and validate user profile
    $user = $google_provider->getResourceOwner($token);

    if (!$user->getEmail()) {
        // Invalid user data
        session_destroy();
        header('Location: index.php?error=invalid_user');
        exit();
    }

    $_SESSION['user_first_name'] = $user->getFirstName() ?? '';
    $_SESSION['user_last_name'] = $user->getLastName() ?? '';
    $_SESSION['user_email_address'] = $user->getEmail();
    $_SESSION['user_image'] = $user->getAvatar() ?? '';

    // Server-side redirect to clean URL (more secure than JS)
    header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
    exit();
}

// Check for login button generation
if (!isLoggedIn())
{
    // Generate secure state parameter for CSRF protection
    $state = bin2hex(random_bytes(16));
    $_SESSION['oauth_state'] = $state;

    // Create OAuth URL with state parameter
    $authUrl = $google_provider->getAuthorizationUrl(['state' => $state]);
    $login_button = '<a href="' . htmlspecialchars($authUrl) . '"><img src="img/sign-in-with-google.png" alt="Sign in with Google" /></a>';
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<!--bootstrap-select-->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="//cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	
	<style>
	
	th, td {
	  padding: 2px;
	}
	.sk-fading-circle {
	  margin: 100px auto;
	  width: 40px;
	  height: 40px;
	  position: relative;
	}

	.sk-fading-circle .sk-circle {
	  width: 100%;
	  height: 100%;
	  position: absolute;
	  left: 0;
	  top: 0;
	}

	.sk-fading-circle .sk-circle:before {
	  content: '';
	  display: block;
	  margin: 0 auto;
	  width: 15%;
	  height: 15%;
	  background-color: #333;
	  border-radius: 100%;
	  -webkit-animation: sk-circleFadeDelay 1.2s infinite ease-in-out both;
			  animation: sk-circleFadeDelay 1.2s infinite ease-in-out both;
	}
	.sk-fading-circle .sk-circle2 {
	  -webkit-transform: rotate(30deg);
		  -ms-transform: rotate(30deg);
			  transform: rotate(30deg);
	}
	.sk-fading-circle .sk-circle3 {
	  -webkit-transform: rotate(60deg);
		  -ms-transform: rotate(60deg);
			  transform: rotate(60deg);
	}
	.sk-fading-circle .sk-circle4 {
	  -webkit-transform: rotate(90deg);
		  -ms-transform: rotate(90deg);
			  transform: rotate(90deg);
	}
	.sk-fading-circle .sk-circle5 {
	  -webkit-transform: rotate(120deg);
		  -ms-transform: rotate(120deg);
			  transform: rotate(120deg);
	}
	.sk-fading-circle .sk-circle6 {
	  -webkit-transform: rotate(150deg);
		  -ms-transform: rotate(150deg);
			  transform: rotate(150deg);
	}
	.sk-fading-circle .sk-circle7 {
	  -webkit-transform: rotate(180deg);
		  -ms-transform: rotate(180deg);
			  transform: rotate(180deg);
	}
	.sk-fading-circle .sk-circle8 {
	  -webkit-transform: rotate(210deg);
		  -ms-transform: rotate(210deg);
			  transform: rotate(210deg);
	}
	.sk-fading-circle .sk-circle9 {
	  -webkit-transform: rotate(240deg);
		  -ms-transform: rotate(240deg);
			  transform: rotate(240deg);
	}
	.sk-fading-circle .sk-circle10 {
	  -webkit-transform: rotate(270deg);
		  -ms-transform: rotate(270deg);
			  transform: rotate(270deg);
	}
	.sk-fading-circle .sk-circle11 {
	  -webkit-transform: rotate(300deg);
		  -ms-transform: rotate(300deg);
			  transform: rotate(300deg); 
	}
	.sk-fading-circle .sk-circle12 {
	  -webkit-transform: rotate(330deg);
		  -ms-transform: rotate(330deg);
			  transform: rotate(330deg); 
	}
	.sk-fading-circle .sk-circle2:before {
	  -webkit-animation-delay: -1.1s;
			  animation-delay: -1.1s; 
	}
	.sk-fading-circle .sk-circle3:before {
	  -webkit-animation-delay: -1s;
			  animation-delay: -1s; 
	}
	.sk-fading-circle .sk-circle4:before {
	  -webkit-animation-delay: -0.9s;
			  animation-delay: -0.9s; 
	}
	.sk-fading-circle .sk-circle5:before {
	  -webkit-animation-delay: -0.8s;
			  animation-delay: -0.8s; 
	}
	.sk-fading-circle .sk-circle6:before {
	  -webkit-animation-delay: -0.7s;
			  animation-delay: -0.7s; 
	}
	.sk-fading-circle .sk-circle7:before {
	  -webkit-animation-delay: -0.6s;
			  animation-delay: -0.6s; 
	}
	.sk-fading-circle .sk-circle8:before {
	  -webkit-animation-delay: -0.5s;
			  animation-delay: -0.5s; 
	}
	.sk-fading-circle .sk-circle9:before {
	  -webkit-animation-delay: -0.4s;
			  animation-delay: -0.4s;
	}
	.sk-fading-circle .sk-circle10:before {
	  -webkit-animation-delay: -0.3s;
			  animation-delay: -0.3s;
	}
	.sk-fading-circle .sk-circle11:before {
	  -webkit-animation-delay: -0.2s;
			  animation-delay: -0.2s;
	}
	.sk-fading-circle .sk-circle12:before {
	  -webkit-animation-delay: -0.1s;
			  animation-delay: -0.1s;
	}

	@-webkit-keyframes sk-circleFadeDelay {
	  0%, 39%, 100% { opacity: 0; }
	  40% { opacity: 1; }
	}

	@keyframes sk-circleFadeDelay {
	  0%, 39%, 100% { opacity: 0; }
	  40% { opacity: 1; } 
	}
	</style>

    <title>Hello, world!</title>
  </head>
  <body>
	<div class="container-fluid">
	<?php
		if (!empty($login_button)) {
			echo '<div align="center">' . $login_button . '</div>';
		} else {
			?>
			<div>
				<?php
				if (empty($login_button)) {
					?>
					<img src="<?php echo $_SESSION["user_image"]; ?>" class="img-responsive img-circle img-thumbnail" />
					<span style="vertical-align:40px;">Welcome <?php echo $_SESSION['user_first_name'] . " " . $_SESSION['user_last_name']; ?></span>
					<span style="float:right;text-align:right;margin-right: 5px;"><a href="logout.php" class="ui-btn ui-shadow">Logout</a><span>
					<?php
				}
				?>
			</div>
			
			<hr />
			
			<div class="spinner-border"></div>
			<ul class="nav nav-pills nav-fill" role="navigation">
			  <li class="nav-item">
				<a class="nav-link active" href="javascript:void(0)" onclick="hide('price_tab')" id="price_nav">Price</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="javascript:void(0)" onclick="hide('add_item_tab')" id="add_item_nav">Add Item</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="javascript:void(0)" onclick="hide('add_shop_tab')" id="add_shop_nav">Add Shop</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="javascript:void(0)" onclick="hide('add_unit_tab')" id="add_unit_nav">Add Unit</a>
			  </li>
			   <li class="nav-item">
				<a class="nav-link" href="javascript:void(0)" onclick="hide('contact_tab')" id="contact_nav">Feedback</a>
			  </li>
			</ul>
			
			<br />
				
			<div id="price_tab">
				<select id="select-item" data-native-menu="false" class="selectpicker" data-live-search="true" onchange="item_select_item(this.value, 'price_per_unit', 'asc', 0)">
					<option value="0">Select item....</option>
				</select>
				
				<div id="item_detail"  style="display: none;">
					<br />
					<span id="item_detail_content">
					</span>
				</div>
			</div>
			
			<div id="add_item_tab" style="display: none;">
				<table>
					<tr>
						<th>Name</th>
						<td>
							<input type="text" id="add_item_name" required>
							
						</td>
					</tr><tr id="add_item_name_error_tr">
						<td colspan="2"><div class="alert alert-danger" role="alert" id="add_item_name_error"></div></td>
					</tr><tr>
						<th>Variant</th>
						<td><input type="text" id="add_item_variant"></td>
					</tr></tr>
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
						<td>
							<input type="number" id="add_item_total_unit" pattern="[0-9]*" id="item_total_unit">
						</td>
					</tr></tr>
						<td colspan="2">Number divided by unit. E.g for kg, 600g is 0.6 and 1.2kg is 1.2; for litre, 200ml is 0.2</td>
					</tr><tr id="add_item_total_unit_error_tr">
						<td colspan="2"><div class="alert alert-danger" role="alert" id="add_item_total_unit_error"></div></td>
					</tr><tr>
						<th>Shop</th>
						<td>
							<select id="add_item_shop" data-native-menu="false" class="selectpicker" data-live-search="true" onchange="add_item_select_shop(this)">
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
						<td colspan="2"><input type="button" value="Save" data-theme="a" onclick="add_item_save()" /></td>
					</tr>
				</table>
			</div>
			
			<div id="add_shop_tab" style="display: none;">
				<table>
					<tr>
						<th>Shop Name</th>
						<td>
							<input type="text" id="add_shop_name" required>							
						</td>
					</tr><tr id="add_shop_name_error_tr">
						<td colspan="2">
							<div class="alert alert-danger" role="alert" id="add_shop_name_error"></div>
						</td>
					</tr><tr>
						<th>Online Shop?</th>
						<td>
							<select id="add_shop_is_online" onchange="add_shop_select_is_online(this)">
								<option value="1">No</option>
								<option value="2">Yes</option>
							</select>					
						</td>
					</tr><tr id="add_shop_url_tr">
						<th>Shop Website</th>
						<td>
							<input type="text" id="add_shop_url">							
						</td>
					</tr><tr id="add_shop_url_error_tr">
						<td colspan="2">
							<div class="alert alert-danger" role="alert" id="add_shop_url_error"></div>
						</td>
					</tr><tr>
						<td colspan="2"><input type="button" value="Save" data-theme="a" onclick="add_shop_save()" /></td>
					</tr>
				</table>
			</div>
			
			<div id="add_unit_tab" style="display: none;">
				<table>
					<tr>
						<th>Unit</th>
						<td>
							<input type="text" id="add_unit_name" required>							
						</td>
					</tr><tr id="add_unit_name_error_tr">
						<td colspan="2">
							<div class="alert alert-danger" role="alert" id="add_unit_name_error"></div>
						</td>
					</tr><tr>
						<td colspan="2"><input type="button" value="Save" data-theme="a" onclick="add_unit_save()" /></td>
					</tr>
				</table>
			</div>
			
			<div id="contact_tab" style="display: none;">
				<table>
					<tr>
						<th>Subject</th>
					</tr><tr>
						<td>
							<input type="text" id="contact_subject" required>							
						</td>
					</tr><tr id="contact_subject_error_tr">
						<td>
							<div class="alert alert-danger" role="alert" id="contact_subject_error"></div>
						</td>
					</tr><tr>
						<th>Message</th>
					</tr><tr>
						<td>
							<textarea class="form-control" id="contact_message" rows="3"></textarea>						
						</td>
					<tr id="contact_message_error_tr">
						<td>
							<div class="alert alert-danger" role="alert" id="contact_message_error"></div>
						</td>
					</tr><tr>
						<td><input type="button" value="Send" data-theme="a" onclick="contact_send()" /></td>
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
										<td>
											<input type="number" id="modifyPriceModalPrice" />
										</td>
									</tr><tr id="modifyPriceModalPriceNoteTr">
										<td colspan="2">Price must include shipping</td>
									</tr><tr id="modifyPriceModalPriceErrorTr">
										<td colspan="2">
											<div class="alert alert-danger" role="alert" id="modifyPriceModalPriceError"></div>
										</td>
									</tr><tr id="modifyPriceModalURLtr">
										<th>URL</th>
										<td>
											<input type="text" id="modifyPriceModalURL" />
										</td>
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
							<button type="button" class="btn btn-default" onclick="item_save_modify_price()">Save</button>
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
											<select id="itemAddShopModalShop" data-native-menu="false" class="selectpicker" data-live-search="true" onchange="item_add_shop_change_shop()">
												<option value="0">Select shop....</option>
											</select>
										</td>
									</tr><tr id="itemAddShopModalShopErrorTr">
										<td colspan="2">
											<div class="alert alert-danger" role="alert" id="itemAddShopModalShopError"></div>
										</td>
									</tr><tr id="itemAddShopModalURLtr">
										<th>URL</th>
										<td>
											<input type="text" id="itemAddShopModalURL" />
										</td>
									</tr><tr id="itemAddShopModalURLErrorTr">
										<td colspan="2">
											<div class="alert alert-danger" role="alert" id="itemAddShopModalURLError"></div>
										</td>
									</tr><tr>
										<th>Price</th>
										<td>
											<input type="number" id="itemAddShopModalPrice" />
										</td>
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
							<button type="button" class="btn btn-default" onclick="item_add_shop_save()">Save</button>
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
										<td>
											<input type="text" id="itemAddVariantModalVariant" />
										</td>
									</tr></tr>
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
										<td>
											<input type="number" id="itemAddVariantModalTotalUnit" />
										</td>
									</tr></tr>
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
							<button type="button" class="btn btn-default" onclick="item_add_variant_save()">Save</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
	
	<br /><br />
	
	<div id="right"><div style="text-align: center">
		<a href="http://www.aprelium.com/abyssws/" alt="Powered By Abyss Web Server" title="Powered By Abyss Web Server" border="0">
			<img src="/pwrabyss.gif" galleryimg="no" id="pwrabyss"></A>
		<br>
		© 2001-<?php echo date('Y'); ?> Aprelium
	</div></div>
</body>
<?php
if (empty($login_button)) {
?>
<script>

var tabs = ["price_tab", "add_item_tab", "add_shop_tab", "add_unit_tab", "contact_tab"];
var navs = ["price_nav", "add_item_nav", "add_shop_nav", "add_unit_nav", "contact_nav"];

var items = [];
var units = [];
var shops = [];
var global_shops = [];
var global_item_detail = [];

var letterNumber = /^[0-9a-zA-Z.,':-\s\&()\+%]+$/;
var valid_url = /^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i;

function renderTableHeader(itemId, itemName, unit, sort, dir, variant) {
    // Calculate directions for each column
    const shopDir = sort === "shop" ? (dir === "asc" ? "desc" : "asc") : "asc";
    const variantDir = sort === "variant" ? (dir === "asc" ? "desc" : "asc") : "asc";
    const priceDir = sort === "price_per_unit" ? (dir === "asc" ? "desc" : "asc") : "asc";

    return `
        <table border="1">
            <tr>
                <th>
                    <a href='javascript:void(0)' onclick='item_select_item(${itemId}, "shop", "${shopDir}", ${variant})'>${itemName}</a>
                </th>
                <th>
                    <a href='javascript:void(0)' onclick='item_select_item(${itemId}, "variant", "${variantDir}", ${variant})'>Variant</a>
                </th>
                <th>Price</th>
                <th>
                    <a href='javascript:void(0)' onclick='item_select_item(${itemId}, "price_per_unit", "${priceDir}", ${variant})'>Price per ${unit}</a>
                </th>
                <th>Date</th>
                <th></th>
            </tr>
    `;
}

function renderItemRow(item, index, sort, dir, variant) {
    const now = new Date();
    const then = new Date(item.last_update);
    const diffInDays = Math.round((then - now) / (1000*60*60*24));

    let shop = item.shop;
    if (item.url !== "") {
        shop = `<a href="${item.url}" target="_blank">${shop}</a>`;
    }

    const price = diffInDays < -365 ?
        `<s><span style='color:grey;'>${Number(item.price).toFixed(2)}</span></s>` :
        Number(item.price).toFixed(2);

    const pricePerUnit = diffInDays < -365 ?
        `<s><span style='color:grey;'>${Number(item.price_per_unit).toFixed(2)}</span></s>` :
        Number(item.price_per_unit).toFixed(2);

    const lastUpdate = diffInDays < -365 ?
        `<span style='color:grey;'>${item.last_update}</span>` :
        item.last_update;

    return `
        <tr>
            <td>${shop}</td>
            <td>${item.variant}</td>
            <td>${price}</td>
            <td>${pricePerUnit}</td>
            <td>${lastUpdate}</td>
            <td>
                <input type="button" id="modifyPriceButton" value="Modify" onclick="item_modify_price(${index}, '${sort}', '${dir}', ${variant})" />
            </td>
        </tr>
    `;
}

function renderTableFooter(itemId) {
    return `
        </table>
        <br /><br />
        <input type="button" id="addShopButton" value="Add Shop" onclick="item_add_shop(${itemId})" />
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" id="addVariantButton" value="Add Variant" onclick="item_add_variant(${itemId})" />
    `;
}

var App = {};
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

App.showError = function (msg) {
    $('#alertModal').modal({ backdrop: 'static', keyboard: false });
    $("#alertModalTitle").text('Error');
    $("#alertModalText").text(msg);
};

App.loadItems = function () {
    App.ajax({
        url: "api.php?url=/items",
        dataType: "json",
        success: function(data) {
            if (data.success) {
                items = data.items;
                var select = document.getElementById("select-item");
                // Clear existing options except the first one
                select.innerHTML = '<option value="0">Select item....</option>';
                for (var i = 0; i < items.length; i++) {
                    var option = new Option(items[i].item_variant, items[i].id);
                    select.add(option);
                }
                $('.selectpicker').selectpicker('refresh');
            }
        }
    });
};

var contributor = [];
<?php
for ($i = 0; $i < count($contributor); $i++) {
	?>
	contributor[contributor.length] = "<?php echo $contributor[$i]; ?>";
	<?php
}
?>

var email = "<?php echo $_SESSION['user_email_address']; ?>";

function loadInitialData() {
	App.ajax({
		url: "api.php?url=/items",
		dataType: "json",
		success: function(data) {
			if (data.success) {
				items = data.items;
				var select = document.getElementById("select-item");
				for (var i = 0; i < items.length; i++) {
					var option = new Option(items[i].item_variant, items[i].id);
					select.add(option);
				}
				$('.selectpicker').selectpicker('refresh');
			}
		}
	});

	App.ajax({
		url: "api.php?url=/units",
		dataType: "json",
		success: function(data) {
			if (data.success) {
				units = data.units;
				var select = document.getElementById("add_item_unit");
				for (var i = 0; i < units.length; i++) {
					var option = new Option(units[i].name, units[i].id);
					select.add(option);
				}
				$('.selectpicker').selectpicker('refresh');
			}
		}
	});

	App.ajax({
		url: "api.php?url=/shops",
		dataType: "json",
		success: function(data) {
			if (data.success) {
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

loadInitialData();

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
				$('#alertModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$("#alertModalTitle").html('Error');
				$("#alertModalText").html(data.error)
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
	
	var price = parseFloat(price);

	if (isNaN(price)) {
		$("#modifyPriceModalPriceErrorTr").show();
		$("#modifyPriceModalPriceError").html("Only number and decimal point is accepted for Price.");
		$("#modifyPriceModalPrice").focus();
		$("#modifyPriceModalPrice").select();
		return;
	}
	
	if (price <= 0) {
		$("#modifyPriceModalPriceErrorTr").show();
		$("#modifyPriceModalPriceError").html("Invalid Price.");
		$("#modifyPriceModalPrice").focus();
		$("#modifyPriceModalPrice").select();
		return;
	}
	
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
		email: email
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
				$("#alertModalTitle").html('Info submitted');	// kat sini
				$("#alertModalText").html('Items updated.')
				
				value = $("#select-item").val();
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
	
	j = 1;	
	do {
		if (global_shops[j] == undefined) {
			j++;
			continue;
		}
		if (global_shops[j].id == shop) {
			if (global_shops[j].url == "1") {
				$('#itemAddShopModalPriceNoteTr').show();
				$("#itemAddShopModalURLtr").show();
			} else {
				$('#itemAddShopModalPriceNoteTr').hide();
				$("#itemAddShopModalURLtr").hide();
			}
			break;
		} else {
			j++;
		}
	} while (true);
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
	
	j = 1;	
	do {
		if (global_shops[j] == undefined) {
			j++;
			continue;
		}
		if (global_shops[j].id == shop) {
			if (global_shops[j].url == "1") {
				var url = $("#itemAddShopModalURL").val();
				if (valid_url.test(url)) {
					// do nothing
				} else {
					$("#itemAddShopModalURLErrorTr").show();
					$("#itemAddShopModalURLError").html("Invalid URL.");
					$("#itemAddShopModalURL").focus();
					$("#itemAddShopModalURL").select();
					return;
				}
			} else {
				var url = "";
			}
			break;
		} else {
			j++;
		}
	} while (true);
	
	var price = $("#itemAddShopModalPrice").val();
	
	var price = parseFloat(price);

	if (isNaN(price)) {
		$("#itemAddShopModalPriceErrorTr").show();
		$("#itemAddShopModalPriceError").html("Only number and decimal point is accepted for Price.");
		$("#itemAddShopModalPrice").focus();
		$("#itemAddShopModalPrice").select();
		return;
	}
	
	var data = {
		item: item,
		variant: variant,
		shop: shop,
		url: url,
		price: price,
		email: email
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

	if (!variant.match(letterNumber)) {
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
		email: email
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

	if (!name.match(letterNumber)) {
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

	if (!variant.match(letterNumber)) {
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
			$(add_item_url_error).html("Invalid URL");
			$("#add_item_url").focus();
			$("#add_item_url").select();
			return;
		}
	} else {
		var url = "";
	}
	
	var price = $("#add_item_price").val();

	var price = parseFloat(price);

	if (isNaN(price)) {
		$("#add_item_price_error_tr").show();
		$("#add_item_price_error").html("Only number and decimal point is accepted for Total Unit.");
		$("#add_item_price").focus();
		$("#add_item_price").select();
		return;
	}
	
	var data = {
		name: name,
		variant: variant,
		unit: unit,
		total_unit: total_unit,
		shop: shop,
		url: url,
		price: price,
		email: email
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

				// clear form
				hide("add_item_tab");
				$("#add_item_name").val("");
				$("#add_item_variant").val("");
				$("#add_item_unit").val("1").trigger('change');
				$("#add_item_total_unit").val("");
				$("#add_item_shop").val("0").trigger('change');
				$("#add_item_url").val("");
				$("#add_item_price").val("");
				App.loadItems();
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

	if (!shop_name.match(letterNumber)) {
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
			$("add_shop_url").focus();
			return;
		}
		
		if (valid_url.test(url)) {
			// do nothing
		} else {
			$("#add_shop_url_error_tr").show();
			$("#add_shop_url_error").html("Invalid URL");
			$("#add_shop_ur").focus();
			$("#add_shop_ur").select();
			return;
		}
	} else {
		var url = "";
	}
	
	var data = {
		name: shop_name,
		online: online,
		url: url,
		email: email
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

				// clear form
				hide("add_shop_tab");
				location.reload();
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

	if (!unit_name.match(letterNumber)) {
		$("#add_unit_name_error_tr").show();
		$("#add_unit_name_error").html("Only Latin characters, numbers and some common symbols are accepted for Unit. Use Feedback for any suggestion.");
		$("#add_unit_name").focus();
		$("#add_unit_name").select();
		return;
	}
	
	var data = {
		name: unit_name,
		email: email
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

				// clear form
				hide("add_unit_tab");
				location.reload();
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
		user_name: "<?php echo $_SESSION['user_first_name'] . " " . $_SESSION['user_last_name']; ?>"
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
</script>
<?php
}
?>
</html>
