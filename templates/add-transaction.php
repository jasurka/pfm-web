<?php
require_once '../core/db_connect.php';
require_once '../classes/class-account.php';
require_once '../helpers.php';
$conn = OpenCon();
session_start();

$categories = get_categories( $conn );
$current_user = get_user( $conn, $_SESSION);
$accounts = get_accounts( $conn, $current_user['user_id']);

?>

<h1>Add Transaction</h1>
<form action="../core/transaction.php" method="post">
	<div class="input-wrapper">
		<label for="transaction_amount">Amount:</label>
		<input type="number" id="transaction_amount" name="transaction_amount" required>
	</div>
	<div class="input-wrapper">
		<label for="transaction_category">Category:</label>
		<select name="transaction_category" id="transaction_category">
			<?php
			foreach ( $categories as $category ) {
				?>
				<option value="<?php echo $category['category_id']; ?>"><?php echo $category['name'] ?></option>
				<?php
			}
			?>
		</select>
	</div>
	<div class="input-wrapper">
		<label for="transaction_account">Account:</label>
		<select name="transaction_account" id="transaction_account">
			<?php
			foreach ( $accounts as $account ) {
				?>
				<option value="<?php echo $account->get_id(); ?>"><?php echo $account->get_name(); ?></option>
				<?php
			}
			?>
		</select>
	</div>
	<div class="input-wrapper">
		<label for="transaction_date">Date:</label>
		<input type="date" id="transaction_date" name="transaction_date" required>
	</div>
	<div class="input-wrapper">
		<label for="transaction_description">Description:</label>
		<textarea name="transaction_description" id="transaction_description" cols="30" rows="10"></textarea>
	</div>
	<div class="input-wrapper">
		<label for="transaction_type">Transaction type:</label>
		<select name="transaction_type" id="transaction_type">
			<option value="expense">Expense</option>
			<option value="income">Income</option>
		</select>
	</div>
	<div class="hidden-input">
		<input type="hidden" name="transaction_user" id="transaction_user" value="<?php echo $current_user['user_id']; ?>">
	</div>
	<button type="submit">Add Transaction</button>
</form>