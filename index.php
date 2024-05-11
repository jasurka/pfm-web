<?php
session_start();

if ( isset( $_SESSION['logged_in'] ) && true === $_SESSION['logged_in'] ) {
	header( "Location: /dashboard" );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Personal Finance Manager - Login/Registration</title>
	<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<div class="container">
	<div class="form-container">
		<div class="form-header">
			<h1>Personal Finance Manager</h1>
		</div>
		<div class="form-content">
			<form id="login" class="form" method="post" action="login.php">
				<label for="username">Username:</label>
				<input type="text" id="username" name="username" required>
				<label for="password">Password:</label>
				<input type="password" id="password" name="password" required>
				<button type="submit">Login</button>
				<h2>Do not have account?</h2>
				<button onclick="openForm('register')">Register</button>
				<?php
				if ( isset( $_GET['register'] ) && 'success' === $_GET['register'] ) {
					?>
					<div class="registration-successful">
						Registration successful! Please login.
					</div>
					<?php
				}
				?>

			</form>
			<form id="register" class="form display-none" method="post" action="register.php">
				<label for="reg_username">Username:</label>
				<input type="text" id="reg_username" name="reg_username" required>
				<label for="reg_email">Email:</label>
				<input type="email" id="reg_email" name="reg_email" required>
				<label for="reg_password">Password:</label>
				<input type="password" id="reg_password" name="reg_password" required>
				<button type="submit">Register</button>
				<h2>Already have account?</h2>
				<button class="active" onclick="openForm('login')">Login</button>
			</form>
			<?php
			// Display error message (if any)
			if ( isset( $_SESSION['error_message'] ) ) {
				echo "<p class='error'>" . $_SESSION['error_message'] . "</p>";
				unset( $_SESSION['error_message'] );
			}
			?>
		</div>
	</div>
</div>
<script src="assets/js/scripts.js"></script>
</body>
</html>
