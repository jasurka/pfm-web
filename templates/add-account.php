<?php
require_once '../core/db_connect.php';
require_once '../helpers.php';
$conn = OpenCon();
session_start();

$current_user = get_user( $conn, $_SESSION);

?>

<h1>Add Account</h1>
<form action="../core/account.php" method="post">
	<div class="input-wrapper">
		<label for="account_balance">Balance</label>
		<input type="number" id="account_balance" name="account_balance" required>
	</div>
	<div class="input-wrapper">
		<label for="account_type">Account type</label>
		<input type="text" id="account_type" name="account_type" required>
	</div>
	<div class="input-wrapper">
		<label for="account_name">Account name</label>
		<input type="text" id="account_name" name="account_name" required>
	</div>
	<div class="hidden-input">
		<input type="hidden" name="accountuser" id="account_user" value="<?php echo $current_user['user_id']; ?>">
	</div>
	<button type="submit">Add Account</button>
</form>