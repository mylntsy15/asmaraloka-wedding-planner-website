<?php
@include 'config.php';

if (isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];
    $sql = "DELETE FROM product_list WHERE id = '$product_id'";
    if ($conn->query($sql) === TRUE) {
        $message[] = ['type' => 'success', 'text' => 'Product deleted successfully'];
    } else {
        $message[] = ['type' => 'error', 'text' => 'Error deleting product: ' . $conn->error];
    }
}

if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_desc = $_POST['product_desc'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_detail = $_POST['product_detail'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'products/' . $product_image;

    if (empty($product_name) || empty($product_desc) || empty($product_price) || empty($product_category) || empty($product_image) || empty($product_detail)) {
        $message[] = ['type' => 'warning', 'text' => 'Please fill out all fields.'];
    } else {
        if (move_uploaded_file($product_image_tmp_name, $product_image_folder)) {
            $sql = "INSERT INTO product_list (image_path, name, description, price, detail, category) VALUES ('$product_image_folder', '$product_name', '$product_desc', '$product_price','$product_detail', '$product_category')";
            if ($conn->query($sql) === TRUE) {
                $message[] = ['type' => 'success', 'text' => 'New product added successfully'];
            } else {
                $message[] = ['type' => 'warning', 'text' => 'Error: ' . $sql . '<br>' . $conn->error];
            }
        } else {
            $message[] = ['type' => 'warning', 'text' => 'Failed to upload image'];
        }
    }
}

$search_query = "";
if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
    $search_query = "WHERE name LIKE '%" . $search_term . "%' OR description LIKE '%" . $search_term . "%' OR category LIKE '%" . $search_term . "%'";
}

$product_query = "SELECT * FROM product_list $search_query";
$product_result = $conn->query($product_query);

$conn->close();


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
    <link rel="stylesheet" href="sidebar.css">
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
        display: flex;
        text-align: left;
    }

    .container-center {
        flex-grow: 1;
        padding: 20px;
        transition: margin-left 0.4s ease, width 0.4s ease;
        margin-left: 75px;
        width: calc(100% - 75px);
        
    }

    .sidebar:hover~.container-center {
        margin-left: 260px;
        width: calc(100% - 260px);
    }

    .title {
        font-size: 30px;
        padding: 20px 30px 10px 30px;
    }

    .form-container {
        width: 500px;
        margin: 20px 20px 20px 25px; 
        padding: 40px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        background-color: white;
    }

    .form-container h2 {
        margin-bottom: 20px;
    }

    .form-container input {
        width: calc(100% - 22px);
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-container select {
        width: calc(100% - 22px);
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-container button {
        width: calc(100% - 22px);
        padding: 10px;
        margin-bottom: 10px;
        border: none;
        border-radius: 5px;
        background-color: #333;
        color: #fff;
        cursor: pointer;
    }

    .form-container button:hover {
        background-color: #e6a4b4;
    }

    .form-container a button {
        background-color: #28a745;
    }

    .form-container a button:hover {
        background-color: #e6a4b4;
    }

    .table_header {
        margin-top: 20px; /* Adjust margin as needed */
        margin-bottom: 20px;
    }

    .table_body {
        margin-top: 10px; 
    }

    .table_body::-webkit-scrollbar {
        width: 0.5rem;
        height: 0.5rem;
    }

    .table_body::-webkit-scrollbar-thumb {
        border-radius: .5rem;
        background-color: black;
        visibility: hidden;
    }

    .table_body:hover::-webkit-scrollbar-thumb {
        visibility: visible;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    
    }

    th, td {
        padding: 1rem;
        text-align: center;
        
    }

    thead th {
        position: sticky;
        top: 0;
        background-color: #eed1d5;
        padding-right: 0;
    }


    th.action-header, td.action-column {
        width: 10%; 
        text-align: center;
    }

    tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    tbody tr:hover {
        background-color: #e6a4b4;
    }

    td .action-buttons {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-direction: column;
    }

    td .action-buttons button {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    td .action-buttons button.edit {
        background-color: #28a745;
        color: #fff;
        width: 200px;
    }

    td .action-buttons button.delete {
        background-color: #dc3545;
        color: #fff;
        width: 200px;
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

    .user-profile h3 {
        font-size: 1rem;
        font-weight: 650;
    }

    .user-profile span {
        font-size: 0.775rem;
        font-weight: 600;
        margin-top: 0;
    }

    .sidebar:hover .user-account {
        background: #e6a4b4;
        border-radius: 4px;
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

    <!-- Content -->
    <!-- Content -->
<div class="container-center">
    <h1 class="title">Add Product</h1>

    <div class="form-container">
        <?php
        if (isset($message)) {
            foreach ($message as $msg) {
                echo '<div class="alert alert-' . $msg['type'] . '">' . $msg['text'] . '</div>';
            }
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="product_name" placeholder="Enter product name" required>
            <input type="text" name="product_desc" placeholder="Enter product description" required>
            <input type="text" name="product_detail" placeholder="Enter product detail" required>
            <input type="text" name="product_price" placeholder="Enter product price" required>
            <input type="file" accept="products/png, products/jpeg, products/jpg" name="product_image" required>
            <select name="product_category" required>
                <option value="">Select a category</option>
                <option value="Catering">Catering</option>
                <option value="Makeup Artist">Makeup Artist</option>
                <option value="Gown">Gown</option>
                <option value="Henna">Henna</option>
                <option value="Venue">Venue</option>
            </select>
            <button type="submit" name="add_product">Add Product</button>
        </form>
    </div>
    <h1 class="title">Product List</h1>
    
    <div class="table_header">

        <div class="form-container">
    <form action="" method="GET">
        <input type="text" name="search" placeholder="Search products...">
        <button type="submit">Search</button>
    </form>
</div>
    
    <main class="table_body">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($product_result->num_rows > 0) {
                    while ($row = $product_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='" . $row['image_path'] . "' alt='" . $row['name'] . "' width='50'></td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $row['category'] . "</td>";
                        echo "<td>
                                 <div class='action-buttons'>
                                     <a href='updateproduct.php?id=" . $row['id'] . "'><button class='edit'>Edit</button></a>
                                     <form method='POST' action='' style='display:inline;'>
                                         <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                                         <button type='submit' name='delete_product' class='delete'>Delete</button>
                                     </form>
                                 </div>
                               </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</div>

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