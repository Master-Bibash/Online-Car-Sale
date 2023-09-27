<?php
session_start();
if (!isset($_SESSION["seller_id"]) || empty($_SESSION["seller_id"])) {
    header("location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $db_username = "root";
    $db_password = "";
    $server = 'localhost';
    $db = 'mycar';

    $con = mysqli_connect($server, $db_username, $db_password, $db);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $id = $_GET['id'];

    $del = "DELETE FROM car WHERE id=?";
    $stmt = $con->prepare($del);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Data deleted successfully
        echo '<script>alert("Data has been deleted");</script>';
        header("Location: seller.php");
        exit();
    } else {
        // Error while deleting data
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
  
    <style>
        .containerSeller {
            margin-top: 60px;
        }

        .navSeller {
            background-color: black;
        }

        .containerSeller {
            /* border: 2px solid red; */
            background: rgb(224, 217, 217);

        }

        .tableContainer {
            align-items: center;
        }

        table,
        th,
        td {
            border: solid 2px #090224;
            border-collapse: collapse;
            text-align: center;
        }

        table th {
            font-size: 25px;
            text-transform: uppercase;
            text-align: center;
            background: #b3adad;

        }

        table td {
            font-size: 24px;
            padding: 1px;
        }
        .listItem table{
            /* border: 2px solid red; */
            border: solid 2px #090224;
            border-collapse: collapse;
            text-align: center;
            width: 100%;
        }
    </style>

</head>

<body>


    <nav class="navSeller">
        <ul>
            <li><a href="./index.html">Seller Home</a></li>
            <li id="add-car-link"><a href="addCar.php">Add Car</a></li>
        </ul>
    </nav>

    <div class="containerSeller">
        <h1>Seller Page</h1>
        <p>Welcome to your seller page. Here you can manage your car advertisements.</p>

        <div class="listItem">
            <div id="tableContainer">
                <table id="sellerTable"></table>
            </div>
        </div>
    </div>
    <?php


$db_username = "root";
$db_password = "";
$server = 'localhost';
$db = 'mycar';

$con = mysqli_connect($server, $db_username, $db_password, $db);
$sql="SELECT * FROM car";
$result=$con->query($sql);
if ($result->num_rows>0) {

    echo "<h2>Cars Listed</h2>";
    echo '<table style="width: 100%; border-collapse: collapse;">';

   echo " <thead>
    <tr>
        <th>Make</th>
        <th>location</th>
        <th>mileage</th>
        <th>model</th>
        <th>price</th>
        <th>year</th>
        <th>Action</th>
    </tr>
</thead>
";
while ($row = $result->fetch_assoc()) {

echo '<tbody id="itemList">';
echo '<tr>';
echo '<td>'.$row["make"]."</td>";
echo '<td>'.$row["location"]."</td>";
echo '<td>'.$row["mileage"]."</td>";
echo '<td>'.$row["model"]."</td>";
echo '<td>'.$row["price"]."</td>";
echo '<td>'.$row["year"]."</td>";
// echo "<td><a href='seller.php?id=" . $row['id'] . "' style='text-decoration: none;'><i>Delete</i></a></td>";
echo "<td><a href='seller.php?id=" . $row['id'] . "'style='text-decoration: none;'>Delete</a></td>";



echo "</tr>";
}

   echo "</table>"; 
}else{
    echo "<h3>No Cars Listed in the data</h3>";
}

  

          
        
        
   ?>

</body>

</html>



