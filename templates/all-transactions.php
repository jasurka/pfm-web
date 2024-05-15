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
	<div class="wrapper-top">
		<h2 class="transactions-title">Transactions</h2>
		<a href="/dashboard/transactions/" class="wrapper-all">View All</a>
	</div>

	<div class="transactions-list">
		<?php
		foreach ( $all_transactions as $transaction ) {
			?>
			<div class="transaction-item">
				<div class="transaction-inner">
					<div class="transaction-amount <?php echo $transaction['type']; ?>"><?php echo $transaction['type'] === 'expense' ? '-' . $transaction['amount'] : '+' . $transaction['amount']; ?> <span class="unit">RMB</span></div>
					<div class="transaction-description"><?php echo $transaction['description']; ?></div>
					<div class="transaction-category"><?php echo get_category_by_id($conn, $transaction['category_id'])['name']; ?></div>
					<div class="transaction-date"><?php echo $transaction['date']; ?></div>
				</div>
				<div class="buttons">
					<a class="modify-item" href="../core/modify-transaction.php/?transaction_id=<?php echo $transaction['transaction_id']; ?>">Modify</a>
					<a class="delete-item" href="../core/delete-transaction.php/?transaction_id=<?php echo $transaction['transaction_id']; ?>">Delete</a>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</div>
