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

$sql = "SELECT pl.id, pl.name, pl.image_path, ct.quantity, pl.price FROM cart ct 
        JOIN product_list pl ON ct.id = pl.id";
$result = $conn->query($sql);


$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '';
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
$address = isset($_GET['address']) ? htmlspecialchars($_GET['address']) : '';
$city = isset($_GET['city']) ? htmlspecialchars($_GET['city']) : '';
$state = isset($_GET['state']) ? htmlspecialchars($_GET['state']) : '';
$zip = isset($_GET['zip']) ? htmlspecialchars($_GET['zip']) : '';
$card = isset($_GET['card']) ? htmlspecialchars($_GET['card']) : '';
$cardnumber = isset($_GET['cardnumber']) ? htmlspecialchars($_GET['cardnumber']) : '';
$expdate = isset($_GET['expdate']) ? htmlspecialchars($_GET['expdate']) : '';
$cvv = isset($_GET['cvv']) ? htmlspecialchars($_GET['cvv']) : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="navbar.css" />
    <script type="module" src="login.js" defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <script src="custchat.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap');

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

        .order-summary {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            width: 300px;
        }

        .order-summary h3 {
            margin-bottom: 20px;
        }

        .order-summary p {
            font-size: 16px;
            margin: 10px 0;
        }

        .order-summary .total {
            font-weight: bold;
            font-size: 18px;
        }

        .order-summary .total {
            font-size: 18px;
            font-weight: bold;
            text-align: left;
        }

        .ok .card-body {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .btn-custom {
            background-color: #e6a4b4;
            color: black;
        }

        .btn-custom:hover {
            background-color: #e6a4b4;
            color: #fff;
        }

        .brand-font {
            font-family: 'Cormorant Garamond', serif;
        }

        label {
            font-family: 'Cormorant Garamond', serif;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .popup,
        .success-popup {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .popup h2,
        .success-popup h2 {
            margin-top: 0;
            font-size: 18px;
            color: #555;
        }

        .popup button,
        .success-popup button {
            margin: 10px auto;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }

        .popup button.confirm {
            background-color: #f497a9;
            color: white;
        }

        .popup button.cancel {
            background-color: white;
            color: #333;
            border: 1px solid #333;
        }

        .success-popup .icon {
            font-size: 50px;
            color: green;
            margin-bottom: 10px;
            align-items: center;
            display: flex;
            justify-content: center;

        }

        .card-body {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .order-summary {
            text-align: left;
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
                    <a class="nav-link" href="loggedin.html" >HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about-section">ABOUT</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        SERVICES
                    </a>
                    <div class="dropdown-menu" style="background-color: #EED1D5;" aria-labelledby="servicesDropdown">
                        <a class="dropdown-item" href="checklist.php"><b>CHECKLIST</b></a>
                        <a class="dropdown-item" href="booking.php"><b>VENDOR</b></a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="scrollToContact()">CONTACT</a>
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

    <form method="POST" action="process_payment.php">
    <div class="container mt-3 rounded rounded-container">
        <div class="row">

        <div class="col-md-12">
    <div class="card rounded-container">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h2>BILLING DETAILS</h2>
                    
                        <div class="form-group">
                            <label for="name">FULL NAME</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">EMAIL</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="address">ADDRESS</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="city">CITY</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="state">STATE</label>
                                <input list="states" class="form-control" id="state" name="state" placeholder="Enter or select a state" required>
                                <datalist id="states">
                                    <option value="SELANGOR">
                                    <option value="PERAK">
                                    <option value="TERENGGANU">
                                    <option value="JOHOR">
                                    <option value="KEDAH">
                                    <option value="KELANTAN">
                                    <option value="MELAKA">
                                    <option value="NEGERI SEMBILAN">
                                    <option value="PAHANG">
                                    <option value="PENANG">
                                    <option value="PERLIS">
                                    <option value="SABAH">
                                    <option value="SARAWAK">
                                    <option value="SELANGOR">
                                    <option value="WILAYAH PERSEKUTUAN KUALA LUMPUR">
                                    <option value="WILAYAH PERSEKUTUAN LABUAN">
                                    <option value="WILAYAH PERSEKUTUAN PUTRAJAYA">
                                </datalist>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="zip">ZIP</label>
                                <input type="text" class="form-control" id="zip" name="zip" required>
                            </div>
                        </div>
                </div>
                <div class="col-md-6">
                    <h2>PAYMENT</h2>
                    <div class="form-group">
                        <label for="payment-method">ACCEPTED CARDS</label>
                        <select class="form-control" id="card" name="card" required>
                        <option value="" disabled selected hidden>Select your payment method</option>
                            <option value="credit card">CREDIT CARD</option>
                            <option value="debit card">DEBIT CARD</option>
                            <option value="ewallet">ONLINE BANKING</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="card-number">CARD NUMBER</label>
                        <input type="text" class="form-control" id="cardnumber" name="cardnumber" required>
                    </div>
                    <div class="form-group">
                        <label for="exp-date">EXP DATE</label>
                        <input type="text" class="form-control" id="expdate" name="expdate" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" required>
                    </div>
                    <button type="submit" class="btn btn-custom btn-block">SAVE BILLING DETAILS</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
                           
            <div id="successPopup" class="overlay">
                <div class="success-popup">
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h2>Payment Successful</h2>
                    <button class="confirm" onclick="printReceipt()">Print Receipt</button>
                    <button class="cancel" onclick="closeSuccessPopup()" href="checkout.php">Close</button>
                </div>
            </div>

                <div id="successPopup" class="overlay">
                    <div class="success-popup">
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h2>Payment Successful</h2>
                        <button class="confirm" onclick="printReceipt()">Print Receipt</button>
                        <button class="cancel" onclick="closeSuccessPopup()" href="checkout.php">Close</button>
                    </div>
                </div>
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

        <script src="cursortrail.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>

        <script>
            function showSuccessPopup() {
                document.getElementById('successPopup').style.display = 'block';
                document.querySelector('.overlay').style.display = 'block';
            }

            function closeSuccessPopup() {
                document.getElementById('successPopup').style.display = 'none';
                document.querySelector('.overlay').style.display = 'none';
            }

            function printReceipt() {
                var orderSummary = document.querySelector('.order-summary').innerHTML;
                var newWindow = window.open('', '', 'width=800, height=600');
                newWindow.document.write('<html><head><title>Receipt</title>');
                newWindow.document.write('</head><body >');
                newWindow.document.write('<h1>Receipt</h1>');
                newWindow.document.write(orderSummary);
                newWindow.document.write('</body></html>');
                newWindow.document.close();
                newWindow.print();
            }
        </script>


        <script>
            $(document).ready(function() {
                $('.dropdown-toggle').dropdown();
            });

            function showPopup() {
                document.getElementById('popupOverlay').style.display = 'flex';
            }

            function closePopup() {
                document.getElementById('popupOverlay').style.display = 'none';
            }

            function showSuccessPopup() {
                // Display the success popup
                document.getElementById('successPopup').style.display = 'flex';
            }

            function closeSuccessPopup() {
                document.getElementById('successOverlay').style.display = 'none';

            }

            function closeSuccessPopup() {
                window.location.href = 'orderHistory.php';
            }
            document.getElementById('print-button').addEventListener('click', function() {
                window.print();
            });

        </script>

        <script src="homepage.js"></script>
        <script src="cursortrail.js"></script>
        <script type="module">
            
            import {
                initializeApp
            } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
            import {
                getAuth,
                signInWithEmailAndPassword
            } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js";
            
            const firebaseConfig = {
                apiKey: "AIzaSyBeo2nbG68wpDsTSEErTTtGsJLahwbGpvQ",
                authDomain: "asmaraloka-1b64b.firebaseapp.com",
                projectId: "asmaraloka-1b64b",
                storageBucket: "asmaraloka-1b64b.appspot.com",
                messagingSenderId: "504684998639",
                appId: "1:504684998639:web:0dcf7393f9b928e4f0901a"
            };

            
            const app = initializeApp(firebaseConfig);
            const auth = getAuth(app);
            console.log("Firebase has been initialized successfully.");

            // Logout functionality
            document.getElementById('logout-button').addEventListener('click', function() {
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
