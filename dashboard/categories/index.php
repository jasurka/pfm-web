<?php
require_once '../../core/db_connect.php';
require_once '../../classes/class-account.php';
require_once '../../helpers.php';
$conn = OpenCon();
session_start();

if ( ! isset( $_SESSION['logged_in'] ) && true !== $_SESSION['logged_in'] ) {
	header( "Location: /" );
}

$categories       = get_categories( $conn );
$current_user     = get_user( $conn, $_SESSION );
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Personal Finance Manager - Categories</title>
	<link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
<?php
require_once '../../templates/header.php';
?>
<div class="container">
	<div class="categories-wrapper">
		<div class="wrapper-top">
			<h2 class="transactions-title">All Categories</h2>
		</div>
		<div class="categories-inner">
			<ul class="categories-list">
				<?php
				foreach ( $categories as $category ) {
					?>
					<div class="category-item">
						<div class="category-name">
							<?php echo $category['name']; ?>
						</div>
						<div class="buttons">
							<a class="modify-item" href="../../core/modify-category.php/?category_id=<?php echo $category['category_id']; ?>">Modify</a>
							<a class="delete-item" href="../../core/delete-category.php/?category_id=<?php echo $category['category_id']; ?>">Delete</a>
						</div>
					</div>
					<?php
				}
				?>
			</ul>
			<?php
			require_once '../../templates/add-category.php'
			?>
		</div>

	</div>
</div>
</body>
</html>