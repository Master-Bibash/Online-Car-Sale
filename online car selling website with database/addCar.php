<?php
$db_username = "root";
$db_password = "";
$server = 'localhost';
$db = 'mycar';

$con = mysqli_connect($server, $db_username, $db_password, $db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = "INSERT INTO car (model, make, year, mileage, location, price, seller_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($query);

    $model = $_POST["model"];
    $make = $_POST["make"];
    $year = $_POST["year"];
    $mileage = $_POST["mileage"];
    $location = $_POST["location"];
    $price = $_POST["price"];

    // Start the session
    session_start();
    $id = $_SESSION["seller_id"];

    $stmt->bind_param("sssisdi", $model, $make, $year, $mileage, $location, $price, $id);

    if ($stmt->execute()) {
        header("Location: seller.php"); // Corrected location header
        exit;
    } else {
        echo '<script>alert("Please try again ");</script>';
    }

    $stmt->close();
}

$con->close();
?>







<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Add Car</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
<style>
	table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</style>
	
</head>

<body>


	<main>
		<center><h1>Add Car</h1></center>
		<form id="add-car-form" method="post">
			<label for="make">Make *</label>
			<input type="text" id="make" name="make" required placeholder="Make">

			<label for="model">Model *</label>
			<input type="text" id="model" name="model" required placeholder="Model">

			<label for="year">Year *</label>
			<input type="text" id="year" name="year" required placeholder="enter year">

			<label for="mileage">Mileage *</label>
			<input type="number" id="mileage" name="mileage" required placeholder="enter milages per hour">

			<label for="location">Location *</label>
			<input type="text" id="location" name="location" required placeholder="enter location">

			<label for="price">Price *</label>
			<input type="text" id="price" name="price" required placeholder="enter price">

			<button id="button" type="submit">Add Car</button>
      <script>
       const formInputs = document.querySelectorAll("input");
     const buttons = document.querySelectorAll("button");
 
     // Change background color to yellow when input is selected
     formInputs.forEach((input) => {
         input.addEventListener("focus", () => {
             input.style.backgroundColor = "yellow";
         });
     });
 
     // Change background color to white when user leaves input field
     formInputs.forEach((input) => {
         input.addEventListener("blur", () => {
             input.style.backgroundColor = "white";
         });
     });
 
     // Change background color to light blue when mouse hovers over a button
     buttons.forEach((button) => {
         button.addEventListener("mouseover", () => {
             button.style.backgroundColor = "lightblue";
         });
 
         // Change background color back to default when mouse leaves the button
         button.addEventListener("mouseout", () => {
             button.style.backgroundColor = "";
         });
     });

</script>

		</form>
	</main>
	</body>

</html>