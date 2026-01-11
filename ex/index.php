<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Asia/Kuala_Lumpur');

$db_path = "../../../config/price.db";

function connect_db() {
	global $db_path;
	$conn = new PDO('sqlite:' . $db_path);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $conn;
}

function disconnect_db($conn) {
	$conn = null;
}

$conn = connect_db();

$min_cal = 100;
$max_stage = 14;

$recs = array();

$q = "select * from t order by id desc limit 1";
$r = $conn->query($q);
$row = $r->fetch(PDO::FETCH_ASSOC);
$last_date = date_create($row['date']);
$today = date_create(date('Y-m-d'));
$diff=date_diff($last_date,$today);
$diff = $diff->format("%r%a");

if ((isset($_POST['s'])) || ($diff == 0)) {
	$limit = "";
} else {
	$limit = " limit 10";
}

$q = "select * from t order by id desc".$limit;
$r = $conn->query($q);
while ($row = $r->fetch(PDO::FETCH_ASSOC)) {
	$recs[] = $row;
}

if ($diff == 0) {
	$new_cal = $recs[0]['cal'];
	$stage = $recs[0]['stage'];
	$recovery = $recs[0]['recovery'];
} else {
	if ($diff == 1) {
		$new_cal = $recs[0]['cal'] * 1.01; //up
	} else {
		$new_cal = $recs[0]['cal'];
		for ($j = 1; $j <= $diff; $j++) {
			$new_cal = $new_cal * 0.99; //down
			if ($new_cal <= $min_cal) {
				$new_cal = $min_cal;
				break;
			}
		}
	}
	$stage = $recs[0]['stage'] + 1;
	$recovery = '';
}

if ($stage > $max_stage) {
	$stage = 1;
}

if (isset($_POST['s'])) {
	$pushup = $_POST["p"];
	$situp = $_POST["s"];
	$recovery = $_POST["r"];
	$q2 = "insert into t (date, cal, stage, recovery, pushup, situp) values ('".date('Y-m-d')."', '".$new_cal."', '".$stage."', '".$recovery."', '".$pushup."', '".$situp."')";
	try {
		$r2 = $conn->query($q2);
		$diff = 0;
	} catch (PDOException $e) {
		echo "SQL: " . $q2;
		echo "<br />";
		echo $e->getMessage();
		exit;
	}
}

if ($recovery <= 1.5) {
	$color = "#00ff00";
} else if ($recovery <= 2.5) {
	$color = "#33cc00";
} else if ($recovery <= 3.5) {
	$color = "#669900";
} else if ($recovery <= 4.5) {
	$color = "#996600";
} else if ($recovery <= 5.5) {
	$color = "#cc3300";
} else if ($recovery > 5.5) {
	$color = "#ff0000";
} else {
	$color = "#000000";
}

?>
<table border="1">
	<tr>
		<th>Date</th>
		<th>Cal</th>
		<th>stage</th>
		<th>push up</th>
		<th>sit up</th>
		<th>recovery</th>
	</tr>
	<tr>
		<td><h1><?php echo date('Y-m-d'); ?></h1></td>
		<td><h1><?php echo number_format($new_cal, 1); ?></h1></td>
		<td><h1><?php echo $stage; ?></h1></td>
			<td><?php echo $recs[0]['pushup']; ?></td>
			<td><?php echo $recs[0]['situp']; ?></td>
		<td><h1><font color="<?php echo $color; ?>"><?php echo $recovery; ?></font></h1></td>
	</tr>
	<?php
	for ($j = 0; $j < count($recs); $j++) {
		if ($recs[$j]['recovery'] <= 1.5) {
			$color = "#00ff00";
		} else if ($recs[$j]['recovery'] <= 2.5) {
			$color = "#33cc00";
		} else if ($recs[$j]['recovery'] <= 3.5) {
			$color = "#669900";
		} else if ($recs[$j]['recovery'] <= 4.5) {
			$color = "#996600";
		} else if ($recs[$j]['recovery'] <= 5.5) {
			$color = "#cc3300";
		} else if ($recs[$j]['recovery'] > 5.5) {
			$color = "#ff0000";
		} else {
			$color = "#000000";
		}
		?>
		<tr>
			<td><?php echo $recs[$j]['date']; ?></td>
			<td><?php echo $recs[$j]['cal']; ?></td>
			<td><?php echo $recs[$j]['stage']; ?></td>
			<td><?php echo $recs[$j]['pushup']; ?></td>
			<td><?php echo $recs[$j]['situp']; ?></td>
			<td><font color="<?php echo $color; ?>"><?php echo $recs[$j]['recovery']; ?></font></td>
		</tr>
		<?php
	}
	?>
</table>
<?php
if ($diff != 0) {
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<input type="hidden" name="s", value="a" />
		<br />
		Push up: <input type="text" name="p" value="0"/><br /><br />
		Sit up: <input type="text" name="s" value="0" /><br /><br />	
		Recovery: <input type="text" name="r" value="0.0" /><br /><br />
		<input type="submit" />
	</form>
	<?php
}
?>