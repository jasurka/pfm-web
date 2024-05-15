<?php
require_once '../core/db_connect.php';
require_once '../classes/class-budget.php';
require_once '../helpers.php';
$conn = OpenCon();
session_start();

$budget_id = isset( $_GET['budget_id'] ) ? $_GET['budget_id'] : 0;
$budget_inst = new Budget( $conn );

if ( ! empty( $_POST['budget_update'] ) ) {
	$result = $budget_inst->update( $budget_id, $_POST['new_budget_category'], $_POST['new_budget_amount'], $_POST['new_budget_start_date'], $_POST['new_budget_end_date'] );

	if ( $result === true ) {
		header( 'Location: /dashboard/' );
	}
}
$budget_data = $budget_inst->load( $budget_id );
$categories = get_categories( $conn );
$current_user = get_user( $conn, $_SESSION);

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
require_once '../templates/header.php';
?>
<div class="container">
<h1>Modify Budget</h1>
<form method="post" class="modify-form">
	<div class="input-wrapper">
		<label for="new_budget_category">Category:</label>
		<select name="new_budget_category" id="new_budget_category">
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
		<label for="new_budget_amount">Amount:</label>
		<input type="number" id="new_budget_amount" name="new_budget_amount" required value="<?php echo $budget_data['amount']; ?>">
	</div>
	<div class="input-wrapper">
		<label for="new_budget_start_date">Start date:</label>
		<input type="date" id="new_budget_start_date" name="new_budget_start_date" required value="<?php echo $budget_data['start_date'];?>">
	</div>
	<div class="input-wrapper">
		<label for="new_budget_end_date">End date:</label>
		<input type="date" id="new_budget_end_date" name="new_budget_end_date" required value="<?php echo $budget_data['end_date'];?>">
	</div>
	<div class="hidden-input">
		<input type="hidden" name="budget_user" id="budget_user" value="<?php echo $current_user['user_id']; ?>">
	</div>
	<input type="submit" class="submit primary-button" name="budget_update" value="Modify">
</form>
	<a href="/dashboard/" class="return-to-dash">Return to dashboard</a>
</div>
</body>
</html>