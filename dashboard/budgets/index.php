<?php
require_once '../../core/db_connect.php';
require_once '../../classes/class-budget.php';
require_once '../../helpers.php';
$conn = OpenCon();
session_start();

$current_user     = get_user( $conn, $_SESSION );
$all_budgets = get_all_budgets( $conn, $current_user['user_id'] );
$all_budgets = array_slice( $all_budgets, 0, 4 );


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
	<div class="budgets-wrapper archive">
		<div class="wrapper-top">
			<h2 class="accounts-title">Budgets</h2>
		</div>
		<div class="budgets-grid">
			<?php
			foreach ( $all_budgets as $budget ) {
				?>
				<div class="budget-item">
					<div class="budget-item-wrapper">
						<div class="budget-category">Category: <span class="item-info"><?php echo get_category_by_id( $conn, $budget['category_id'] )['name']; ?></span></div>
						<div class="budget-amount">Amount: <span class="item-info"><?php echo $budget['amount'] > 0 ? $budget['amount'] . '<span class="unit">RMB</span>': '0 <span class="unit">RMB</span> <span class="limit">Limit exceeded</span>'; ?> </span></div>
						<div class="budget-start">Start: <span class="item-info"><?php echo $budget['start_date']; ?></span></div>
						<div class="budget-end">End: <span class="item-info"><?php echo $budget['end_date']; ?></span></div>
						<div class="buttons">
							<a class="modify-item" href="../../core/modify-budget.php/?budget_id=<?php echo $budget['budget_id']; ?>">Modify</a>
							<a class="delete-item" href="../../core/delete-budget.php/?budget_id=<?php echo $budget['budget_id']; ?>">Delete</a>
						</div>
					</div>
				</div>
				<?php
			}
			?>
			<div class="add-new primary-button">Add new Budget</div>
		</div>

	</div>
</div>
<div class="overlay">
	<div class="inner">
		<?php
		require_once '../../templates/add-budget.php';
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