<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund Page</title>
    <link rel="stylesheet" href="refund.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="navbar.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script type="module" src="login.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="homepage.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap');
       
        .dropdown-item {
      font-family: 'Cormorant Garamond',serif;
      font-weight: bold;
      
    }

    </style>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shCzFq6PNUAPOe9xgt7pUyo9gyiJK6yj6y0pX" crossorigin="anonymous"></script>
    <section>
        <div class="trailer" id="trailer"></div>
    </section>
    <nav class="navbar navbar-expand-md">
    <img src="image/asmaraloka logo.png" alt="Asmaraloka Logo" width="100" height="80" style="padding: 10px;">
        <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-navigation">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="loggedin.html">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="loggedin.html">ABOUT</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        SERVICES
                    </a>
                    <div class="dropdown-menu" style="background-color: #EED1D5;" aria-labelledby="servicesDropdown">
                        <a class="dropdown-item" href="checklist.php">CHECKLIST</a>
                        <a class="dropdown-item" href="booking.php">VENDOR</a>
                    </div>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="loggedin.html#contact-section">CONTACT</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-search"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="payment.php"><i class="fas fa-shopping-bag"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="orderHistory.php"><i class="fas fa-user"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="logout-button">LOG OUT</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1 style="font-family: 'Cormorant Garamond', serif;">Request Refund</h1>
        <?php
        $con = mysqli_connect("localhost", "root", "", "asmaraloka");

        
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        
        if(isset($_GET['order_id'])) {
            $order_id = $_GET['order_id'];

            
            $sql = "SELECT * FROM order_history WHERE order_id = $order_id";
            

            $result = $con->query($sql);

            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $item = $row["item"];
                    $quantity = $row["quantity"];
                    $amount = $row["amount"];

                    echo '<div class="item-details">';
                    echo '<div class="item">';
                    echo '<p>' . $item . '</p>';
                    echo '</div>';
                    echo '<div class="price">';
                    echo '<p>Order Id: ' . $order_id . '</p>';
                    echo '</div>';
                    echo '<div class="price">';
                    echo '<p>Quantity: ' . $quantity . '</p>';
                    echo '</div>';
                    echo '<div class="price">';
                    $calculated_amount = ($row['amount'] * $row['quantity'])+10;
                    echo "<td>Price: RM " . number_format($calculated_amount, 2) . "</td>";
                    echo '</div>';
                    echo '</div>';

                    
                    $refund_sql = "UPDATE order_history SET request = 'Pending' WHERE order_id = '$order_id'";
                    if ($con->query($refund_sql) === TRUE) {
                        echo "";
                    } else {
                        echo "Error: " . $insert_sql . "<br>" . $con->error;
                    }

                    $insert_sql = "INSERT INTO refund_request (order_id, item, quantity, amount, refundStatus) VALUES ('$order_id', '$item', '$quantity', '$calculated_amount', 'Pending')";
                    if ($con->query($insert_sql) === TRUE) {
                        echo "";
                    } else {
                        echo "Error: " . $insert_sql . "<br>" . $con->error;
                    }
                }
            } else {
                echo "0 results";
            }
            
        } else {
            echo "Order ID not provided.";
        }

        $con->close();
        ?>

        <div class="form-group">
            <label for="reason">Reason *</label>
            <select id="reason" name="reason" required>
                <option value="">Select Reason</option>
                <option value="wrong_item">I ordered the wrong item</option>                    
                <option value="not_working">I ordered for different pax</option>
                <option value="better_item">I have found better item</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Leave your comments here (Optional)"></textarea>
        </div>

        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required>
        </div>
        <button type="submit" id="chat-seller-button" class="btn-submit">Chat Seller</button>
    </div>
   
    <script src="cursortrail.js"></script>
    <script type="module">
        
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
        import { getAuth, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js";
        
        const firebaseConfig = {
          apiKey: "AIzaSyBeo2nbG68wpDsTSEErTTtGsJLahwbGpvQ",
          authDomain: "asmaraloka-1b64b.firebaseapp.com",
          projectId: "asmaraloka-1b64b",
          storageBucket: "asmaraloka-1b64b.appspot.com",
          messagingSenderId: "504684998639",
          appId: "1:504684998639:web:0dcf7393f9b928e4f0901a"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);
        console.log("Firebase has been initialized successfully.");

        // Logout functionality
        document.getElementById('logout-button').addEventListener('click', function () {
          auth.signOut().then(() => {
            // Sign-out successful.
            alert('You have been logged out.');
            window.location.href = 'index.html'; // Redirect to login page
          }).catch((error) => {
            // An error happened.
            alert('Error logging out: ' + error.message);
          });
        });
    </script>
    <script>
    document.getElementById('chat-seller-button').addEventListener('click', function () {
        window.location.href = 'chatbox-customer.html';
    });
</script>
</body>
</html>
