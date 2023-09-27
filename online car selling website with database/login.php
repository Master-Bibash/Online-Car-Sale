<?php
	// Establish database connection
	$db_username = "root";
	$db_password = "";
	$server = 'localhost';
	$db = 'mycar';
	
	$con = mysqli_connect($server, $db_username, $db_password, $db);

	$form_username = $form_password = "";
	$username_err = $password_err = "";

	// Processing form data when form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Validate username and password
		if (empty(trim($_POST["username"]))) {
			$username_err = "Please enter a username.";
		} else {
			$form_username = trim($_POST["username"]);
		}

		if (empty(trim($_POST["password"]))) {
			$password_err = "Please enter a password.";
		} else {
			$form_password = trim($_POST["password"]);
		}

		if (empty($username_err) && empty($password_err)) {
			// Prepare a select statement
			$sql = "SELECT seller_id FROM seller WHERE username = ? and password = ?";
			$stmt = $con->prepare($sql);
			$stmt->bind_param("ss", $form_username, $form_password);
			$stmt->execute();

			$stmt->store_result();

			if ($stmt->num_rows == 1) {
				$stmt->bind_result($id);
				if ($stmt->fetch()) {
					session_start();
					$_SESSION["seller_id"] = $id;
					header('location: seller.php'); // Redirect to home.php or any desired page
					exit();
				}
			} else {
				echo '<script>alert("Wrong password");</script>';
			}

			$stmt->close();
		}
		$con->close();
	}
?>





<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="script.js"></script>


	<style>
		.mainContainer {
			margin-top: 20px;

		}

		main {
			/* border: solid red 2px; */
			background: #bbb4b4b5;
			border-radius: 15px;
		}

		.button,
		button:hover {
			width: 100%;
			padding: 10px;
			background-color: lightblue;
			color: white;
			border: none;
			border-radius: 3px;
			cursor: pointer;
			font-size: 20px;
		}
	</style>
</head>

<body>


	<main>
		<h1>Login</h1>
		<div class="mainContainer">

		<form id="login-form" method="post" action="login.php">
				<label for="username">Username *</label>
				<input type="text" id="username" name="username" required>

				<label for="password">Password *</label>
				<input type="password" id="password" name="password" required>
				<!-- <input type="button" value="Login" onclick="login()"> -->
				<button type="submit">Login</button>



			</form>

			<p id="no-account">Don't have an account ? <a href="carSellerRegistration.php">Register here</a></p>

		</div>
	</main>
</body>

</html>