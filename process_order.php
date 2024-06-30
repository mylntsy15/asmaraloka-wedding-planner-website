<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "asmaraloka";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT pl.id, pl.name, pl.image_path, ct.quantity, pl.price FROM cart ct JOIN product_list pl ON ct.id = pl.id";
$result = $conn->query($sql);

if ($result) {
    
    $stmt = $conn->prepare("INSERT INTO order_history (item, amount, status, request, quantity) VALUES (?, ?, 'Pending', 'Request', ?)");

    
    if ($stmt) {
        
        while ($row = $result->fetch_assoc()) {
           
            $stmt->bind_param("sdi", $row['name'], $row['price'], $row['quantity']);

            
            if (!$stmt->execute()) {
                echo "Error inserting row: " . $stmt->error;
            }
        }

        
        $stmt->close();
        echo "Order processed successfully.";
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Error: " . $conn->error;
}


$conn->close();
?>
