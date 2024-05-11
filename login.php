<?php
require_once 'core/db_connect.php';
session_start();
$conn = OpenCon();

if ( ! $conn ) {
	die( "Connection failed: " . mysqli_connect_error() );
}

if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
	$username = mysqli_real_escape_string( $conn, $_POST['username'] );
	$password = mysqli_real_escape_string( $conn, $_POST['password'] );

	// SQL query to fetch user data
	$sql    = "SELECT * FROM users WHERE username='$username'";
	$result = mysqli_query( $conn, $sql );

	if ( mysqli_num_rows( $result ) > 0 ) {
		$row = mysqli_fetch_assoc( $result );

		// Verify password using password_verify
		if ( password_verify( $password, $row['password'] ) ) {
			// Login successful
			$_SESSION['logged_in'] = true;
			$_SESSION['username']  = $username;
			header( "Location: /" );
		} else {
			// Invalid password
			$_SESSION['error_message'] = "Invalid username or password";
		}
	} else {
		// Username not found
		$_SESSION['error_message'] = "Invalid username or password";
	}
}

// Close connection
mysqli_close( $conn );