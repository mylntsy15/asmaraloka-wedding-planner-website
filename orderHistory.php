
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="orderHistory.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script type="module" src="login.js" defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <script src="custchat.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap');
        .status-pending {
            text-align: center;
            color: white;
            font-weight: bold;
            background-color: #ebc474;
        }
        .dropdown-item {
            font-family: 'Cormorant Garamond', serif;
            font-weight: bold;
        }
        .status-completed {
            text-align: center;
            color: green;
            font-weight: bold;
            background-color: #86e49d;
        }
        .status-cancelled {
            text-align: center;
            color: red;
            font-weight: bold;
            background-color: #d893a3;
        }

        .chatbot-toggler {
      position: fixed;
      right: 40px;
      bottom: 15px;
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
      right: 40px;
      bottom: 75px;
      width: 450px;
      margin-top: 50px;
      transform: scale(0.5);
      opacity: 0;
      pointer-events: none;
      overflow: hidden;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1), 0 32px 64px -48px rgba(0, 0, 0, 0.5);



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

    table, th, td {
    padding: 1rem;
    border-collapse: collapse;
    text-align: left;
    font-size: 1.2rem;
    }
    </style>
</head>

<body>
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
                    <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        SERVICES
                    </a>
                    <div class="dropdown-menu" style="background-color: #EED1D5;" aria-labelledby="servicesDropdown">
                        <a class="dropdown-item" href="checklist.php">CHECKLIST</a>
                        <a class="dropdown-item" href="booking.php">BOOKING</a>
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

    <main class="table">
        <section class="table_header">
            <h1 style="font-family: 'Cormorant Garamond', serif;">Customer's Order</h1>
        </section>
        <section class="table_body">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Refund Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $con = mysqli_connect("localhost", "root", "", "asmaraloka");


                    
                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    }

                    
                    $sql = "SELECT order_id, item, quantity, amount, status, request FROM order_history";
                    $result = $con->query($sql);

                    
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['order_id'] . "</td>";
                            echo "<td>" . $row['item'] . "</td>";
                            echo "<td>" . $row['quantity'] . "</td>";
                            $calculated_amount = ($row['amount'] * $row['quantity']) + 10;
                            echo "<td>RM " . number_format($calculated_amount, 2) . "</td>";
                            
                            $status_class = '';
                            switch ($row['status']) {
                                case 'Pending':
                                    $status_class = 'status-pending';
                                    break;
                                case 'Completed':
                                    $status_class = 'status-completed';
                                    break;
                                case 'Cancelled':
                                    $status_class = 'status-cancelled';
                                    break;
                            }
                            echo "<td class='" . $status_class . "'>" . $row['status'] . "</td>";

                            switch ($row['request']) {
                                case 'Pending':
                                    echo "<td><a href='#?order_id=" . $row['order_id'] . "'><button style='border-radius: 2rem; border: 2px solid yellow; color: orange; background-color: yellow; font-size: 1.2rem;' class='btn btn-custom'>" . $row['request'] . "</button></a></td>";
                                    break;
                                case 'Request':
                                    echo "<td><a href='refund.php?order_id=" . $row['order_id'] . "'><button style='border-radius: 2rem; border: 2px solid grey; color: white; background-color: grey; font-size: 1.2rem;' class='btn btn-custom'>" . $row['request'] . "</button></a></td>";
                                    break;
                                    case 'Rejected':
                                    echo "<td><a href='#?order_id=" . $row['order_id'] . "'><button style='border-radius: 2rem; border: 2px solid red; color: white; background-color: red; font-size: 1.2rem;' class='btn btn-custom'>" . $row['request'] . "</button></a></td>";
                                    break;
                                case 'Approved':
                                    echo "<td><a href='#?order_id=" . $row['order_id'] . "'><button style='border-radius: 2rem; border: 2px solid green; color: white; background-color: green; font-size: 1.2rem;' class='btn btn-custom'>" . $row['request'] . "</button></a></td>";
                                    break;
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "0 results";
                    }
                    $con->close();
                    ?>

                </tbody>
            </table>
        </section>
    </main>

    
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

    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shCzFq6PNUAPOe9xgt7pUyo9gyiJK6yj6y0pX"
        crossorigin="anonymous"></script>
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