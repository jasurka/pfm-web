<?php
$conn = OpenCon();
session_start();

$categories = get_categories( $conn );
$current_user = get_user( $conn, $_SESSION);

?>

<h1>Add Budget</h1>
<form action="../../core/budget.php" method="post">
	<div class="input-wrapper">
		<label for="budget_category">Category:</label>
		<select name="budget_category" id="budget_category">
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
		<label for="budget_amount">Amount:</label>
		<input type="number" id="budget_amount" name="budget_amount" required>
	</div>
	<div class="input-wrapper">
		<label for="budget_start_date">Start date:</label>
		<input type="date" id="budget_start_date" name="budget_start_date" required>
	</div>
	<div class="input-wrapper">
		<label for="budget_end_date">End date:</label>
		<input type="date" id="budget_end_date" name="budget_end_date" required>
	</div>
	<div class="hidden-input">
		<input type="hidden" name="budget_user" id="budget_user" value="<?php echo $current_user['user_id']; ?>">
	</div>
	<button type="submit" class="primary-button">Add Budget</button>
</form>