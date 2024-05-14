<?php
require_once 'db_connect.php';
$conn = OpenCon();

if ( isset( $_GET['account_id'] ) ) {
	$account_id = $_GET['account_id'];
}

$delete_query = $conn->prepare("DELETE FROM Accounts WHERE account_id=?");

$delete_query->bind_param('i', $account_id);

$delete_result = $delete_query->execute();

header("Location: /dashboard/");