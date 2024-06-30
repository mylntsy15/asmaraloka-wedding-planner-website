<?php

$sname = "localhost";
$username = "root";
$password = "";
$db_name = "asmaraloka";

try {
  $conn = new PDO(
    "mysql:host=$sname;dbname=$db_name",
    $username,
    $password
  );
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed : " . $e->getMessage();
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM groups WHERE id = ?");
    $res = $stmt->execute([$id]);

    if ($res) {
        echo 'success';
    } else {
        echo 'error';
    }
}
