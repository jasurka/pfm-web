<?php
require_once '../core/db_connect.php';
require_once '../classes/class-budget.php';
$conn = OpenCon();
session_start();

$current_user     = get_user( $conn, $_SESSION );
$all_budgets = get_all_budgets( $conn, $current_user['user_id'] );


?>
<div class="budgets-wrapper">
	<h2 class="budgets-title">All budgets</h2>
	<?php
	foreach ( $all_budgets as $budget ) {
		?>
		<div class="budget-item"><?php echo $budget['amount']; ?>
			<div class="budget-category"><?php echo get_category_by_id( $conn, $budget['category_id'] )['name']; ?></div>
			<a class="modify-item" href="../core/modify-budget.php/?budget_id=<?php echo $budget['budget_id']; ?>">Modify</a>
			<a class="delete-item" href="../core/delete-budget.php/?budget_id=<?php echo $budget['budget_id']; ?>">Delete</a>
		</div>
		<?php
	}
	?>
</div>
