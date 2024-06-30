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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="navbar.css" />
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cedarville+Cursive&family=Oswald:wght@200..700&family=Sacramento&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700&family=Water+Brush&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
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

        .breadcrumb {
            font-size: 10px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: #bdbdbd;
            background-color: transparent;
            padding-left: 30px;
        }

        .breadcrumb a {
            color: #bdbdbd;
        }

        .breadcrumb a:hover,
        .breadcrumb a:focus,
        .breadcrumb a:active,
        .breadcrumb a:visited {
            color: #bdbdbd;
        }

        .container {
            margin-right: 20px;
            display: flex;
        }

        .container a {
            color: inherit;
            text-decoration: none;
        }

        .filter {
            width: 20%;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-left: 40px; 
            position: sticky;
            top: 20px; 
            margin-top: 90px;
            height:  270px;
        }

        .filter input {
            width: calc(50% - 10px); 
            padding: 10px;
            margin-right: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .filter button {
            width: 100%;
            padding: 10px;
            background-color: #e6a4b4;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
        }

        .catering {
            width: 80%;
            padding: 30px 0;
            border-radius: 30px;
        }

        .catering h1 {
            font-size: 20px;
            font-family: Georgia, 'Times New Roman', Times, serif;
            letter-spacing: 2px;
            margin-bottom: -1px;
        }

        .catering p span {
            font-size: 15px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin-bottom: 2px;
        }

        .catering-box {
            width: 100%;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
            
        }

        .catering-card {
            width: 240px;
            margin: 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            background-color: whitesmoke;
            border-radius: 15px ;
          
        }

        .catering-image {
            width: 100%;
            height: 245px;
            overflow: hidden;
            border-radius: 10px ;
        }

        .catering-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: 0.3s;
        }

        .catering-image:hover img {
            transform: scale(1.1);
        }

        .catering-info {
            padding: 20px;
        }

        .catering-info .product-name {
            font-size: 20px;
        }

        .catering-info .product-desc {
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-size: 15px;
        }

        .catering-info .price {
            font-size: 20px;
            color: #e6a4b4;
        }

        @media (max-width: 450px) {
            .catering .catering-box {
                grid-template-columns: 2fr;
                gap: 10px;
            }

            .catering-card {
                max-width: fit-content;
                max-height: fit-content;
                margin: 0 auto;
            }
        }

        .search-form {
            display: none;
            position: absolute;
            top: 50px;
            right: 20px;
            width: 200px;
            background-color: white;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .search-form input {
            width: 100%;
            padding: 5px;
            margin-bottom: 5px;
            border: 1px solid #e6a4b4;
            border-radius: 18px;
        }

        .search-form button {
            display: block;
            width: 100%;
            padding: 5px;
            background-color: #e6a4b4;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        #search-results {
            background-color: white;
            color: black;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
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
          <div class="dropdown-menu" style="background-color: #EED6DD;" aria-labelledby="servicesDropdown">
            <a class="dropdown-item" href="checklist.php"><b>CHECKLIST</b></a>
            <a class="dropdown-item" href="booking.php"><b>BOOKING</b></a>
          </div>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="loggedin.html#contact-section">CONTACT</a>        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="search-icon"><i class="fas fa-search"></i></a>
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
        <form class="search-form" id="search-form" method="GET" action="">
            <input type="text" name="query" placeholder="Search..." />
            <button type="submit">Search</button>
        </form>
    </section>

    
    <section>
        <div class="breadcrumb">
            <a href="index.html">Home</a> > <a href="booking.php"> BOOKING</a>
        </div>
    </section>

    <div class="row">
    <div class="filter">
    <h3>Filter by Price</h3>
    <form method="GET" action="">
        <div style="display: flex;">
            <input type="number" name="min_price" placeholder="Min Price" />
            <input type="number" name="max_price" placeholder="Max Price" />
        </div>
        <button type="submit">Filter</button>
<button type="button" class="clear-btn" onclick="clearFilters()">Clear Filters</button>

    </form>
</div>


        <div class="container">
            <div class="catering" id="Catering">
                <h1>BOOKING</h1>
                <p><span>Catering</span></p>
                <div class="catering-box">
                    <?php
                    
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "asmaraloka";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    
                    $sql = "SELECT * FROM product_list WHERE category='Catering'";

                    if (isset($_GET['query']) && !empty($_GET['query'])) {
                        $query = $_GET['query'];
                        $sql .= " AND (name LIKE '%$query%' OR description LIKE '%$query%')";
                    }

                    if (isset($_GET['min_price']) && !empty($_GET['min_price'])) {
                        $min_price = $_GET['min_price'];
                        $sql .= " AND price >= $min_price";
                    }

                    if (isset($_GET['max_price']) && !empty($_GET['max_price'])) {
                        $max_price = $_GET['max_price'];
                        $sql .= " AND price <= $max_price";
                    }

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='catering-card'>";
                            echo "<div class='catering-image'>";
                            echo "<a href='nasi_campur.php?id={$row['id']}'><img src='{$row['image_path']}' alt='{$row['name']}' /></a>";
                            echo "</div>";
                            echo "<div class='catering-info'>";
                            echo "<div class='product-name'>{$row['name']}</div>";
                            echo "<p class='product-desc'>{$row['description']}</p>";
                            echo "<div class='price'>RM{$row['price']}/pax</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "No results found.";
                    }

                    $conn->close();
                    ?>
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
        <div class="option" data-option="Refund/Return">Refund/Return</div>
        <div class="option" data-option="Others">Others</div>
        </div>

        <div class="chat-input">
          <textarea placeholder="Chat here..." name="chat-input" id="chat-input" required></textarea>
          <span id="send-btn" class="material-symbols-outlined">send</span>
        </div>
      </div>

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

    <script>
        document.getElementById('search-icon').addEventListener('click', function () {
            var searchForm = document.getElementById('search-form');
            if (searchForm.style.display === 'none' || searchForm.style.display === '') {
                searchForm.style.display = 'block';
            } else {
                searchForm.style.display = 'none';
            }
        });

        

        function clearFilters() {
        document.querySelector('input[name="min_price"]').value = '';
        document.querySelector('input[name="max_price"]').value = '';

       
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.delete('min_price');
        urlParams.delete('max_price');

        
        window.location.href = window.location.pathname;
    }
    </script>
</body>

</html>
