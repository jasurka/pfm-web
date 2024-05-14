<?php
require_once '../core/db_connect.php';
require_once '../helpers.php';
$conn = OpenCon();

$categories = get_categories( $conn );
?>
<div class="categories-wrapper">
	<h2 class="categories-title">All categories</h2>
	<?php
	foreach ( $categories as $category ) {
		?>
		<div class="category-item"><?php echo $category['name']; ?>
			<a class="modify-item" href="../core/modify-category.php/?category_id=<?php echo $category['category_id']; ?>">Modify</a>
			<a class="delete-item" href="../core/delete-category.php/?category_id=<?php echo $category['category_id']; ?>">Delete</a>
		</div>
		<?php
	}
	?>
</div>