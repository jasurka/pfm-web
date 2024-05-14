<?php

function get_categories( $conn ) {
	$sql_categories = "SELECT * FROM Categories";

	$result_categories = mysqli_query( $conn, $sql_categories );

	if ( $result_categories->num_rows > 0 ) {
		$categories = array();
		while ( $row = $result_categories->fetch_assoc() ) {
			$categories[] = $row;
		}
	}

	return $categories;
}
function get_category_by_id( $conn, $category_id ) {
	$sql_categories = "SELECT * FROM Categories WHERE category_id=?";

	$stmt = $conn->prepare( $sql_categories );
	$stmt->bind_param( 'i', $category_id );
	$stmt->execute();
	$result   = $stmt->get_result();

	$category = $result->fetch_assoc();

	return $category;
}
function add_new_category( $conn, $name ) {
	$sql_categories = "INSERT INTO Categories (name) 
              VALUES (?)";

	$stmt = $conn->prepare( $sql_categories );
	$stmt->bind_param( 's', $name );
	$stmt->execute();
	$stmt->close();
}
function modify_category( $conn, $name, $category_id ) {
	$sql  = "UPDATE Categories SET name=?  WHERE category_id=?";
	$stmt = $conn->prepare( $sql );
	$stmt->bind_param( 'si', $name, $category_id );
	$result = $stmt->execute();
	$stmt->close();
	return $result;
}

function get_accounts( $conn, $user_id ) {
	$sql  = "SELECT * FROM Accounts WHERE user_id=?";
	$stmt = $conn->prepare( $sql );
	$stmt->bind_param( 'i', $user_id );
	$stmt->execute();
	$result   = $stmt->get_result();
	$accounts = array();

	while ( $account_data = $result->fetch_assoc() ) {
		$account    = new Account( $account_data['account_id'], $account_data['user_id'], $account_data['account_type'], $account_data['name'], $account_data['balance'] );
		$accounts[] = $account;
	}

	$stmt->close();

	return $accounts;
}

function get_user( $conn, $session ) {
	if ( isset( $session['logged_in'] ) && $session['logged_in'] ) {
		$username = $session['username'];
		$sql      = "SELECT * FROM Users WHERE username='$username'";
		$result   = mysqli_query( $conn, $sql );

		if ( $result->num_rows == 1 ) {
			$user_data = $result->fetch_assoc();
		}
	}

	return $user_data;
}

function update_account_balance( $conn, $id, $new_value ) {
	$sql  = "UPDATE Accounts SET balance=? WHERE account_id=?";
	$stmt = $conn->prepare( $sql );
	$stmt->bind_param( 'di', $new_value, $id );
	$stmt->execute();
	$stmt->close();
}

function get_account_balance( $conn, $account_id ) {
	$sql  = "SELECT * FROM Accounts WHERE account_id=?";
	$stmt = $conn->prepare( $sql );
	$stmt->bind_param( 'i', $account_id );
	$stmt->execute();
	$result   = $stmt->get_result();
	$account = $result->fetch_assoc();

	$stmt->close();

	return $account;
}

function get_all_transactions( $conn, $user_id ) {
	$sql  = "SELECT * FROM Transactions WHERE user_id='$user_id'";
	$stmt = $conn->prepare( $sql );

	$stmt->execute();
	$result       = $stmt->get_result();
	$transactions = array();

	while ( $transactionData = $result->fetch_assoc() ) {
		$transactions[] = $transactionData;
	}

	$stmt->close();

	return $transactions;
}
function get_all_budgets( $conn, $user_id ) {
	$sql  = "SELECT * FROM Budgets WHERE user_id='$user_id'";
	$stmt = $conn->prepare( $sql );

	$stmt->execute();
	$result       = $stmt->get_result();
	$budgets = array();

	while ( $budgetData = $result->fetch_assoc() ) {
		$budgets[] = $budgetData;
	}

	$stmt->close();

	return $budgets;
}
function get_all_accounts( $conn, $user_id ) {
	$sql  = "SELECT * FROM Accounts WHERE user_id='$user_id'";
	$stmt = $conn->prepare( $sql );

	$stmt->execute();
	$result       = $stmt->get_result();
	$accounts = array();

	while ( $accountData = $result->fetch_assoc() ) {
		$accounts[] = $accountData;
	}

	$stmt->close();

	return $accounts;
}