<?php
require_once '../core/db_connect.php';
require_once '../helpers.php';
$conn = OpenCon();
session_start();

if ( ! isset( $_SESSION['logged_in'] ) && true !== $_SESSION['logged_in'] ) {
	header( "Location: /" );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Personal Finance Manager - Dashboard</title>
	<link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<?php
require_once '../templates/header.php';
?>
<div class="container">
	<div class="first-row">
		<?php
		require_once '../templates/all-accounts.php';
		require_once '../templates/all-budgets.php';
		?>
	</div>
	<?php
	require_once '../templates/all-transactions.php';
	?>
</div>

</body>