<?php
require_once '../core/db_connect.php';
require_once '../classes/class-account.php';
$conn = OpenCon();
session_start();

$current_user     = get_user( $conn, $_SESSION );
$all_accounts = get_all_accounts( $conn, $current_user['user_id'] );


?>
<div class="accounts-wrapper">
	<h2 class="accounts-title">All accounts</h2>
	<?php
	foreach ( $all_accounts as $account ) {
		?>
		<div class="account-item">
			<div class="account-type"><?php echo $account['account_type']; ?></div>
			<div class="account-name"><?php echo $account['name']; ?></div>
			<div class="account-balance"><?php echo $account['balance']; ?></div>
			<a class="modify-item" href="../core/modify-account.php/?account_id=<?php echo $account['account_id']; ?>">Modify</a>
			<a class="delete-item" href="../core/delete-account.php/?account_id=<?php echo $account['account_id']; ?>">Delete</a>
		</div>
		<?php
	}
	?>
</div>
