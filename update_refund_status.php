<?php


$con = mysqli_connect("localhost", "root", "", "asmaraloka");


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


$refund_id = $_POST['refund_id'];
$status = $_POST['status'];
$order_id = $_POST['order_id'];


$sql = "UPDATE refund_request SET refundStatus = '$status' WHERE refund_id = '$refund_id'";
if ($con->query($sql) === TRUE) {
    
    $sql_update_order = "UPDATE order_history SET request = '$status' WHERE order_id = '$order_id'";
    if ($con->query($sql_update_order) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating order record: " . $con->error;
    }
} else {
    echo "Error updating refund record: " . $con->error;
}

$con->close();
?>
