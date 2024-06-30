<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "asmaraloka";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_total_quantity = "SELECT COUNT(quantity) AS total_quantity FROM cart";
$result_total_quantity = $conn->query($sql_total_quantity);
$total_quantity = 0;
if ($result_total_quantity->num_rows > 0) {
    $row_total_quantity = $result_total_quantity->fetch_assoc();
    $total_quantity = $row_total_quantity["total_quantity"];
}
?>