<?php
require_once '../../core/db_connect.php';
require_once '../../classes/class-account.php';
require_once '../../helpers.php';
$conn = OpenCon();
session_start();

if ( ! isset( $_SESSION['logged_in'] ) && true !== $_SESSION['logged_in'] ) {
	header( "Location: /" );
}

$current_user     = get_user( $conn, $_SESSION );
$all_accounts = get_all_accounts( $conn, $current_user['user_id'] );
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
require_once '../../templates/header.php';
?>
<div class="container">
	<div class="accounts-wrapper archive">
		<div class="wrapper-top">
			<h2 class="accounts-title">Accounts</h2>
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
							<a class="modify-item" href="../../core/modify-account.php/?account_id=<?php echo $account['account_id']; ?>">Modify</a>
							<a class="delete-item" href="../../core/delete-account.php/?account_id=<?php echo $account['account_id']; ?>">Delete</a>
						</div>
					</div>
				</div>
				<?php
			}
			?>
			<div class="add-new primary-button">Add new Account</div>
		</div>
	</div>
</div>
<div class="overlay">
	<div class="inner">
		<?php
		require_once '../../templates/add-account.php';
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