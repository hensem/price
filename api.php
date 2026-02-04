<?php
require_once '../../config/config_price.php';
require_once 'vendor/autoload.php';

use flight\Engine;

// Verify CSRF token for POST requests
function verifyCSRF() {
    if (!isset($_POST['csrf']) || !isset($_SESSION['csrf']) || !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
        header('Content-Type: application/json');
        http_response_code(403);
        echo json_encode(['success' => false, 'error' => 'CSRF token verification failed']);
        exit();
    }
}

// Check if user is logged in with Google
function checkAuth() {
    if (!isset($_SESSION['access_token'])) {
        header('Content-Type: text/plain; charset=utf-8');
        echo "This is a private server. If you come here by mistake, go away";
        exit();
    }
}

// Handle direct API access (no URL parameter)
$url_param = $_GET['url'] ?? '';
if (empty($url_param)) {
    checkAuth();
    header('Content-Type: text/plain; charset=utf-8');
    echo "This is a private server. If you come here by mistake, go away";
    exit;
}

// Manual routing based on URL parameter
switch ($url_param) {
    case '/items':
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header('Content-Type: application/json');
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            break;
        }

        checkAuth();

        $conn = connect_db();
        $q = "select * from v_item_variant order by item_variant asc";
        $result = $conn->query($q);

        $items = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $items[] = $row;
        }

        disconnect_db($conn);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'items' => $items], JSON_PRETTY_PRINT);
        break;

    case '/units':
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header('Content-Type: application/json');
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            break;
        }

        checkAuth();

        $conn = connect_db();
        $q = "select * from unit order by name asc";
        $result = $conn->query($q);

        $units = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $units[] = $row;
        }

        disconnect_db($conn);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'units' => $units], JSON_PRETTY_PRINT);
        break;

    case '/shops':
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header('Content-Type: application/json');
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            break;
        }

        checkAuth();

        $conn = connect_db();
        $q = "select * from shop order by name asc";
        $result = $conn->query($q);

        $shops = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $shops[] = $row;
        }

        disconnect_db($conn);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'shops' => $shops], JSON_PRETTY_PRINT);
        break;

    case '/initial_data':
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header('Content-Type: application/json');
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            break;
        }

        checkAuth();

        $conn = connect_db();

        // Fetch items
        $q_items = "select * from v_item_variant order by item_variant asc";
        $result_items = $conn->query($q_items);
        $items = [];
        while ($row = $result_items->fetch(PDO::FETCH_ASSOC)) {
            $items[] = $row;
        }

        // Fetch units
        $q_units = "select * from unit order by name asc";
        $result_units = $conn->query($q_units);
        $units = [];
        while ($row = $result_units->fetch(PDO::FETCH_ASSOC)) {
            $units[] = $row;
        }

        // Fetch shops
        $q_shops = "select * from shop order by name asc";
        $result_shops = $conn->query($q_shops);
        $shops = [];
        while ($row = $result_shops->fetch(PDO::FETCH_ASSOC)) {
            $shops[] = $row;
        }

        disconnect_db($conn);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'items' => $items, 'units' => $units, 'shops' => $shops], JSON_PRETTY_PRINT);
        break;

    case '/item':
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header('Content-Type: application/json');
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            break;
        }

        // Check authentication first
        checkAuth();

        $sort = $_GET['sort'] ?? 'price_per_unit';
        $dir = $_GET['dir'] ?? 'asc';
        $item_id = $_GET['item_id'];
        $variant = $_GET['variant'] ?? 0;

        if (!$item_id) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Item ID required']);
            break;
        }

        // Validate sort and dir to prevent SQL injection
        $allowed_sorts = ['price_per_unit', 'shop', 'variant', 'price', 'last_update'];
        $allowed_dirs = ['asc', 'desc'];

        if (!in_array($sort, $allowed_sorts)) {
            $sort = 'price_per_unit';
        }
        if (!in_array(strtolower($dir), $allowed_dirs)) {
            $dir = 'asc';
        }

        try {
            $conn = connect_db();

            // Build the query with proper ORDER BY syntax
            $q = "select * from v_item_shop where item_id = ? order by (last_update < datetime('now', '-3 months')), `{$sort}` {$dir}";
            $stmt = $conn->prepare($q);
            if (!$stmt) {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(['success' => false, 'error' => 'Database prepare failed: ' . implode(' ', $conn->errorInfo())]);
                break;
            }
            $stmt->execute([$item_id]);

            $items = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $items[] = $row;
            }

            disconnect_db($conn);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'items' => $items], JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
        }
        break;

    case '/item/modify_price':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            break;
        }

        checkAuth();
        verifyCSRF();

        $data = $_POST;
        $id = $data['id'];
        $url = $data['url'];
        $price = $data['price'];
        if (isset($data['email'])) {
            $email = $data['email'];
        } else {
            $email = $_SESSION['user_email_address'];
        }

        if (!$id || !$price) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'ID and price required']);
            break;
        }

        $email = 'hensem@gmail.com'; // Override as per original logic

        $conn = connect_db();

        // Check if user is contributor
        if (!in_array($email, $GLOBALS['contributor'])) {
            // Send email for review
            $body = "User: " . $email . "<br /><br />";
            $body .= "id: " . $id . "<br /><br />";
            $body .= "price: " . $price . "<br /><br />";
            $body .= "url: " . $url . "<br /><br />";
            $body .= "email: " . $email . "<br /><br />";
            $r = mailer("hensem@gmail.com", "mamat hensem", "Price || Modify Item Price", $body);
            if ($r["success"]) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'msg' => "Your submission will be review and updated. Thank you."]);
            } else {
                $modify_log_timestamp = date("Y-m-d H:i:s");
                if (isset($r["error"])) {
                    $error_message = $r["error"];
                } else {
                    $error_message = "Unknown error";
                }
                $q = "insert into `log` (`table`, `new_value`, `user`, `timestamp`) values (?, ?, ?, ?)";
                $stmt = $conn->prepare($q);
                $stmt->execute(['mailer', $error_message, $email, $modify_log_timestamp]);
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => "There were error submitting your info. Please try again later."]);
            }
            disconnect_db($conn);
        } else {
            // Contributor logic
            global $db_path;
            $q = "select * from item_shop where id = ?";
            $stmt = $conn->prepare($q);
            $stmt->execute([$id]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($rows) == 0) {
                disconnect_db($conn);
                header('Content-Type: application/json');
                http_response_code(404);
                echo json_encode(['success' => false, 'error' => 'Item not found']);
                break;
            }

            $row = $rows[0];
            $old_value_price = 0;
            if (isset($row["price"])) {
                $old_value_price = $row["price"];
            }
            $old_value_url = "";
            if (isset($row["url"])) {
                $old_value_url = $row["url"];
            }

            $modify_current_timestamp = date("Y-m-d H:i:s");

            // Log price change
            if ($old_value_price != $price) {
                $q = "INSERT INTO `log`
                    (`table`, `column`, `rec_id`, `old_value`, `new_value`, `user`, `timestamp`)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($q);

                $table_name  = 'item_shop';
                $column_name = 'price';

                $stmt->execute([$table_name, $column_name, $id, $old_value_price, $price, $email, $modify_current_timestamp]);
            }

            // Log URL change
            if ($old_value_url != $url) {
                $q = "insert into `log` (`table`, `column`, `rec_id`, `old_value`, `new_value`, `user`, `timestamp`) values (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($q);
                $stmt->execute(['item_shop', 'url', $id, $old_value_url, $url, $email, $modify_current_timestamp]);
            }

            // Update item_shop
            $modify_update_timestamp = date("Y-m-d H:i:s");
            $q = "update `item_shop` set `price` = ?, `url` = ?, last_update = ? where `id` = ?";
            $stmt = $conn->prepare($q);
            $stmt->execute([$price, $url, $modify_update_timestamp, $id]);

            $body = "item_shop id: " . $id . "<br /><br />";
            $body .= "User: " . $email . "<br /><br />";
            $body .= "Old price: " . $old_value_price . "<br /><br />";
            $body .= "New price: " . $price . "<br /><br />";
            $body .= "Old URL: " . $old_value_url . "<br /><br />";
            $body .= "New URL: " . $url . "<br /><br />";

            $r = mailer("hensem@gmail.com", "mamat hensem", "Price || Item Modify", $body);

            disconnect_db($conn);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'msg' => "Thank you."]);
        }
        break;

    case '/item/variant':
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header('Content-Type: application/json');
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            break;
        }

        checkAuth();

        $item_id = $_GET['item_id'];

        if (!$item_id) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Item ID required']);
            break;
        }

        $conn = connect_db();
        $q = "select * from variant where item = ?";
        $stmt = $conn->prepare($q);
        $stmt->execute([$item_id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) == 0) {
            disconnect_db($conn);
            header('Content-Type: application/json');
            http_response_code(404);
            echo json_encode(['success' => false, 'error' => "Cannot find item's variant"]);
            break;
        }

        $variant = $rows;

        disconnect_db($conn);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'variant' => $variant], JSON_PRETTY_PRINT);
        break;

    case '/item/add_shop':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            break;
        }

        checkAuth();
        verifyCSRF();

        $data = $_POST;
        $item = $data['item'];
        $variant = $data['variant'];
        $shop = $data['shop'];
        $url = trim($data['url']);
        $price = $data['price'];
        if (isset($data['email'])) {
            $email = $data['email'];
        } else {
            $email = $_SESSION['user_email_address'];
        }

        if (!$item || !$variant || !$shop || !$price) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Item, variant, shop, and price required']);
            break;
        }

        $conn = connect_db();

        // Check if exists
        $q = "select * from `item_shop` where `item` = ? and `variant` = ? and `shop` = ?";
        $stmt = $conn->prepare($q);
        $stmt->execute([$item, $variant, $shop]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            disconnect_db($conn);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => "Selected shop for selected variant already existed."]);
            break;
        }

        if (!in_array($email, $GLOBALS['contributor'])) {
            // Send email
            $body = "User: " . $email . "<br /><br />";
            $body .= "Item: " . $item . "<br /><br />";
            $body .= "Shop: " . $shop . "<br /><br />";
            $body .= "URL: " . $url . "<br /><br />";
            $body .= "Price: " . $price . "<br /><br />";
            $body .= "email: " . $email . "<br /><br />";
            $r = mailer("hensem@gmail.com", "mamat hensem", "Price || Add Item Shop", $body);
            if ($r["success"]) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'msg' => "Your submission will be review and updated. Thank you."]);
            } else {
                $shop_add_log_timestamp = date("Y-m-d H:i:s");
                if (isset($r["error"])) {
                    $shop_error_msg = $r["error"];
                } else {
                    $shop_error_msg = "Unknown error";
                }
                $q = "insert into `log` (`table`, `new_value`, `user`, `timestamp`) values (?, ?, ?, ?)";
                $stmt = $conn->prepare($q);
                $stmt->execute(['mailer', $shop_error_msg, $email, $shop_add_log_timestamp]);
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => "There were error submitting your info. Please try again later."]);
            }
        } else {
            // Insert
            $add_timestamp = date("Y-m-d H:i:s");
            $q = "insert into `item_shop` (`item`, `variant`, `shop`, `url`, `price`, `last_update`, `updated_by`) values (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($q);
            $stmt->execute([$item, $variant, $shop, $url, $price, $add_timestamp, $email]);

            $item_shop_id = $conn->lastInsertId();

            $body = "item_shop id: " . $item_shop_id;
            $r = mailer("hensem@gmail.com", "mamat hensem", "Price || Add Item Shop", $body);

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'msg' => "Thank you."]);
        }

        disconnect_db($conn);
        break;

    case '/item/add_variant':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            break;
        }

        checkAuth();
        verifyCSRF();

        $data = $_POST;
        $variant = trim($data['variant']);
        $item = $data['item'];
        $unit = $data['unit'];
        if (isset($data['email'])) {
            $email = $data['email'];
        } else {
            $email = $_SESSION['user_email_address'];
        }

        if (!$variant || !$item || !$unit) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Variant, item, and unit required']);
            break;
        }

        $conn = connect_db();

        // Check if exists
        $q = "select * from `variant` where `item` = ? and `name` = ?";
        $stmt = $conn->prepare($q);
        $stmt->execute([$item, $variant]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            disconnect_db($conn);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => "Variant already existed."]);
            break;
        }

        if (!in_array($email, $GLOBALS['contributor'])) {
            // Send email
            $body = "User: " . $email . "<br /><br />";
            $body .= "Item: " . $item . "<br /><br />";
            $body .= "Variant: " . $variant . "<br /><br />";
            $body .= "Total Unit: " . $unit . "<br /><br />";
            $r = mailer("hensem@gmail.com", "mamat hensem", "Price || Add Item Variant", $body);
            if ($r["success"]) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'msg' => "Your submission will be review and updated. Thank you."]);
            } else {
                $variant_log_timestamp = date("Y-m-d H:i:s");
                if (isset($r["error"])) {
                    $variant_error_message = $r["error"];
                } else {
                    $variant_error_message = "Unknown error";
                }
                $q = "insert into `log` (`table`, `new_value`, `user`, `timestamp`) values (?, ?, ?, ?)";
                $stmt = $conn->prepare($q);
                $stmt->execute(['mailer', $variant_error_message, $email, $variant_log_timestamp]);
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => "There were error submitting your info. Please try again later."]);
            }
        } else {
            // Insert
            $variant_timestamp = date("Y-m-d H:i:s");
            $q = "insert into `variant` (`name`, `item`, `unit`, `last_update`, `updated_by`) values (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($q);
            $stmt->execute([$variant, $item, $unit, $variant_timestamp, $email]);

            $variant_id = $conn->lastInsertId();

            $body = "variant id: " . $variant_id;
            $r = mailer("hensem@gmail.com", "mamat hensem", "Price || Add Item Variant", $body);

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'msg' => "Thank you."]);
        }

        disconnect_db($conn);
        break;

    case '/add_item':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            break;
        }

        checkAuth();
        verifyCSRF();

        $data = $_POST;
        $name = trim($data['name']);
        $variant = trim($data['variant']);
        $unit = $data['unit'];
        $total_unit = $data['total_unit'];
        $shop = $data['shop'];
        $url = trim($data['url']);
        $price = $data['price'];
        if (isset($data['email'])) {
            $email = $data['email'];
        } else {
            $email = $_SESSION['user_email_address'];
        }

        if (!$name || !$variant || !$unit || !$total_unit || !$shop || !$price) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'All fields required']);
            break;
        }

        $conn = connect_db();

        // Check if item exists
        $q = "select * from `item` where `name` = ?";
        $stmt = $conn->prepare($q);
        $stmt->execute([$name]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            disconnect_db($conn);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => "Item already exist."]);
            break;
        }

        if (!in_array($email, $GLOBALS['contributor'])) {
            // Send email
            $body = "User: " . $email . "<br /><br />";
            $body .= "name: " . $name . "<br /><br />";
            $body .= "variant: " . $variant . "<br /><br />";
            $body .= "unit: " . $unit . "<br /><br />";
            $body .= "total_unit: " . $total_unit . "<br /><br />";
            $body .= "shop: " . $shop . "<br /><br />";
            $body .= "url: " . $url . "<br /><br />";
            $body .= "price: " . $price . "<br /><br />";
            $body .= "email: " . $email . "<br /><br />";

            $r = mailer("hensem@gmail.com", "mamat hensem", "Price || New Item Submission", $body);
            if ($r["success"]) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'msg' => "Your submission will be review and updated. Thank you."]);
            } else {
                $item_log_timestamp = date("Y-m-d H:i:s");
                $item_error_message = isset($r["error"]) ? $r["error"] : "Unknown error";
                $q = "insert into `log` (`table`, `new_value`, `user`, `timestamp`) values (?, ?, ?, ?)";
                $stmt = $conn->prepare($q);
                $stmt->execute(['mailer', $item_error_message, $email, $item_log_timestamp]);
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => "There were error submitting your info. Please try again later."]);
            }
        } else {
            $item_timestamp = date("Y-m-d H:i:s");

            // Insert item
            $q = "insert into `item` (`name`, `unit`, `last_update`, `updated_by`) values (?, ?, ?, ?)";
            $stmt = $conn->prepare($q);
            $stmt->execute([$name, $unit, $item_timestamp, $email]);
            $item_id = $conn->lastInsertId();

            // Insert variant
            $q = "insert into `variant` (`name`, `item`, `unit`, `last_update`, `updated_by`) values (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($q);
            $stmt->execute([$variant, $item_id, $total_unit, $item_timestamp, $email]);
            $variant_id = $conn->lastInsertId();

            // Insert item_shop
            $q = "insert into `item_shop` (`item`, `variant`, `shop`, `url`, `price`, `last_update`, `updated_by`) values (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($q);
            $stmt->execute([$item_id, $variant_id, $shop, $url, $price, $item_timestamp, $email]);
            $item_shop_id = $conn->lastInsertId();

            $body = "item id: " . $item_id . "<br /><br />";
            $body .= "variant id: " . $variant_id . "<br /><br />";
            $body .= "item_shop id: " . $item_shop_id . "<br /><br />";

            $r = mailer("hensem@gmail.com", "mamat hensem", "Price || Add New Item", $body);

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'msg' => "Thank you."]);
        }

        disconnect_db($conn);
        break;

    case '/add_shop':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            break;
        }

        checkAuth();
        verifyCSRF();

        $data = $_POST;
        $name = trim($data['name']);
        $online = $data['online'];
        $url = trim($data['url']);
        if (isset($data['email'])) {
            $email = $data['email'];
        } else {
            $email = $_SESSION['user_email_address'];
        }

        if (!$name) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Shop name required']);
            break;
        }

        $online_val = ($online == 1) ? "No" : "Yes";
        $url_required = ($online == 1) ? 0 : 1;

        if ($online != 1 && !in_array($email, $GLOBALS['contributor']) && !$url) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'URL required']);
            break;
        }

        $conn = connect_db();

        // Check if exists
        $q = "select * from `shop` where `name` = ?";
        $stmt = $conn->prepare($q);
        $stmt->execute([$name]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            disconnect_db($conn);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => "Shop already existed."]);
            break;
        }

        if (!in_array($email, $GLOBALS['contributor'])) {
            // Send email
            $body = "Shop Name: " . $name . "<br /><br />";
            $body .= "Online Shop: " . $online_val . "<br /><br />";
            $body .= "Shop URL: " . $url . "<br /><br />";
            $body .= "Email: " . $email . "<br /><br />";

            $r = mailer("hensem@gmail.com", "mamat hensem", "Price || Add Shop", $body);
            if ($r["success"]) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'msg' => "Your submission will be review and updated. Thank you."]);
            } else {
                $unit_log_timestamp = date("Y-m-d H:i:s");
                $unit_error_message = isset($r["error"]) ? $r["error"] : "Unknown error";
                $q = "insert into `log` (`table`, `new_value`, `user`, `timestamp`) values (?, ?, ?, ?)";
                $stmt = $conn->prepare($q);
                $stmt->execute(['mailer', $unit_error_message, $email, $unit_log_timestamp]);
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => "There were error submitting your info. Please try again later."]);
            }
        } else {
            // Insert
            $shop_timestamp = date("Y-m-d H:i:s");
            $q = "insert into `shop` (`name`, `url`, `last_update`, `updated_by`) values (?, ?, ?, ?)";
            $stmt = $conn->prepare($q);
            $stmt->execute([$name, $url_required, $shop_timestamp, $email]);

            $shop_id = $conn->lastInsertId();

            $body = "shop id: " . $shop_id . "<br /><br />";
            $r = mailer("hensem@gmail.com", "mamat hensem", "Price || Add Shop", $body);

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'msg' => "Thank you."]);
        }

        disconnect_db($conn);
        break;

    case '/add_unit':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            break;
        }

        checkAuth();
        verifyCSRF();

        $data = $_POST;
        $name = trim($data['name']);
        if (isset($data['email'])) {
            $email = $data['email'];
        } else {
            $email = $_SESSION['user_email_address'];
        }

        if (!$name) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Unit name required']);
            break;
        }

        $conn = connect_db();

        // Check if exists
        $q = "select * from `unit` where `name` = ?";
        $stmt = $conn->prepare($q);
        $stmt->execute([$name]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            disconnect_db($conn);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => "Unit already existed."]);
            break;
        }

        if (!in_array($email, $GLOBALS['contributor'])) {
            // Send email
            $body = "Unit Name: " . $name . "<br /><br />";
            $body .= "Email: " . $email . "<br /><br />";

            $r = mailer("hensem@gmail.com", "mamat hensem", "Price || Add Unit", $body);
            if ($r["success"]) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'msg' => "Your submission will be review and updated. Thank you."]);
            } else {
                $unit_error_timestamp = date("Y-m-d H:i:s");
                $unit_error_message = isset($r["error"]) ? $r["error"] : "Unknown error";
                $q = "insert into `log` (`table`, `new_value`, `user`, `timestamp`) values (?, ?, ?, ?)";
                $stmt = $conn->prepare($q);
                $stmt->execute(['mailer', $unit_error_message, $email, $unit_error_timestamp]);
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => "There were error submitting your info. Please try again later."]);
            }
        } else {
            // Insert
            $unit_timestamp = date("Y-m-d H:i:s");
            $q = "insert into `unit` (`name`, `last_update`, `updated_by`) values (?, ?, ?)";
            $stmt = $conn->prepare($q);
            $stmt->execute([$name, $unit_timestamp, $email]);

            $unit_id = $conn->lastInsertId();

            $body = "unit id: " . $unit_id . "<br /><br />";
            $r = mailer("hensem@gmail.com", "mamat hensem", "Price || Add Unit", $body);

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'msg' => "Thank you."]);
        }

        disconnect_db($conn);
        break;

    case '/feedback':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            break;
        }

        checkAuth();
        verifyCSRF();

        $data = $_POST;
        $subject = trim($data['subject']);
        $message = nl2br(trim($data['message']));
        if (isset($data['email'])) {
            $email = $data['email'];
        } else {
            $email = $_SESSION['user_email_address'];
        }
        if (isset($data['user_name'])) {
            $user_name = $data['user_name'];
        } else {
            if (isset($_SESSION['user_first_name']) && isset($_SESSION['user_last_name'])) {
                $user_name = $_SESSION['user_first_name'] . " " . $_SESSION['user_last_name'];
            } else {
                $user_name = '';
            }
        }

        if (!$subject || !$message) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Subject and message required']);
            break;
        }

        $body = "User Email: " . $email . "<br /><br />";
        $body .= "User Name: " . $user_name . "<br /><br />";
        $body .= "Subject: " . $subject . "<br /><br />";
        $body .= "Message:<br />" . $message . "<br /><br />";

        $r = mailer("hensem@gmail.com", "mamat hensem", "Price || Feedback", $body);
        if ($r["success"]) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'msg' => "Thank you for your feedback."]);
        } else {
            $conn = connect_db();
            $feedback_timestamp = date("Y-m-d H:i:s");
            $feedback_error_message = isset($r["error"]) ? $r["error"] : "Unknown error";
            $q = "insert into `log` (`table`, `new_value`, `user`, `timestamp`) values (?, ?, ?, ?)";
            $stmt = $conn->prepare($q);
            $stmt->execute(['mailer', $feedback_error_message, $email, $feedback_timestamp]);
            disconnect_db($conn);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => "There were error submitting your info. Please try again later."]);
        }
        break;

    default:
        // Unknown endpoint - debug what url_param contains
        header('Content-Type: text/plain; charset=utf-8');
        echo "This is a private server. If you come here by mistake, go away";
        exit();
        break;
}
?>
