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
  <title>Wedding Booking</title>

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playwrite+US+Trad:wght@100..400&display=swap" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="navbar.css" />
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cedarville+Cursive&family=Oswald:wght@200..700&family=Sacramento&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Water+Brush&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
  <script src="custchat.js" defer></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap');

    body {
      padding: 0;
      margin: 0;
      background-image: url('image/bgimg.jpg');


    }

    header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      background: #fff;
      padding: 2rem 9%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      z-index: 1000;
      box-shadow: 0 .5rem 1rem rgba(0, 0, 0, 0.1);
    }

    section {
      padding: 2rem 9%;
    }



    .booking {
      position: relative;
      display: flex;
      align-items: center;
      min-height: 100vh;
      background-size: cover;
      background-position: center;
      justify-content: center;
      text-align: center;


    }

    .home:before {
      z-index: 777;
      content: '';
      position: absolute;
      background: #E6A4B4;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
    }

    .booking .content {
      width: 70%;
      margin-top: 50px;
      color: #fff;
      z-index: 2;

    }

    .booking .content h3 {
      font-size: 5em;
      font-weight: 400;
      color: #fff;
      text-align: center;
      margin-bottom: 40px;
      font-family: "Playwrite US Trad", cursive;
      font-optical-sizing: auto;
      z-index: 2;
    }

    .booking .content span {
      font-size: 2em;
      font-weight: 600;
      color: #e6a4b4;
      padding: 1rem 0;
      line-height: 1;
      letter-spacing: 2px;
      text-align: center;
      font-family: "Montserrat", sans-serif;
    }

    .booking .content p {
      font-size: 20px;
      color: #ffffff;
      padding: 1rem 0;
      line-height: 1.5;
      text-align: center;
      font-family: "Cormorant Garamond", serif;
    }

    .btn {
      display: inline-block;
      margin-top: 1rem;
      border-radius: 5rem;
      background: #333;
      color: #fff;
      padding: .6rem 3rem;
      cursor: pointer;
      font-size: 20px;
      justify-content: center;
      text-align: center;
    }

    .btn:hover {
      background: #E6A4B4;
    }

    .booking video {
      z-index: 000;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .breadcrumb {
      font-size: 10px;
      font-family: Verdana, Geneva, Tahoma, sans-serif;
      color: #bdbdbd;
      background-color: transparent;
      padding-left: 30px;
    }

    .container {
      position: relative;
      padding-top: 40px;
      margin-bottom: 40px;
    }


    .container-venue {
      position: relative;
      padding-top: 40px;
      padding: 60px;
      margin-bottom: 40px;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .image-container {
      position: relative;
      max-width: 100%;
    }

    .container-venue img {
      display: block;
      width: 100%;
      height: auto;
    }

    .text-container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      padding: 20px;
      color: white;
      background-color: rgba(0, 0, 0, 0.3);
    }

    .text-container h2 {
      font-size: 3em;
      font-weight: 900;
      color: #ffffff;
      text-align: center;
      margin-bottom: 40px;
      letter-spacing: 2px;
      font-family: Verdana, Geneva, Tahoma, sans-serif;
    }


    .text-container p {
      margin: 0;
      font-size: 20px;
      color: #ffffff;
      padding: 1rem 0;
      line-height: 1.5;
      text-align: center;
      font-family: "Cormorant Garamond", serif;

    }

    .text-container .btn {
      display: inline-block;
      padding: 0.5rem 1rem;
      outline: none;
      border: none;
      font-weight: 900;
      color: var(--text-dark);
      background-color: black;
      cursor: pointer;
      font-family: "Cormorant Garamond", serif;
    }

    .text-container .btn:hover {
      background-color: #e6a4b4;
    }




    .col {
      display: flex;
      align-items: center;
      justify-content: center;
    }




    .headText {
      font-size: 15px;
      text-align: center;
      letter-spacing: 1px;
      font-family: Georgia, 'Times New Roman', Times, serif;
      font-weight: 100;
      position: relative;
      margin-top: 30px;
      display: inline-block;
      padding: 0 20px;
    }

    .headText::before,
    .headText::after {
      content: "";
      position: absolute;
      top: 50%;
      width: 50%;
      height: 1px;
      background-color: #000000;
    }

    .headText::before {
      left: -55%;
      transform: translateY(-50%);
    }

    .headText::after {
      right: -55%;
      transform: translateY(-50%);
    }

    @media only screen and (max-width: 600px) {

      .headText::before,
      .headText::after {
        width: 30%;
        left: -35%;
        right: -35%;
      }
    }





    .slide-container {
      max-width: 1000px;
      width: 100%;
      background-color: transparent;
      padding: 40px 0;
    }

    .slide-content {
      padding: 45px 20px;
      margin: 0 40px;
      background-color: transparent;
    }

    .swiper-wrapper {
      background-color: transparent;
    }

    .swiper {
      width: 100%;
      max-width: 800px;
      margin: 0 auto;
      padding-bottom: 30px;
      position: relative;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: transparent;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      height: auto;
      object-fit: contain;
      border-radius: 15px;
    }

    @media (max-width: 768px) {
      .swiper {
        max-width: 100%;
      }

      .swiper-slide {
        max-width: 100%;
      }

      .swiper-slide img {
        max-height: 200px;
      }
    }

    .swiper-pagination {
      position: static;
      text-align: center;
      margin-top: 10px;
    }

    .swiper-pagination-bullet {
      height: 7px;
      width: 7px;
      border-radius: 25px;
      background: #E6A4B4;
    }

    .swiper-button-next,
    .swiper-button-prev {
      opacity: 0.7;
      color: #e6a4b4;
      transition: all 0.3s ease;
      width: auto;
      top: 60%;
      transform: translateY(-50%);
      position: absolute;
      z-index: 10;
    }

    .swiper-button-next {
      right: -10px;
    }

    .swiper-button-prev {
      left: -10px;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
      opacity: 1;
      color: #e6a4b4;
    }

    .overlay-text {
      position: absolute;
      bottom: 20px;
      left: 0;
      right: 0;
      text-align: center;
      color: white;
      padding: 10px;
      font-family: "Bebas Neue", sans-serif;
      font-weight: 400;
      font-size: 25px;
      font-style: normal;
    }

    .trailer {
      height: 10px;
      width: 10px;
      border-radius: 50%;
      background: #ffffff;

      position: fixed;
      left: 0px;
      top: 0px;
      z-index: 5;

      mix-blend-mode: difference;
      pointer-events: none;
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
      z-index: 10;
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
      z-index: 10;
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
      text-align: center;
    }

    .chatbot .brand {
      color: white;
      padding-top: 5px;
      font-size: 25px;
      font-family: "Cormorant Garamond", serif;
      text-align: center;
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

    @media (max-width: 768px) {
      .booking {
        background-size: auto;
      }

      .booking .content {
        max-width: 100%;
      }

      .booking .content h3 {
        font-size: 3em;
        margin-bottom: 15px;
        letter-spacing: 0.5px;
      }

      .booking .content span {
        font-size: 1.2em;
        padding: 0.3rem 0;
      }

      .booking .content p {
        font-size: 16px;
        padding: 0.3rem 0;
      }

      .btn {
        padding: 0.5rem 2rem;
        font-size: 16px;
      }



    }


    @media (max-width: 1200px) {
      .text-container h2 {
        font-size: 2.5em;
      }

      .text-container p {
        font-size: 18px;
      }
    }

    @media (max-width: 992px) {
      .container-venue {
        padding: 40px 30px;
      }

      .text-container h2 {
        font-size: 2em;
      }

      .text-container p {
        font-size: 16px;
      }
    }

    @media (max-width: 768px) {
      .container-venue {
        padding: 30px 20px;
      }

      .text-container {
        padding: 15px;
      }

      .text-container h2 {
        font-size: 1.8em;
        margin-bottom: 20px;
      }

      .text-container p {
        font-size: 14px;
      }

      .text-container .btn {
        padding: 0.4rem 0.8rem;
        font-size: 14px;
      }
    }

    @media (max-width: 576px) {
      .container-venue {
        padding: 20px 10px;
      }

      .text-container h2 {
        font-size: 1.5em;
      }

      .text-container p {
        font-size: 12px;
      }

      .text-container .btn {
        padding: 0.3rem 0.6rem;
        font-size: 12px;
      }
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
  </style>

</head>

<body>

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shCzFq6PNUAPOe9xgt7pUyo9gyiJK6yj6y0pX" crossorigin="anonymous"></script>
  <nav class="navbar navbar-expand-md">
    <img src="image/asmaraloka logo.png" alt="Asmaraloka Logo" width="100" height="80" style="padding: 10px;">
    <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <section>
      <div class="trailer" id="trailer"></div>
    </section>
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
            <a class="dropdown-item" href="#"><b>BOOKING</b></a>
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


  <section class="booking" id="booking">
    <video class="video-slider" src="video/booking.mp4" autoplay muted loop></video>

    <div class="content">
      <h3>Plan Your Dream Wedding</h3>
      <span> Book Our Service Now</span>
      <p>Plan your dream wedding with us! Enjoy exclusive wedding packages
        featuring personalized planning, amazing discounts, and 24/7 support.
        From venue selection to wedding services, we handle it all. Make your special day unforgettable. Don't miss out</p>
      <a href="#wedding-services-section" onclick="scrollToBooking()" class="btn">BOOK NOW</a>
    </div>

  </section>

  <div class="container" id="wedding-services-section">
    <div class="col">
      <h1 class="headText mb-4">WEDDING SERVICES</h1>
    </div>
    <div class="swiper mySwiperVendor">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <a href="vendormakan.php"><img src="images/catering slider .png" alt="catering"></a>
        </div>
        <div class="swiper-slide">
          <a href="makeup.php"><img src="images/mua slider.png" alt="mua"></a>
        </div>
        <div class="swiper-slide">
          <a href="henna.php"><img src="images/henna slider.png" alt="henna">
        </div>
        <div class="swiper-slide">
          <a href="gownlist.php"><img src="products/gown-booking.png" alt="gown"></a>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>


  <div class="container-venue">
    <div class="image-container">
      <img src="products/theArkEvent.jpg" alt="Perak Image">
      <div class="text-container">
        <h2>UNFORGETTABLE WEDDINGS AT ASMARALOKA</h2>
        <p>Celebrate your special day in the enchanting setting of Asmaraloka.
          Our exquisite venue offers the perfect backdrop for your dream wedding,
          with elegant spaces, exceptional service, and attention to every detail.
          Let us make your wedding a truly unforgettable experience.
        </p>
        <a href="venuelist.php" class="btn btn-venue">See More</a>
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

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
      var swiperVendor = new Swiper(".mySwiperVendor", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });

      var swiperVenue = new Swiper(".mySwiperVenue", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });

      $(document).ready(function() {
        $('.dropdown-toggle').dropdown();
      });
      const trailer = document.getElementById("trailer");

      const animateTrailer = (e, interacting) => {
        const x = e.clientX - trailer.offsetWidth - 10;
        const y = e.clientY - trailer.offsetHeight - 10;
        const offSetCorrection = 15;

        const keyframes = {
          transform: `translate(
                  ${interacting ? x + offSetCorrection : x}px, 
                  ${interacting ? y + offSetCorrection : y}px) 
                  scale(${interacting ? 5 : 1})`,
        };

        trailer.animate(keyframes, {
          duration: 1000,
          fill: "forwards",
        });
      };

      window.onmousemove = (e) => {
        const interactable = e.target.closest(".interactable"),
          interacting = interactable !== null;
        animateTrailer(e, interacting);
      };
    </script>

    <script>
      function scrollToBooking() {
        var contactSection = document.getElementsById('wedding-services-section');
        contactSection.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }

      function switchForm() {
        const wrapper = document.querySelector('.wrapper');
        wrapper.classList.toggle('active');
      }
    </script>
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

      document.getElementById('logout-button').addEventListener('click', function() {
        auth.signOut().then(() => {
          alert('You have been logged out.');
          window.location.href = 'index.html';
        }).catch((error) => {
          alert('Error logging out: ' + error.message);
        });
      });
    </script>
</body>
</html>