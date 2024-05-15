<?php
require_once '../../core/db_connect.php';
require_once '../../classes/class-account.php';
require_once '../../helpers.php';
$conn = OpenCon();
session_start();

if ( ! isset( $_SESSION['logged_in'] ) && true !== $_SESSION['logged_in'] ) {
	header( "Location: /" );
}

$categories       = get_categories( $conn );
$current_user     = get_user( $conn, $_SESSION );
$all_transactions = get_all_transactions( $conn, $current_user['user_id'] );
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Personal Finance Manager - Transactions</title>
	<link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
<?php
require_once '../../templates/header.php';
?>
<div class="container">
	<div class="transactions-wrapper">
		<div class="wrapper-top">
			<h2 class="transactions-title">Transactions</h2>
		</div>
		<div class="transactions-list archive">
			<?php
			foreach ( $all_transactions as $transaction ) {
				?>
				<div class="transaction-item">
					<div class="transaction-inner">
						<div class="transaction-amount <?php echo $transaction['type']; ?>"><?php echo $transaction['type'] === 'expense' ? '-' . $transaction['amount'] : '+' . $transaction['amount']; ?> <span class="unit">RMB</span></div>
						<div class="transaction-description"><?php echo $transaction['description']; ?></div>
						<div class="transaction-category"><?php echo get_category_by_id( $conn, $transaction['category_id'])['name']; ?></div>
						<div class="transaction-date"><?php echo $transaction['date']; ?></div>
					</div>
					<div class="buttons">
						<a class="modify-item" href="../../core/modify-transaction.php/?transaction_id=<?php echo $transaction['transaction_id']; ?>">Modify</a>
						<a class="delete-item" href="../../core/delete-transaction.php/?transaction_id=<?php echo $transaction['transaction_id']; ?>">Delete</a>
					</div>
				</div>
				<?php
			}
			?>
			<div class="add-new primary-button">Add new Transaction</div>
		</div>
	</div>
</div>
<div class="overlay">
	<div class="inner">
		<?php
		require_once '../../templates/add-transaction.php';
		?>
		<div class="close-button">x</div>
	</div>
</div>
<script>
    document.querySelector(".add-new").addEventListener('click', function(){
        document.querySelector(".overlay").classList.add("show");
    })
    document.querySelector(".close-button").addEventListener('click', function(){
        document.querySelector(".overlay").classList.remove("show");
    })
</script>
</body>
</html>