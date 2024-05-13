<?php
require_once 'db_connect.php';
require_once '../classes/class-account.php';
require_once '../classes/class-transaction.php';
require_once '../helpers.php';

$conn = OpenCon();
session_start();


$transaction_id = isset( $_GET['transaction_id'] ) ? $_GET['transaction_id'] : 0;
$transaction_inst = new Transaction( $conn );

if ( ! empty( $_POST['transaction_update'] ) ) {
	$result = $transaction_inst->update( $transaction_id, $_POST['new_transaction_amount'], $_POST['new_transaction_category'], $_POST['new_transaction_account'], $_POST['new_transaction_date'], $_POST['new_transaction_description'] );

	if ( $result === true ) {
		header( 'Location: /dashboard/' );
	}
}

$transaction_data = $transaction_inst->load( $transaction_id );
$categories = get_categories( $conn );
$current_user = get_user( $conn, $_SESSION);
$accounts = get_accounts( $conn, $current_user['user_id']);

?>
<form method="post">
	<div class="input-wrapper">
		<label for="new_transaction_amount">Amount:</label>
		<input type="number" id="new_transaction_amount" name="new_transaction_amount" required value="<?php echo $transaction_data['amount']; ?>">
	</div>
	<div class="input-wrapper">
		<label for="new_transaction_category">Category:</label>
		<select name="new_transaction_category" id="new_transaction_category">
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
		<label for="new_transaction_account">Account:</label>
		<select name="new_transaction_account" id="new_transaction_account">
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
		<label for="new_transaction_date">Date:</label>
		<input type="date" id="new_transaction_date" name="new_transaction_date" required value="<?php echo $transaction_data['date']; ?>">
	</div>
	<div class="input-wrapper">
		<label for="new_transaction_description">Description:</label>
		<textarea name="new_transaction_description" id="new_transaction_description" cols="30" rows="10"><?php echo $transaction_data['description']; ?></textarea>
	</div>
	<div class="input-wrapper">
		<label for="new_transaction_type">Transaction type:</label>
		<select name="new_transaction_type" id="new_transaction_type" disabled>
			<option value="<?php echo $transaction_data['type']; ?>"><?php echo $transaction_data['type']; ?></option>
		</select>
	</div>
	<div class="hidden-input">
		<input type="hidden" name="transaction_user" id="transaction_user" value="<?php echo $current_user['user_id']; ?>">
	</div>
	<input type="submit" class="submit" name="transaction_update" value="Modify">
</form>
<a href="../dashboard/" class="archive">Return to dashboard</a>
