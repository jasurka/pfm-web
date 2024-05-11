<?php
require_once 'core/db_connect.php';

$conn = OpenCon();

if ( ! $conn ) {
	die( "Connection failed: " . mysqli_connect_error() );
}

// If registration form is submitted
if ( isset( $_POST['reg_username'] ) && isset( $_POST['reg_email'] ) && isset( $_POST['reg_password'] ) ) {
	$username = mysqli_real_escape_string( $conn, $_POST['reg_username'] );
	$email    = mysqli_real_escape_string( $conn, $_POST['reg_email'] );
	$password = mysqli_real_escape_string( $conn, $_POST['reg_password'] );

	// Hash password before storing
	$hashed_password = password_hash( $password, PASSWORD_DEFAULT );

	// Check if username or email already exists
	$sql_check    = "SELECT * FROM users WHERE username='$username' OR email='$email'";
	$result_check = mysqli_query( $conn, $sql_check );

	if ( mysqli_num_rows( $result_check ) > 0 ) {
		// Username or email already exists
		$_SESSION['error_message'] = "Username or email already exists";
	} else {
		// Insert new user data
		$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
		if ( mysqli_query( $conn, $sql ) ) {
			// Registration successful
			header( "Location: /?register=success" );
		} else {
			// Registration failed
			$_SESSION['error_message'] = "Registration failed: " . mysqli_error( $conn );
		}
	}
}

// Close connection
mysqli_close( $conn );
