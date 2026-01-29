<?php
//index.php
//Include Configuration File
require_once '../../config/config_price.php';

/*
|--------------------------------------------------------------------------
| Security Headers (must be sent BEFORE any output)
|--------------------------------------------------------------------------
*/
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: interest-cohort=()');
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://code.jquery.com https://cdnjs.cloudflare.com https://maxcdn.bootstrapcdn.com https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' https://maxcdn.bootstrapcdn.com https://cdn.jsdelivr.net; img-src 'self' data: https:; connect-src 'self'; font-src 'self' https://maxcdn.bootstrapcdn.com https://cdn.jsdelivr.net;");

// Regenerate CSRF token every 30 minutes
if (!isset($_SESSION['csrf']) || $_SESSION['csrf_time'] < time() - 1800) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
    $_SESSION['csrf_time'] = time();
}

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

    // Prevent OAuth code replay
    if (isset($_SESSION['oauth_code_used'])) {
        header('Location: index.php');
        exit();
    }
    $_SESSION['oauth_code_used'] = true;

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
    if ($token->getRefreshToken()) {
		$_SESSION['refresh_token'] = $token->getRefreshToken();
	}
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

    // Clear the code used flag after successful authentication
    unset($_SESSION['oauth_code_used']);

    // Generate CSRF token for session
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
    $_SESSION['csrf_time'] = time();

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
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<!--bootstrap-select-->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	
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

    <title>Price Tracker</title>
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
					<img src="<?= htmlspecialchars($_SESSION['user_image'], ENT_QUOTES) ?>" class="img-responsive img-circle img-thumbnail" />
					<span>
					Welcome <?= htmlspecialchars($_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name'], ENT_QUOTES) ?>
					</span>
					<span style="float:right;text-align:right;margin-right: 5px;"><a href="logout.php" class="ui-btn ui-shadow">Logout</a><span>
					<?php
				}
				?>
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
							<input type="number" id="add_item_total_unit" pattern="[0-9]*">
						</td>
					</tr></tr>
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
							<select id="add_shop_is_online">
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
						<td colspan="2"><input type="button" value="Save" data-theme="a" data-action="add_shop_save" /></td>
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
						<td colspan="2"><input type="button" value="Save" data-theme="a" data-action="add_unit_save" /></td>
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
							<button type="button" class="btn btn-default" data-action="item_add_variant_save">Save</button>
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
var contributor = [];
<?php
for ($i = 0; $i < count($contributor); $i++) {
	?>
	contributor[contributor.length] = "<?php echo $contributor[$i]; ?>";
	<?php
}
?>

var email = "<?php echo $_SESSION['user_email_address']; ?>";
var user_name = "<?php echo $_SESSION['user_first_name'] . " " . $_SESSION['user_last_name']; ?>";
var CSRF_TOKEN = "<?php echo $_SESSION['csrf']; ?>";

$(document).ready(function() {
    loadInitialData();
    
    // Event delegation for all click events
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
    
    // Change event delegation
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
<?php
}
?>
</html>
