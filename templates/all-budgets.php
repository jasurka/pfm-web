<?php
require_once '../core/db_connect.php';
require_once '../classes/class-budget.php';
$conn = OpenCon();
session_start();

$current_user     = get_user( $conn, $_SESSION );
$all_budgets = get_all_budgets( $conn, $current_user['user_id'] );
$all_budgets = array_slice( $all_budgets, 0, 4 );


?>
<div class="budgets-wrapper">
	<div class="wrapper-top">
		<h2 class="accounts-title">Budgets</h2>
		<a href="/dashboard/budgets/" class="wrapper-all">View All</a>
	</div>
	<?php
	foreach ( $all_budgets as $budget ) {
		?>
		<div class="budget-item">
			<div class="budget-item-wrapper">
				<div class="budget-category">Category: <span class="item-info"><?php echo get_category_by_id( $conn, $budget['category_id'] )['name']; ?></span></div>
				<div class="budget-amount">Amount: <span class="item-info"><?php echo $budget['amount'] > 0 ? $budget['amount'] . ' <span class="unit">RMB</span>': '0 <span class="unit">RMB</span> <span class="limit">Limit exceeded</span>'; ?> </span></div>
				<div class="budget-start">Start: <span class="item-info"><?php echo $budget['start_date']; ?></span></div>
				<div class="budget-end">End: <span class="item-info"><?php echo $budget['end_date']; ?></span></div>
				<div class="buttons">
					<a class="modify-item" href="../core/modify-budget.php/?budget_id=<?php echo $budget['budget_id']; ?>">Modify</a>
					<a class="delete-item" href="../core/delete-budget.php/?budget_id=<?php echo $budget['budget_id']; ?>">Delete</a>
				</div>
			</div>


		</div>
		<?php
	}
	?>
</div>
