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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST['id'];
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        
        $sql_delete = "DELETE FROM cart WHERE id = $productId";
        if ($conn->query($sql_delete) === TRUE) {
            
        } else {
            echo "Error deleting item: " . $conn->error;
        }
    } elseif (isset($_POST['action']) && $_POST['action'] == 'update') {
        $newQuantity = $_POST['quantity'];
        
        $sql_update = "UPDATE cart SET quantity = $newQuantity WHERE id = $productId";
        if ($conn->query($sql_update) === TRUE) {
            
        } else {
            echo "Error updating quantity: " . $conn->error;
        }
    }
}


$sql = "SELECT pl.id, pl.name, pl.image_path, ct.quantity, pl.price FROM cart ct 
        JOIN product_list pl ON ct.id = pl.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bag - ASMARALOKA</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="navbar.css" />
    <script type="module" src="login.js" defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <script src="custchat.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap');

        body {
            padding: 0;
            margin: 0;
            background-image: url('image/bgimg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            text-align: center;
            margin: 0;
        }

        .cart-container {
            padding: 20px;
        }

        .cart-container h3 span {
            text-align: left;
            padding-bottom: 10px;
        }

        .cart-item {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .item-info h5,
        .item-info p {
            text-align: left;
        }

        .cart-item img {
            max-width: 150px;
            border-radius: 10px;
            margin-right: 20px;
        }

        .cart-item .item-info {
            flex: 1;
        }

        .cart-item .item-info h5 {
            margin: 0;
        }

        .cart-item .item-quantity {
            display: flex;
            align-items: center;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 120px;
            margin-top: 10px;
        }

        .quantity-control button {
            width: 30px;
            height: 30px;
            background-color: #E6A4B4;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .quantity-control button:hover {
            background-color: #C48191;
        }

        .quantity-control input {
            width: 50px;
            height: 30px;
            text-align: center;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }

        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .quantity-input:focus {
            border-color: #E6A4B4;
        }

        .delete-button {
            position: absolute;
            top: 4px;
            right: 5px;
            font-size: 14px;
            border-radius: 4px;
            border: 2px solid red;
            background-color: white;
            color: red;
            cursor: pointer;
            width: 24px;
            height: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background-color 0.3s, color 0.3s;
        }

        .delete-button:hover {
            background-color: red;
            color: white;
        }

        .order-summary {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            text-align: justify;
        }

        .order-summary h5 {
            margin-bottom: 20px;
        }

        .order-summary span {
            text-align: end;
        }

        .order-summary .total {
            font-weight: bold;
            font-size: 1.2em;
        }

        .order-summary .total end {
            text-align: end;
        }

        .btn-checkout {
            background-color: #E6A4B4;
            color: black;
            width: 100%;
        }

        .btn-checkout:hover {
            background-color: #E6A4B4;
            color: white;
            width: 100%;
        }

        .pink-container {
            background-color: pink;
            border-radius: 15px;
            padding: 20px;
            width: 100%;
            max-width: 600px;
            margin-left: 20px;
        }

        .pink-container img {
            border-radius: 15px;
        }

        .container-content {
            display: flex;
            justify-content: flex-start;
        }

        .container-content img {
            max-width: 150px;
            margin-right: 20px;
        }

        .icon_badge {
            position: absolute;
            top: 20px;
            right: 5px;
            left: 18px;
            background-color: #E6A4B4;
            color: white;
            border-radius: 50%;
            width: 15px;
            height: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
        }

            .chatbot-toggler {
          position: fixed;
          right: 20px;
          bottom: 20px;
          height: 50px;
          width: 50px;
          color: white;
          border: none;
          justify-content: center;
          align-items: center;
          display: flex;
          outline: none;
          cursor: pointer;
          background: #e6a4b4;
          border-radius: 50%;
        }

        .chatbot-toggler span {
          position: absolute;
        }

        .show-chatbot .chatbot-toggler span:first-child,
        .chatbot-toggler span:last-child {
          opacity: 0;
        }

        .show-chatbot .chatbot-toggler span:last-child {
          opacity: 1;

        }

        .chatbot {
          position: fixed;
          right: 20px;
          bottom: 90px;
          width: 450px;
          margin-top: 50px;
          transform: scale(0.5);
          opacity: 0;
          pointer-events: none;
          overflow: hidden;
          background: #fff;
          border-radius: 15px;
          box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1), 0 32px 64px -48px rgba(0, 0, 0, 0.5);
          transition: transform 0.3s, opacity 0.3s;
        }

        .show-chatbot .chatbot {
          transform: scale(1);
          opacity: 1;
          pointer-events: auto;

        }

        .chatbot header {
          background: #e6a4b4;
          padding: 16px 0;
          text-align: center;
          position: relative;
          height: 80px;
        }

        .chatbot header h2 {
          color: white;
          font-size: 18px;
        }

        .chatbot .brand {
          color: white;
          padding-top: 5px;
          font-size: 25px;
          font-family: "Cormorant Garamond", serif;
        }

        .chatbot header span {
          position: absolute;
          right: 20px;
          top: 50%;
          color: white;
          cursor: pointer;
          display: none;
          transform: translateY(-50%);
        }

        .chatbot .chatbox {
          height: 450px;
          overflow-y: auto;
          padding: 30px 20px 70px;
        }

        .chatbox .chat {
          display: flex;
        }

        .chatbox .admin-chat span {
          height: 32px;
          width: 32px;
          color: #fff;
          align-self: flex-end;
          background: #e6a4b4;
          text-align: center;
          line-height: 32px;
          border-radius: 4px;
          margin: 0 10px 7px 0;
        }

        .chatbox .cust-chat {
          margin: 20px 0;
          justify-content: flex-end;
        }

        .chatbox .chat p {
          color: white;
          max-width: 75%;
          padding: 12px 16px;
          font-size: 10px;
          border-radius: 10px 10px 0 10px;
          background: #e6a4b4;
        }

        .chatbox .chat .sender-name {
          
          font-size: 10px;
          padding-left: 5px;
          margin-bottom: 5px;
          background: transparent;
        }

        .chatbox .admin-chat .sender-name {
          color: #c5c5c5;
        }

        .chatbox .admin-chat p {
          color: black;
          background: #f2f2f2f1;
          border-radius: 10px 10px 10px 0;
        }


        .options-container {
          display: none;
          justify-content: center;
          margin-top: 5px;
          padding: 5px 40px;
          flex-direction: column;


        }

        .option {
          display: flex;

          justify-content: center;
          align-items: center;
          width: 100px;
          height: 30px;
          background-color: #ffffff;
          color: rgb(0, 0, 0);
          border: 1px solid #c5c5c5;
          border-radius: 20px;
          margin: 5px 0;
          cursor: pointer;
          padding: 5px 10px;
          text-align: center;
          font-size: 12px;
        }

        .option:hover {
          background-color: #e6a4b4;
        }




        .chatbot .chat-input {
          position: absolute;
          bottom: 0;
          width: 100%;
          display: flex;
          gap: 5px;
          background: white;
          padding: 5px 20px;
          border-top: 1px solid #ccc;
        }

        .chat-input textarea {
          height: 55px;
          width: 100%;
          border: none;
          outline: none;
          font-size: 12px;
          resize: none;
          padding: 16px 15px 16px 0;
        }

        .chat-input span {
          align-self: flex-end;
          height: 55px;
          line-height: 55px;
          color: #e6a4b4;
          font-size: 22px;
          cursor: pointer;
          visibility: hidden;
        }

        .chat-input textarea:valid~span {
          visibility: visible;
        }

        @media(max-width: 490px) {
          .chatbot {
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            border-radius: 0;
          }

          .chatbot .chatbox {
            height: 90%;
          }

          .chatbot header span {
            display: block;
          }
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
                    <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        SERVICES
                    </a>
                    <div class="dropdown-menu" style="background-color: #EED1D5;" aria-labelledby="servicesDropdown">
                        <a class="dropdown-item" href="checklist.php"><b>CHECKLIST</b></a>
                        <a class="dropdown-item" href="booking.php"><b>BOOKING</b></a>
                    </div>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="loggedin.html#contact-section">CONTACT</a>        
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="payment.php"><i class="fas fa-shopping-bag"></i><?php if ($total_quantity > 0) : ?>
                            <span class="icon_badge"><?php echo $total_quantity; ?></span>
                        <?php endif; ?></a>
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

    <div class="container cart-container">
        <h3 style="text-align: left;">MY BAG</h3>
        <div class="row">
            <div class="col-md-8">
                <?php
                
                $sql = "SELECT pl.id, pl.name, pl.image_path, ct.quantity, pl.price FROM cart ct 
                        JOIN product_list pl ON ct.id = pl.id";
                $result = $conn->query($sql);

                $subtotal = 0; 

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        
                        $subtotal += $row["price"] * $row["quantity"];
                        echo '
                        <div class="cart-item" data-id="'.$row["id"].'" data-price="'.$row["price"].'">
                            <img src="'.$row["image_path"].'" alt="'.$row["name"].'">
                            <div class="item-info">
                                <h5>'.$row["name"].'</h5>
                                <p>Price: RM<span class="item-price">'.number_format($row["price"] * $row["quantity"], 2).'</span></p>
                                <div class="item-quantity">
                                    <form method="POST" action="" class="quantity-control">
                                        <input type="hidden" name="id" value="'.$row["id"].'">
                                        <input type="hidden" name="action" value="update">
                                        <button type="button" class="btn-decrease">-</button>
                                        <input type="number" name="quantity" value="'.$row["quantity"].'" class="quantity-input">
                                        <button type="button" class="btn-increase">+</button>
                                    </form>
                                </div>
                            </div>
                            <form method="POST" action="">
                                <input type="hidden" name="id" value="'.$row["id"].'">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="delete-button">X</button>
                            </form>
                        </div>';
                    }
                } else {
                    echo "No items in the cart.";
                }
                $conn->close();
                ?>
            </div>
            <div class="col-md-4">
                <div class="order-summary">
                    <h5>ORDER SUMMARY</h5>
                    <p>SUBTOTAL: <span id="subtotal">RM<?php echo number_format($subtotal, 2); ?></span></p>
                    <p>Shipping: <span>RM10</span></p>
                    <p class="total">TOTAL: <span id="total">RM<?php echo number_format($subtotal + 10, 2); ?></span></p>
                    <form method="POST" action="checkout.php">
                        <button type="submit" class="btn btn-checkout">CHECKOUT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <div>
      <button class="chatbot-toggler">
        <span class="material-symbols-outlined">mode_comment</span>
        <span class="material-symbols-outlined">close</span>
      </button>
      <div class="chatbot">
        <header>
          <h2>Chat With<span class="brand">ASMARALOKA</span></h2>
          <h2 class="brand">ASMARALOKA</h2>
          <span class="material-symbols-outlined">close</span>
        </header>

        <ul class="chatbox">
          <li class="chat admin-chat">
            <span class="material-symbols-outlined">favorite</span>
            <div class="column">
              <span class="sender-name">ASMARALOKA</span>
              <p>Welcome To ASMARALOKA! </p>
            </div>

          </li>
          <li class="chat cust-chat">

          </li>
        </ul>

        <div class=" options-container" id="options-container">
          <div class="option" data-option="Refund">Refund</div>
          <div class="option" data-option="Return">Return</div>
        </div>

        <div class="chat-input">
          <textarea placeholder="Chat here..." name="chat-input" id="chat-input" required></textarea>
          <span id="send-btn" class="material-symbols-outlined">send</span>
        </div>
      </div>

      
      <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete this category?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn" style="background-color: #be7b84a2;" id="confirmDeleteBtn">Delete</button>
            </div>
          </div>
        </div>
      </div>

    <script>
        document.querySelectorAll('.btn-decrease').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.nextElementSibling;
                let value = parseInt(input.value);
                if (value > 1) {
                    value--;
                    input.value = value;
                    updateCart(this);
                }
            });
        });

        document.querySelectorAll('.btn-increase').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                let value = parseInt(input.value);
                value++;
                input.value = value;
                updateCart(this);
            });
        });

        document.querySelectorAll('.quantity-control input[type="number"]').forEach(input => {
            input.addEventListener('change', function() {
                if (this.value < 1) {
                    this.value = 1;
                }
                updateCart(this);
            });
        });

        function updateCart(element) {
            const cartItem = element.closest('.cart-item');
            const id = cartItem.dataset.id;
            const price = parseFloat(cartItem.dataset.price);
            const quantity = parseInt(cartItem.querySelector('.quantity-input').value);
            const itemPriceElement = cartItem.querySelector('.item-price');

            
            const itemTotalPrice = (price * quantity).toFixed(2);
            itemPriceElement.textContent = itemTotalPrice;

            
            let subtotal = 0;
            document.querySelectorAll('.cart-item').forEach(item => {
                const itemPrice = parseFloat(item.querySelector('.item-price').textContent);
                subtotal += itemPrice;
            });

            const shipping = 10;
            const total = subtotal + shipping;

            
            document.getElementById('subtotal').textContent = 'RM' + subtotal.toFixed(2);
            document.getElementById('total').textContent = 'RM' + total.toFixed(2);

            
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send(`id=${id}&quantity=${quantity}&action=update`);
        }
    </script>
    <script src="homepage.js"></script>
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
</body>

</html>
