<?php
require_once '../core/db_connect.php';
require_once '../classes/class-transaction.php';
$conn = OpenCon();
session_start();

$categories       = get_categories( $conn );
$current_user     = get_user( $conn, $_SESSION );
$all_transactions = get_all_transactions( $conn, $current_user['user_id'] );

?>
<div class="transactions-wrapper">
	<h2 class="transactions-title">All transactions</h2>
	<?php
	foreach ( $all_transactions as $transaction ) {
		?>
		<div class="transaction-item"><?php echo $transaction['amount']; ?>
			<a class="modify-item" href="../core/modify-transaction.php/?transaction_id=<?php echo $transaction['transaction_id']; ?>">Modify</a>
			<a class="delete-item" href="../core/delete-transaction.php/?transaction_id=<?php echo $transaction['transaction_id']; ?>">Delete</a>
		</div>
		<?php
	}
	?>
</div>
