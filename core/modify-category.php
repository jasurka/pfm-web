<?php
require_once '../core/db_connect.php';
require_once '../helpers.php';
$conn = OpenCon();
session_start();

$category_id = isset( $_GET['category_id'] ) ? $_GET['category_id'] : 0;

if ( ! empty( $_POST['category_update'] ) ) {
	$result = modify_category( $conn, $_POST['new_category_name'], $category_id);

	if ( $result === true ) {
		header( 'Location: /dashboard/' );
	}
}
$category_data = get_category_by_id( $conn, $category_id );

?>

<h1>Modify Category</h1>
<form method="post">
	<div class="input-wrapper">
		<label for="new_category_name">Name</label>
		<input type="text" id="new_category_name" name="new_category_name" required value="<?php echo $category_data['name'] ?>">
	</div>
	<input type="submit" class="submit" name="category_update" value="Modify">
</form>
<a href="../dashboard/" class="archive">Return to dashboard</a>