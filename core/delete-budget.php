<?php
require_once 'db_connect.php';
$conn = OpenCon();

if ( isset( $_GET['budget_id'] ) ) {
	$budget_id = $_GET['budget_id'];
}

$delete_query = $conn->prepare("DELETE FROM Budgets WHERE budget_id=?");

$delete_query->bind_param('i', $budget_id);

$delete_result = $delete_query->execute();

header("Location: /dashboard/");