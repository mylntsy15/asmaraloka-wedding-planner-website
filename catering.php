<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "asmaraloka";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['query'])) {
    $searchTerm = $_GET['query'];

    $sql = "SELECT * FROM catering_list WHERE name LIKE '%$searchTerm%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    } else {
        echo "0 results";
    }
}

$conn->close();
?>
