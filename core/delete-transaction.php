<?php
require_once 'db_connect.php';
$conn = OpenCon();

if ( isset( $_GET['transaction_id'] ) ) {
	$transaction_id = $_GET['transaction_id'];
}

$delete_query = $conn->prepare("DELETE FROM Transactions WHERE transaction_id=?");

$delete_query->bind_param('i', $transaction_id);

$delete_result = $delete_query->execute();


header("Location: /dashboard/");