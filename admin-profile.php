<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bag - ASMARALOKA</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="navbar.css" />
    
    <link rel="stylesheet" type="text/css" href="sidebar.css">
    <script type="module" src="registeradmin.js" defer></script>
    <script type="module" src="loginadmin.js" defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">

    <style>
       @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background-image: url('image/bgimg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
            text-align: left;
        }

        .sidebar:hover~.container-center {
            margin-left: 260px;
            width: calc(100% - 260px);
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 75px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: rgb(22, 21, 21);
            padding: 25px 20px;
            transition: all 0.4s ease;
            z-index: 1;
        }

        .sidebar:hover {
            width: 260px;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
        }

        .sidebar-header img {
            width: 45px;
            border-radius: 50%;
        }

        .sidebar-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            font-family: 'Cormorant Garamond', serif;
            color: #fff;
            margin-left: 15px;
            margin-top: 8px;
        }

        .sidebar-links {
            list-style: none;
            margin-top: 20px;
        }

        .sidebar-links h4 {
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            margin: 10px 0;
            margin-left: 10px;
            white-space: nowrap;
            position: relative;
        }

        .sidebar-links h4 span {
            opacity: 0;
        }

        .sidebar:hover .sidebar-links h4 span {
            opacity: 1;
        }

        .sidebar-links .menu-separator {
            position: absolute;
            left: 0;
            right: 0;
            top: 20px;
            transform: translateY(-50%);
            height: 1px;
            background-color: #ffffff;
            transform-origin: center;
            transition-duration: 0.2s;
        }

        .sidebar:hover .sidebar-links .menu-separator {
            transition-delay: 0s;
            transform: scaleX(0);
        }

        .sidebar-links li a {
            display: flex;
            align-items: center;
            gap: 0 20px;
            color: #e6a4b4;
            font-weight: 500;
            padding: 15px 10px;
            white-space: nowrap;
            text-decoration: none;
        }

        .sidebar-links li a:hover {
            background: #e6a4b4;
            color: #fff;
            border-radius: 4px;
        }

        .user-account {
            margin-top: auto;
            padding: 12px 10px;
            margin-left: -10px;
        }

        .user-account .user-profile {
            display: flex;
            align-items: center;
            color: #fff;
        }

        .user-profile img {
            width: 42px;
            border-radius: 50%;
        }

        .user-detail {
            margin-left: 23px;
            white-space: nowrap;
        }

        .sidebar:hover .user-account {
            background: #e6a4b4;
            border-radius: 4px;
        }

        .container-center {
            flex-grow: 1;
            transition: margin-left 0.4s ease, width 0.4s ease;
            margin-left: 75px;
            width: calc(100% - 75px);
            padding: 20px;
        }

        .white-container {
            background-color: #fff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: calc(100% - 40px);
            text-align: left;
            font-family: 'Cormorant Garamond', serif;
            height: 680px;
        overflow-y: auto;
        }

        .white-container-inner {
            width: 100%;
            max-width: 800px;
        }

        .profile-header {
            width: 100%;
            text-align: left;
        }

        .profile-header h3 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .profile-info {
            display: flex;
            align-items: center;
        }

        .profile-info img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin-right: 20px;
            border: 5px solid pink;
        }

        .profile-details h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: black;
            margin-top: 10px;
            font-family: 'Cormorant Garamond', serif;
        }

        .title {
            font-size: 30px;
            padding: 20px 30px 10px 30px;
        }
        
    </style>
</head>

<body>
    <section>
        <div class="trailer" id="trailer"></div>
    </section>

    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="images/sidebar-logo.png" alt="LOGO">
            <h2>ASMARALOKA</h2>
        </div>
        <ul class="sidebar-links">
            <h4>
                <span>Main Menu</span>
            </h4>
            <li>
                <a href="server_list_req2.php"><span class="material-symbols-outlined">Dashboard</span>Dashboard</a>
            </li>
            <li>
                <a href="#"><span class="material-symbols-outlined">list_alt</span>Products</a>
            </li>
            <li>
                <a href="chatbox-seller.html"><span class="material-symbols-outlined">Headset_Mic</span>Customer Chat</a>
            </li>

            <h4>
                <span>Account</span>
                <div class="menu-separator"></div>
            </h4>
            <li>
                <a href="admin-profile.php"><span class="material-symbols-outlined">account_circle</span>Profile</a>
            </li>
            <li>
                <a href="settingadmin.html"><span class="material-symbols-outlined">settings</span>Settings</a>
            </li>
            <li>
                <a href="#" id="logout-button"><span class="material-symbols-outlined">logout</span>Logout</a>
            </li>
        </ul>

        <div class="user-account">
            <div class="user-profile">
                <img src="images/admin-profile.jpg" alt="admin profile">
                <div class="user-detail">
                    <h3>Shaf Jeffery</h3>
                    <span>Asmaraloka Admin</span>
                </div>
            </div>
        </div>
    </aside>

    
    <div class="container-center">
        <div class="white-container">
            <div class="white-container-inner">
                <div class="title" style="font-family: arial,;">Admin Profile</div>
                <div class="profile-header">
                    <div class="profile-info">
                        <img src="images/admin-profile.jpg" alt="Admin profile">
                        <div class="profile-details">
                            <h2 style="font-family: arial">SHAF JEFFERY</h2>
                            <span style="font-family: arial;">Asmaraloka Admin</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shCzFq6PNUAPOe9xgt7pUyo9gyiJK6yj6y0pX" crossorigin="anonymous"></script>

    <script src="homepage.js"></script>
    <script src="cursortrail.js"></script>
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
        import { getAuth, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js";

        const firebaseConfig = {
            apiKey: "AIzaSyDb6Z_pskUUnt3QDGiEJ6cs416aijWLd0w",
            authDomain: "asmaraloka-admin.firebaseapp.com",
            projectId: "asmaraloka-admin",
            storageBucket: "asmaraloka-admin.appspot.com",
            messagingSenderId: "979622171057",
            appId: "1:979622171057:web:9e011fb238a92e13a3ad90"
        };

        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);
        console.log("Firebase has been initialized successfully.");

        document.getElementById('logout-button').addEventListener('click', function () {
            auth.signOut().then(() => {
                alert('You have been logged out.');
                window.location.href = 'admin_home.html';
            }).catch((error) => {
                alert('Error logging out: ' + error.message);
            });
        });
    </script>
</body>
</html>
