<?php
require_once '../core/db_connect.php';
require_once '../helpers.php';
$conn = OpenCon();
session_start();

$category_id = isset( $_GET['category_id'] ) ? $_GET['category_id'] : 0;

if ( ! empty( $_POST['category_update'] ) ) {
	$result = modify_category( $conn, $_POST['new_category_name'], $category_id );

	if ( $result === true ) {
		header( 'Location: /dashboard/' );
	}
}
$category_data = get_category_by_id( $conn, $category_id );

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
	<h1>Modify Category</h1>
	<form method="post" class="modify-form">
		<div class="input-wrapper">
			<label for="new_category_name">Name</label>
			<input type="text" id="new_category_name" name="new_category_name" required value="<?php echo $category_data['name'] ?>">
		</div>
		<input type="submit" class="submit primary-button" name="category_update" value="Modify">
	</form>
	<a href="/dashboard/" class="return-to-dash">Return to dashboard</a>
</div>
</body>
</html>