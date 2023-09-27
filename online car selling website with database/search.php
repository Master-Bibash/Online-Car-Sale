


<!DOCTYPE html>
<html>

<head>
  <title>Search Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Sale Homepage</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="script.js"></script>
  <style>
    main {
      /* border: solid red 2px; */
      border-radius: 20px;
      background: #bbb4b4b5;
    }

    table {
      border-collapse: collapse;
      border: 1px solid #000;
      width: 100%;
      margin: 20px 0;
      /* Set margin */
    }

    table tr td {
      text-align: center;

    }

    th,
    td {
      text-align: left;
      padding: 8px;
      /* Set padding */
    }

    th {
      background-color: #555;
      /* Set background color for header */
      color: #fff;
      /* Set font color for header */
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
      /* Set background color for even rows */
    }

    tr:hover {
      background-color: #ddd;
      /* Set background color for row hover */
    }

    iframe {
      width: 100%;
      height: 60vh;
      border: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
    }
  </style>

</head>

<body>
  <header class="container">
  <nav>
     <div class="logo">
          <a href="index.html"><img src="kisspng-car-dealership-alsa-enterprises-motors-used-car-ve-sale-logo-transparent-5b4b866674ca30.5811650215316762624784.png"
               alt="" srcset="" class="logo"></a>
     </div>     <ul>
          <li><a href="./index.html">Home</a></li>
                    <li><a href="./carSellerRegistration.php">Cars Seller</a></li>
                    <li><a href="./seller.php">Seller</a></li>
                    <li><a href="./search.php">Search</a></li>
                    <li><a href="./about_us.html">About Us</a></li>
</nav>
  </header>
  <center>
    <h1>Search Page</h1>
  </center>

  <main>
  <form method="post">
      <label for="model">Model:</label>
      <input type="text" id="model" name="model"><br><br>
      <label for="location">Location:</label>
      <input type="text" id="location" name="location"><br><br>
      <button type="submit">Search</button>
    </form>
         
   
      <?php
  
  $db_username = "root";
  $db_password = "";
  $server = 'localhost';
  $db = 'mycar';
  
  $con = mysqli_connect($server, $db_username, $db_password, $db);
  if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model = $_POST["model"];
    $location = $_POST["location"];
    $sql = "SELECT * FROM car WHERE model = ? and location = ?";

    $stmt = $con->prepare($sql);

    $stmt->bind_param("ss", $model, $location);

    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows>0) {
     echo"<h3>Matching Cars Details</h3>";
     echo "<table>";
     echo "<tr>";
     echo "<th>Make</th>";
     echo "<th>Model</th>";
     echo "<th>Year</th>";
     echo "<th>Mileage</th>";
     echo "<th>Location</th>";
     echo "<th>Price</th>";
     echo "</tr>";
    }
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["make"] . "</td>";
      echo "<td>" . $row["model"] . "</td>";
      echo "<td>" . $row["year"] . "</td>";
      echo "<td>" . $row["mileage"] . "</td>";
      echo "<td>" . $row["location"] . "</td>";
      echo "<td>" . $row["price"] . "</td>";
      echo "</tr>";
    }

    echo "</table>";
  } else {
    echo "<h3>No Cars Listed</h3>";
  
  }



?>
   
    
  </main>
  <footer>
    <p>&copy; 2023 ONLINE CAR SALE</p>
</footer>
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


<!-- <table>
        <thead>
          <tr>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>Mileage</th>
            <th>Location</th>
            <th>Price</th>
          </tr>
          </tr>
        </thead>
        <tbody id="searchBody"></tbody>
      </table> -->