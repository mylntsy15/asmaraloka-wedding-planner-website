<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "asmaraloka"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $city = $conn->real_escape_string($_POST['city']);
    $state = $conn->real_escape_string($_POST['state']);
    $zip = $conn->real_escape_string($_POST['zip']);
    $card = $conn->real_escape_string($_POST['card']);
    $cardnumber = $conn->real_escape_string($_POST['cardnumber']);
    $expdate = $conn->real_escape_string($_POST['expdate']);
    $cvv = $conn->real_escape_string($_POST['cvv']);

    
    $sql = "INSERT INTO payment (name, email, address, city, state, zip, card, cardnumber, expdate, cvv) VALUES ('$name', '$email', '$address', '$city', '$state', '$zip', '$card', '$cardnumber', '$expdate', '$cvv')";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: checkout2.php?name=$name&email=$email&address=$address&city=$city&state=$state&zip=$zip&card=$card&cardnumber=$cardnumber&expdate=$expdate&cvv=$cvv");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
