<?php
require_once 'db_connect.php';
require_once '../classes/class-transaction.php';
require_once '../helpers.php';

$conn = OpenCon();

if ( isset( $_POST['transaction_amount'] ) && isset( $_POST['transaction_date'] ) ) {
	$transaction             = new Transaction( $conn );
	$transaction->create( $_POST['transaction_account'], $_POST['transaction_date'], $_POST['transaction_amount'], $_POST['transaction_category'], $_POST['transaction_description'], $_POST['transaction_type'], $_POST['transaction_user'] );
	$current_account_balance = get_account_balance( $conn, $_POST['transaction_account'] );
	$current_budget_amount = get_budget_amount( $conn, $_POST['transaction_category'] );

	if ( $_POST['transaction_type'] === 'expense' ) {
		$current_account_balance['balance'] -= $_POST['transaction_amount'];
		$current_budget_amount['amount'] -= $_POST['transaction_amount'];
		update_account_balance( $conn, $_POST['transaction_account'], $current_account_balance['balance'] );
		update_budget_amount( $conn, $_POST['transaction_category'], $current_budget_amount['amount'] );
	} else {
		$current_account_balance['balance'] += $_POST['transaction_amount'];
		$current_budget_amount['amount'] += $_POST['transaction_amount'];
		update_account_balance( $conn, $_POST['transaction_account'], $current_account_balance['balance'] );
		update_budget_amount( $conn, $_POST['transaction_category'], $current_budget_amount['amount'] );
	}
	header( "Location: /dashboard/" );
}