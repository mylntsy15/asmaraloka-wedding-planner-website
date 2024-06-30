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
    <link rel="stylesheet" href="server_list_req.css">
    <script type="module" src="registeradmin.js" defer></script>
    <script type="module" src="loginadmin.js" defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap');

        .refundStatus-pending {
            text-align: center;
            color: black;
            font-weight: bold;
            background-color: rgb(237, 237, 146);
        }

        .refundStatus-approved {
            text-align: center;
            color: black;
            font-weight: bold;
            background-color: rgb(80, 231, 80);
        }

        .refundStatus-reject {
            text-align: center;
            color: black;
            font-weight: bold;
            background-color: red;
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
<script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shCzFq6PNUAPOe9xgt7pUyo9gyiJK6yj6y0pX"
        crossorigin="anonymous"></script>
    <section>
        <div class="trailer" id="trailer"></div>
    </section>

    <aiside class="sidebar">
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
                <a href="admin-product.php"><span class="material-symbols-outlined">list_alt</span>Products</a>
            </li>
            <li>
                <a href="chatbox-seller.html"><span class="material-symbols-outlined">Headset_Mic</span>Customer
                    Chat</a>
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
    </aiside>

    
    <div class="container-center">
        <h1 class="title">Refund List Request</h1>
        <main class="table">
            <section class="table_body">
                <table>
                    <thead>
                        <tr>
                            <th>Refund Id</th>
                            <th>Order Id</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Action</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $con = mysqli_connect("localhost", "root", "", "asmaraloka");


                        
                        if ($con->connect_error) {
                            die("Connection failed: " . $con->connect_error);
                        }

                        
                        $sql = "SELECT * FROM refund_request";
                        $result = $con->query($sql);

                        
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['refund_id'] . "</td>";
                                echo "<td>" . $row['order_id'] . "</td>";
                                echo "<td>" . $row['item'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td>RM " . number_format($row['amount'], 2) . "</td>";
                                echo '<td><a href="chatbox-seller.html"><i class="fas fa-comment-dots icon-chat"></i></a></td>';
                                $refundStatus_class = '';
                                switch ($row['refundStatus']) {
                                    case 'Pending':
                                        $refundStatus_class = 'refundStatus-pending';
                                        break;
                                    case 'Approved':
                                        $refundStatus_class = 'refundStatus-approved';
                                        break;
                                    case 'Rejected':
                                        $refundStatus_class = 'refundStatus-reject';
                                        break;
                                }
                                echo "<td class='" . $refundStatus_class . "'>" . $row['refundStatus'] . "</td>";
                                echo '<td>';
                                // Approve button
                                echo '<button class="btn btn-success btn-approve" data-refund-id="' . $row['refund_id'] .  '" data-order-id="' . $row['order_id'] . '">Approve</button>';
                                // Reject button
                                echo '<button class="btn btn-danger btn-reject" data-refund-id="' . $row['refund_id'] .   '" data-order-id="' . $row['order_id'] . '">Reject</button>';
                                echo '</td>';
                                echo "</tr>";
                            }
                        } else {
                            echo "No refund requests found.";
                        }


                        $con->close();
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
    <script>
        $(document).ready(function() {
            
            $('.btn-approve').click(function() {
                var refundId = $(this).data('refund-id');
                var orderId = $(this).data('order-id');
                updateRefundStatus(refundId, 'Approved', orderId);
            });

            
            $('.btn-reject').click(function() {
                var refundId = $(this).data('refund-id');
                var orderId = $(this).data('order-id');
                updateRefundStatus(refundId, 'Rejected', orderId);
            });

            
            function updateRefundStatus(refundId, status, orderId) {
                $.ajax({
                    url: 'update_refund_status.php',
                    type: 'POST',
                    data: {
                        refund_id: refundId,
                        status: status,
                        order_id: orderId,
                    },
                    success: function(response) {
                        
                        alert('Refund status updated successfully!');
                        location.reload(); 
                    },
                    error: function(xhr, status, error) {
                        
                        alert('Error occurred while updating refund status.');
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    </script>
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

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);
        console.log("Firebase has been initialized successfully.");

        // Logout functionality
        document.getElementById('logout-button').addEventListener('click', function () {
            auth.signOut().then(() => {
                // Sign-out successful.
                alert('You have been logged out.');
                window.location.href = 'admin_home.html'; // Redirect to login page
            }).catch((error) => {
                // An error happened.
                alert('Error logging out: ' + error.message);
            });
        });
    </script>

</body>
</html>