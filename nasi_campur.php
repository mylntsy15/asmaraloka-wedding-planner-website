<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "asmaraloka";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT * FROM product_list WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $product = $result->fetch_assoc();
} else {
  echo json_encode(array("status" => "error", "message" => "Product not found."));
  exit;
}

$stmt->close();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
  $quantity = intval($_POST['quantity']);
  $price = floatval($product['price']);
  $total_price = $quantity * $price;


  $sql_insert = "INSERT INTO cart (id, quantity, price) VALUES (?, ?, ?)";
  $stmt_insert = $conn->prepare($sql_insert);
  $stmt_insert->bind_param("iii", $id, $quantity, $price);
  $stmt_insert->execute();



  $stmt_insert->close();
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ASMARALOKA</title>
  <link rel="stylesheet" href="navbar.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <script type="module" src="login.js" defer></script>
  <script type="module" src="homepage.js" defer></script>

  <style>
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

    .nav-link,
    .navbar-brand {
      color: black;
      cursor: pointer;
      font-weight: lighter;
      font-family: "Cormorant Garamond", serif;
      text-decoration: none;
      margin-right: 1em !important;
      position: relative;
    }


    .dropdown-item {
      font-family: 'Cormorant Garamond', serif;
      font-weight: lighter;
    }


    .row {
      display: flex;
      justify-content: space-between;
      align-items: flex-start  /* Optional: Aligns items at the start */
      flex-wrap: wrap;
      /* Optional: Allows items to wrap to the next line if needed */
      margin-top: 50px;

      margin-right: 40px;
    }

    .container {
      flex: 1;
      margin: 10px;
      height: 200px;
    }



    .product {
      max-width: 100%;
      text-align: center;
    }

    .product img {
      width: 100%;
      max-width: 500px;
      /* Limit maximum width of the image */
      height: auto;
      box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.4);
    }

    .product_text {
      text-align: justify;
      max-width: 100%;
      font-family: "Cormorant Garamond", serif;

    }

    .product_text h1 {
      text-align: center;
      max-width: 100%;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 35px;
      font-weight: 700;
      letter-spacing: 1px;

    }

    .price {
      margin-top: 20px;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 40px;
      font-weight: 700;
    }

    .add_to_bag {
      margin-top: 10px;
      /* Adjust margin as needed */
      padding: 10px 20px;
      background-color: #E6A4B4;
      color: black;
      border: none;
      cursor: pointer;
      font-size: 16px;
      font-family: Arial, Helvetica, sans-serif;
      letter-spacing: 2px;
      width: 100%;
      /* Full width button */
      max-width: 300px;
      /* Limit maximum width of the button */
    }

    .add_to_bag:hover {
      background-color: #C48191;
      /* Darken on hover */
    }

    .icon_badge {
      position: absolute;
      top: 5px;
      right: 5px;
      background-color: #E6A4B4;
      color: white;
      border-radius: 50%;
      width: 15px;
      height: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 10px;
      font-weight: bold;
      /* Ensure badge text is bold */
    }

    .popup_cart {
      display: none;
      position: absolute;
      top: calc(100% + 10px);
      /* Position relative to parent */
      right: 0;
      background-color: white;
      border: 1px solid #ccc;
      padding: 20px;
      width: 300px;
      /* Adjust width as needed */
      box-shadow: 0 8px 10px rgba(0, 0, 0, 0.1);
      z-index: 20;
      font-family: 'Cormorant Garamond', serif;
    }

    .go_to_bag {
      margin-top: 20px;
      /* Adjust margin as needed */
      padding: 10px 20px;
      background-color: #E6A4B4;
      color: black;
      border: none;
      cursor: pointer;
      font-size: 16px;
      width: 100%;
      /* Full width button */
      max-width: 300px;
      /* Limit maximum width of the button */
      display: block;
      /* Ensure it takes full width */
      text-align: center;
      text-decoration: none;
      border-radius: 4px;
    }

    .go_to_bag:hover {
      background-color: #C48191;
      /* Darken on hover */
      text-decoration: none;
    }

    .cart_item {
      display: flex;
      align-items: flex-start;
      margin-bottom: 10px;
      /* Adjust margin as needed */
    }

    .cart_item img {
      width: 80px;
      /* Adjust image size */
      height: 80px;
      /* Adjust image size */
      margin-right: 10px;
      box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.4);
    }

    .item_details {
      flex: 1;
      /* Take remaining space */
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100%;
      /* Ensure it takes full height */
    }

    .item_details h3 {
      margin-top: auto;
      /* Push to bottom */
    }

    .divider {
      height: 2px;
      background-color: #E6A4B4;
      margin-top: 10px;
      /* Adjust margin as needed */
      width: 100%;
      /* Full width */
    }

    .subtotal {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 10px;
      /* Adjust margin as needed */
      padding: 0 20px;
    }

    .subtotal h6 {
      margin: 0;
      font-size: 16px;
    }

    .quantity-control {
      display: flex;
      justify-content: start;
      /* Center align items horizontally */
      align-items: center;
      /* Center align items vertically */
      width: 100%;
      /* Adjust width as needed */
      margin-top: 50px;
      /* Adjust top margin as needed */
    }

    .quantity-btn {
      width: 30px;
      /* Button width */
      height: 30px;
      /* Button height */
      background-color: #E6A4B4;
      border: none;
      color: white;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin: 0 10px;

    }

    .quantity-btn:hover {
      background-color: #C48191;
      /* Darken on hover */
    }

    .quantity-input {
      width: 50px;
      /* Input width */
      height: 30px;
      /* Input height */
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
      /* Highlight on focus */
    }


    .bag_icon_container {
      position: relative;
    }

    .bag_icon_container .fa-shopping-bag {
      position: relative;
    }

    @media (max-width: 767px) {
      .row {
        flex-direction: column;
        /* Stack containers in a column */
        align-items: center;
        /* Center containers horizontally */
      }

      .container {
        width: 100%;
        /* Ensure full width for containers */
        max-width: 100%;
        /* Remove max-width for smaller screens */
        margin: 10px 0;
        /* Adjust vertical margin as needed */
      }

      .menu_container {
        flex-direction: column;
        /* Stack items in a column */
        align-items: center;
        /* Center items horizontally */
        margin: 20px 0;
        /* Adjust vertical margin as needed */
      }

      .nasi_campur {
        width: 100%;
        /* Ensure full width for the image container */
        padding-left: 0;
        /* Remove padding for smaller screens */
      }

      .nasi_campur img {
        max-width: 100%;
        /* Ensure the image scales properly */
      }

      .menu_text {
        max-width: 100%;
        /* Ensure full width for the text container */
        margin-top: 0;
        /* Remove top margin */
        text-align: center;
        /* Center align text */
      }

      .add_to_bag {
        max-width: none;
        /* Remove max-width for full width on smaller screens */
      }

      .go_to_bag {
        max-width: none;
        /* Remove max-width for full width on smaller screens */
      }

      .quantity-control {
        width: 100%;
        justify-content: center;
        margin-top: 20px;
      }

      .quantity-btn {
        width: 40px;
        height: 40px;
        font-size: 20px;
      }

      .quantity-input {
        width: 60px;
        height: 40px;
        font-size: 18px;
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
        <a class="nav-link" href="loggedin.html#contact-section">CONTACT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="search-icon"><i class="fas fa-search"></i></a>
        </li>
        <li class="nav-item position-relative">
          <a class="nav-link" href="payment.php"><i class="fas fa-shopping-bag"></i></a>
        <li class="nav-item">
          <a class="nav-link" href="orderHistory.php"><i class="fas fa-user"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="logout-button">LOG OUT</a>
        </li>
      </ul>
    </div>
  </nav>


  <div class="row">
    <div class="container">
      <div class="product">
        <img src="<?php echo $product['image_path']; ?>" alt="<?php echo $product['name']; ?>" />
      </div>
    </div>


    <div class="container">
      <div class="product_text">
        <h1><?php echo $product['name']; ?></h1>
        <p><?php echo $product['detail']; ?></p>


        <div class="quantity-control">
          <button class="quantity-btn" id="decrease-btn">-</button>
          <input type="number" class="quantity-input" id="quantity-input" value="1" min="1" />
          <button class="quantity-btn" id="increase-btn">+</button>
        </div>

        <p class="price">RM<?php echo $product['price']; ?></p>

        <button class="add_to_bag" id="add-to-bag">ADD TO BAG</button>
      </div>
    </div>
  </div>

  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Function to show/hide cart popup based on item count


      // Add to bag button functionality
      document.getElementById('add-to-bag').addEventListener('click', function() {
        var cartCountElement = document.getElementById('cart-count');
        var currentCount = parseInt(cartCountElement.innerText);
        cartCountElement.innerText = currentCount + 1;


        var popupCartHeader = document.getElementById('popup-cart-header');
        popupCartHeader.innerText = 'MY BAG(' + (currentCount + 1) + ')';
      });

      // Add mouseover and mouseout events to add-to-bag button
      var addToBagBtn = document.getElementById('add-to-bag');
      addToBagBtn.addEventListener('mouseover', function() {
        this.style.fontWeight = 'bold';
      });

      addToBagBtn.addEventListener('mouseout', function() {
        this.style.fontWeight = 'normal';
      });

      // Quantity control functionality
      var quantityInput = document.getElementById('quantity-input');
      var minusButton = document.getElementById('decrease-btn');
      var plusButton = document.getElementById('increase-btn');

      minusButton.addEventListener('click', function() {
        if (parseInt(quantityInput.value) > 0) {
          quantityInput.value = parseInt(quantityInput.value) - 1;
        }
        updatePrice();
      });

      plusButton.addEventListener('click', function() {
        quantityInput.value = parseInt(quantityInput.value) + 1;
        updatePrice();
      });

      quantityInput.addEventListener('input', function() {
        var inputValue = this.value.trim(); // Trim whitespace
        var quantity = parseFloat(inputValue); // Parse as float

        // Validate if quantity is a valid number
        if (isNaN(quantity) || quantity <= 0) {
          quantity = 1; // Default to 1 if not a valid number or less than or equal to 0
          this.value = quantity; // Update input field value
        }

        updatePrice(); // Call function to update price based on new quantity
      });

      // Function to update price and subtotal display
      function updatePrice() {
        var quantity = parseInt(quantityInput.value);
        var pricePerUnit = parseFloat(<?php echo $product['price']; ?>);
        var totalPrice = quantity * pricePerUnit;

        var quantityDisplay = document.getElementById('quantity-display');
        var totalPriceDisplay = document.getElementById('total-price');
        quantityDisplay.textContent = quantity + ' x RM' + pricePerUnit.toFixed(2);
        totalPriceDisplay.textContent = 'RM' + totalPrice.toFixed(2);

        var subtotalValue = document.getElementById('subtotal-value');
        subtotalValue.textContent = 'RM' + totalPrice.toFixed(2);
      }

      // Show cart popup on hover over cart icon
      var cartIcon = document.querySelector('.nav-item.position-relative');
      cartIcon.addEventListener('mouseover', showCartPopup);

      cartIcon.addEventListener('mouseout', function() {
        document.getElementById('popup-cart').style.display = 'none';
      });

      // Initialize dropdown from Bootstrap
      $(document).ready(function() {
        $('.dropdown-toggle').dropdown();
      });

      // Initial call to update price display
      updatePrice();
    });
  </script>
  <script src="homepage.js"></script>
  <script src="cursortrail.js"></script>
  <script type="module">
    // Import the functions you need from the SDKs you need
    import {
      initializeApp
    } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
    import {
      getAuth,
      signInWithEmailAndPassword
    } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
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





  <script>
    document.getElementById('add-to-bag').addEventListener('click', function() {
      var quantity = document.getElementById('quantity-input').value;

      $.ajax({
        type: "POST",
        url: "nasi_campur.php?id=<?php echo $id; ?>", // Ensure this URL is correct
        data: {
          add_to_cart: true,
          quantity: quantity
        },
        dataType: "json",
        success: function(response) {
          if (response.status === 'success') {
            alert(response.message);
            // Optionally update cart count or display confirmation
          } else {
            alert(response.message);
          }
        },

      });
    });
  </script>




</body>

</html>