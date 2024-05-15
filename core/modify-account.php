<?php
require_once '../core/db_connect.php';
require_once '../classes/class-account.php';
require_once '../helpers.php';
$conn = OpenCon();
session_start();

$account_id = isset( $_GET['account_id'] ) ? $_GET['account_id'] : 0;
$account_inst = new Account( $conn );

if ( ! empty( $_POST['account_update'] ) ) {
	$result = $account_inst->update( $account_id, $_POST['new_account_type'], $_POST['new_account_name'], $_POST['new_account_balance'] );

	if ( $result === true ) {
		header( 'Location: /dashboard/' );
	}
}
$account_data = $account_inst->load( $account_id );
$current_user = get_user( $conn, $_SESSION);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Personal Finance Manager - Accounts</title>
	<link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
<?php
require_once '../templates/header.php';
?>
<div class="container">
<h1>Modify Account</h1>
<form method="post" class="modify-form">
	<div class="input-wrapper">
		<label for="new_account_balance">Balance</label>
		<input type="number" id="new_account_balance" name="new_account_balance" required value="<?php echo $account_data['balance']; ?>">
	</div>
	<div class="input-wrapper">
		<label for="new_account_type">Account type</label>
		<input type="text" id="new_account_type" name="new_account_type" required value="<?php echo $account_data['account_type']; ?>">
	</div>
	<div class="input-wrapper">
		<label for="new_account_name">Account name</label>
		<input type="text" id="new_account_name" name="new_account_name" required value="<?php echo $account_data['name']; ?>">
	</div>
	<div class="hidden-input">
		<input type="hidden" name="accountuser" id="account_user" value="<?php echo $current_user['user_id']; ?>">
	</div>
	<input type="submit" class="submit primary-button" name="account_update" value="Modify">
</form>
<a href="/dashboard/" class="return-to-dash">Return to dashboard</a>
</div>
</body>
</html>