<?php
require_once 'db_connect.php';
$conn = OpenCon();

if ( isset( $_GET['category_id'] ) ) {
	$category_id = $_GET['category_id'];
}

$delete_query = $conn->prepare("DELETE FROM Categories WHERE category_id=?");

$delete_query->bind_param('i', $category_id);

$delete_result = $delete_query->execute();

header("Location: /dashboard/");