<?php
require_once '../core/db_connect.php';
require_once '../classes/class-account.php';
$conn = OpenCon();
session_start();

$current_user     = get_user( $conn, $_SESSION );
$all_accounts = get_all_accounts( $conn, $current_user['user_id'] );
$all_accounts = array_slice($all_accounts, 0, 4);
?>
<div class="accounts-wrapper">
	<div class="wrapper-top">
		<h2 class="accounts-title">Accounts</h2>
		<a href="/dashboard/accounts/" class="wrapper-all">View All</a>
	</div>
	<div class="accounts-grid">
		<?php
		foreach ( $all_accounts as $account ) {
			?>
			<div class="account-item">
				<div class="account-item-wrapper">
					<div class="account-type">Type: <span class="item-info"><?php echo $account['account_type']; ?></span></div>
					<div class="account-name">Name: <span class="item-info"><?php echo $account['name']; ?></span></div>
					<div class="account-balance">Balance: <span class="item-info"><?php echo $account['balance']; ?> <span class="unit">RMB</span></span></div>
					<div class="buttons">
						<a class="modify-item" href="../core/modify-account.php/?account_id=<?php echo $account['account_id']; ?>">Modify</a>
						<a class="delete-item" href="../core/delete-account.php/?account_id=<?php echo $account['account_id']; ?>">Delete</a>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</div>
