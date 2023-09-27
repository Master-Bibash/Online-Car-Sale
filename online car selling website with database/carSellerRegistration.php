<?php
$username = "root";
$pw = "";
$server = 'localhost';
$db = 'mycar';

$con = mysqli_connect($server, $username, $pw, $db);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $address = mysqli_real_escape_string($con, $_POST["Address"]);
    $phoneN = mysqli_real_escape_string($con, $_POST["phonenumber"]);
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $password = $_POST["password"];  // Assuming you have an open database connection in $conn

    $password = mysqli_real_escape_string($con, $password);
    // Hash the password
    $email = mysqli_real_escape_string($con, $_POST["email"]);

    // Validate the data here (e.g., email format, password strength)

    $duplicate = mysqli_query($con, "SELECT * FROM seller WHERE username='$username' OR Email='$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script>alert('Username or email already taken. Please enter another one.');</script>";
    } else {
        $query = "INSERT INTO seller (Name, Address, phonenumber, username, password, email) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ssisss", $name, $address, $phoneN, $username, $password, $email);

        if ($stmt->execute()) {
            echo "<script>alert('Data has been inserted successfully.');</script>";
        } else {
            echo "<script>alert('Error: Data insertion failed. Please try again.');</script>";
        }
    }
    $stmt->close();
}

mysqli_close($con);
?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Seller Registration</title>
    <script src="main.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        main {
            margin-top: 5px;
            border-radius: 20px;
            background: #bbb4b4b5;
        }

        .headerCar {
            margin-bottom: 20px;
        }
    </style>

</head>

<body>
    <header class="container">

        <nav>
            <div class="logo">
                <a href="index.html"><img src="kisspng-car-dealership-alsa-enterprises-motors-used-car-ve-sale-logo-transparent-5b4b866674ca30.5811650215316762624784.png"
                        alt="" srcset="" class="logo"></a>
            </div>
            <ul>
                <li><a href="./index.html">Home</a></li>
                <li><a href="./carSellerRegistration.php">Cars Seller</a></li>
                <li><a href="./seller.php">Seller</a></li>
                <li><a href="./search.php">Search</a></li>
                <li><a href="./about_us.html">About Us</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="headerCar">
            <h1>Car Seller Registration</h1>

        </div>
        <form id="registration-form" method="post" action="<?php
                                                            echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required placeholder="Enter your Name here">
            <label for="address">Address:</label>
            <input type="text" id="address" name="Address" required placeholder="Enter your city name">
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phonenumber" required placeholder="Enter your phonenumber">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required placeholder="Enter your emailaddress">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required placeholder="Enter your username">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required placeholder="Enter your password">
            <button type="submit" name="submit">Register</button>
        </form>
    </main>
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
</body>

</html>
