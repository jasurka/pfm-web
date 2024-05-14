<?php
require_once 'db_connect.php';
require_once '../classes/class-budget.php';

$conn = OpenCon();

if ( isset( $_POST['budget_amount'] ) ) {
	$budget             = new Budget( $conn );
	$budget->create( $_POST['budget_user'], $_POST['budget_category'], $_POST['budget_amount'], $_POST['budget_start_date'], $_POST['budget_end_date'] );
	header( "Location: /dashboard/" );
}