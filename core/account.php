<?php
require_once 'db_connect.php';
require_once '../classes/class-account.php';

$conn = OpenCon();

if ( isset( $_POST['account_balance'] ) ) {
	$budget             = new Account( $conn );
	$budget->create( $_POST['account_user'], $_POST['account_type'], $_POST['account_name'], $_POST['account_balance'] );
	header( "Location: /dashboard/" );
}