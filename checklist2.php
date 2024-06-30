<?php
$sname = "localhost";
$username = "root";
$password = "";
$db_name = "asmaraloka";

try {
  $conn = new PDO(
    "mysql:host=$sname;dbname=$db_name",
    $username,
    $password
  );
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed : " . $e->getMessage();
}


//add task
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['title']) && !empty($_POST['title'])) {
    $title = $_POST['title'];
    $group_id = $_POST['group_id']; // Get the selected group ID
    $date_time = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("INSERT INTO task(title, group_id, date_time) VALUES(?,?,?)");
    $stmt->execute([$title, $group_id, $date_time]); // Add task to the specified group
    header("Location: checklist.php?mess=success");
  }
}

// add category
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['group_name']) && !empty($_POST['group_name'])) {
    if (isset($_POST['group_id']) && !empty($_POST['group_id'])) {
      // Update existing category
      $group_id = $_POST['group_id'];
      $group_name = $_POST['group_name'];
      $stmt = $conn->prepare("UPDATE groups SET name = :name WHERE id = :id");
      $stmt->bindParam(':name', $group_name);
      $stmt->bindParam(':id', $group_id);
      $stmt->execute();
    } else {
      // Add new category
      $group_name = $_POST['group_name'];
      $stmt = $conn->prepare("INSERT INTO groups (name) VALUES (:name)");
      $stmt->bindParam(':name', $group_name);
      $stmt->execute();
    }
    header("Location: checklist.php?mess=success");
  } else {
    // header("Location: checklist.php?mess=error");
  }
} else {
  // header("Location: checklist.php?mess=error"); // Redirect if accessed directly without POST method
}

//rename
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['id']) && isset($_POST['name'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];

  if (empty($id) || empty($name)) {
    echo 0;
  } else {
    $stmt = $conn->prepare("UPDATE groups SET name=? WHERE id=?");
    $res = $stmt->execute([$name, $id]);
  }
} else {
  // echo 0;
}
// }

//remove task
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['id'])) {
  $id = $_POST['id'];

  if (empty($id)) {
    echo 0;
  } else {
    $stmt = $conn->prepare("DELETE FROM task WHERE id=?");
    $res = $stmt->execute([$id]);

    if ($res) {
      echo 1;
    } else {
      // echo 0;
    }
    $conn = null;
  }
} else {
  // header("Location: ../checklist.php?mess=error");
}
// }


///remove_group/category
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $stmt = $conn->prepare("DELETE FROM groups WHERE id = ?");
  $res = $stmt->execute([$id]);

  if ($res) {
      echo 'success';
  } else {
      echo 'error';
  }
}

?>

<style><?php include 'checklist.css'; ?></style>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Checklist</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="checklist.css" />
  <link rel="stylesheet" type="text/css" href="navbar.css" />
  <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" /> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
  <script type="module" src="login.js" defer></script>
  <script type="module" src="homepage.js" defer></script>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");
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
          <a class="nav-link" href="#about-section">ABOUT</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            SERVICES
          </a>
          <div class="dropdown-menu" style="background-color: #eed1d5" aria-labelledby="servicesDropdown">
            <a class="dropdown-item" href="checklist.php"><b>CHECKLIST</b></a>
            <a class="dropdown-item" href="booking.php"><b>BOOK</b></a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact-section" onclick="scrollToContact()">CONTACT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="search-icon"><i class="fas fa-search"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="payment.html"><i class="fas fa-shopping-bag"></i></a>
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

  <div class="custom-container">
    <h1>To Your Wedding Day</h1>
    <div id="countdown" class="countdown">
      <div class="time">
        <h2 id="days"></h2>
        <small>Days</small>
      </div>

      <div class="time">
        <h2 id="hours"></h2>
        <small>Hours</small>
      </div>

      <div class="time">
        <h2 id="minutes"></h2>
        <small>Minutes</small>
      </div>

      <div class="time">
        <h2 id="seconds"></h2>
        <small>Seconds</small>
      </div>
    </div>

    <button class="edit-button" type="button">Edit</button>
  </div>

  <div class="custom-container2">
    <h1>WEDDING CHECKLIST</h1>
    <button class="add-button" data-toggle="modal" data-target="#addTaskModal">
      Add task</button>
    <button class="print-button" onclick="window.print()">
      <i class="fas fa-print"></i> Print Your Progress
    </button>


    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!-- add button at bottom right -->
          <div class="add-section mb-4">

            <!-- Modal -->
            <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-body">

                    <form action="checklist.php" method="POST" autocomplete="off" class="form-inline justify-content-center">
                      <div class="input-group">
                        <input type="hidden" name="action" value="add_group">
                        <input type="text" name="group_name" class="form-control mr-2 mb-2" style="text-transform: none" placeholder="Add a new category">
                        <div class="input-group-append">
                          <button type="submit" class="btnbtn-sm mb-1" style="border-radius: 5px!important;">
                            <i class="fas fa-plus icon-placeholder"></i>
                          </button>
                        </div>
                      </div>
                    </form>

                    <!-- Add some space between the forms -->
                    <div class="mb-2"></div>
                    <form action="checklist.php" method="POST" autocomplete="off" class="form-inline">
                      <div class="input-group">
                        <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                          <input type="text" name="title" class="form-control mb-2 is-invalid" style="text-transform: none" placeholder="This field is required">
                        <?php } else { ?>
                          <input type="text" name="title" class="form-control mb-2" style="text-transform: none" placeholder="What do you need to do?">
                        <?php } ?>
                        <select name="group_id" class="form-control mb-2 ml-2" onchange="this.options[0].style.display='none'" style="padding: 5px;">
                          <option value="" selected disabled>Category</option>
                          <?php
                          $groups = $conn->query("SELECT * FROM groups ORDER BY id DESC");
                          while ($group = $groups->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"" . $group['id'] . "\">" . $group['name'] . "</option>";
                          }
                          ?>
                        </select>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-sm mb-1">
                            <i class="fas fa-plus icon-placeholder"></i>
                          </button>
                        </div>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
            </div>

          </div>

          <?php
          // Fetch groups and their respective todos
          $groups = $conn->query("SELECT * FROM groups ORDER BY id DESC");
          ?>

          <div class="row show-groups-section">
            <?php while ($group = $groups->fetch(PDO::FETCH_ASSOC)) { ?>
              <div class="col-md-6 mb-4">
                <div class="group-item card">
                  <div class="card-body">
                    <h5 class="card-title">
                      <!-- <?php echo $group['name']; ?> -->
                      <span class="group-name" contenteditable="false"><?php echo $group['name']; ?></span>
                      <img src="images/bin.png" alt="Remove" class="remove-group float-right" data-group-id="<?php echo $group['id']; ?>" style="width: 20px; cursor: pointer; margin-left: 10px;">
                      <img src="images/pencil.png" alt="Edit" class="edit-group float-right" data-group-id="<?php echo $group['id']; ?>" style="width: 20px; cursor: pointer;">

                    </h5>
                    <?php
                    $group_id = $group['id'];
                    $todos = $conn->query("SELECT * FROM task WHERE group_id=$group_id ORDER BY id DESC");
                    ?>
                    <div class="show-todo-section">
                      <?php if ($todos->rowCount() <= 0) { ?>

                        <div class="todo-item">
                          <div class="empty">
                            <p>No current tasks</p>
                          </div>
                        </div>
                      <?php } ?>

                      <?php while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class="todo-item">
                          <div class="form-check">
                            <span id="<?php echo $todo['id']; ?>" class="remove-to-do">
                              <img src="images/x.png" alt="X icon" style="width: 15px;">
                            </span>
                            <input type="checkbox" class="form-check-input check-box" data-todo-id="<?php echo $todo['id']; ?>" <?php echo $todo['checked'] ? 'checked' : ''; ?> />
                            <label class="form-check-label <?php echo $todo['checked'] ? 'checked' : ''; ?>" for="checkbox"><?php echo $todo['title'] ?></label>
                          </div>
                        </div>
                      <?php } ?>

                      <!-- add task to specific group (backup at word) -->

                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>

        </div>
      </div>
    </div>

   <!-- Modal for Group Deletion Confirmation -->
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
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
      $(document).ready(function() {

        // Enable inline editing
        $('.edit-group').click(function() {
          const id = $(this).attr('data-group-id');
          const groupNameElement = $(this).siblings('.group-name');

          groupNameElement.attr('contenteditable', 'true').focus();
          groupNameElement.data('original-text', groupNameElement.text());

          groupNameElement.on('blur', function() {
            groupNameElement.attr('contenteditable', 'false');
            const newName = groupNameElement.text();
            const originalText = groupNameElement.data('original-text');

            if (newName && newName !== originalText) {
              $.post('checklist.php', {
                id: id,
                name: newName
              }, (data) => {
                if (data == 1) {
                  groupNameElement.text(newName);
                } else {
                  // alert('Error renaming the group.');
                  groupNameElement.text(originalText); // Revert to original text if there's an error
                }
              });
            } else {
              groupNameElement.text(originalText); // Revert if no changes were made
            }
          });
        });

        // Remove group confirmation modal handling
        $('.remove-group').click(function(e) {
        e.preventDefault(); // Prevent default action

        const groupId = $(this).data('group-id');
        console.log('Group ID to delete:', groupId); // Debugging line

        $.post('checklist.php', {
            id: groupId
        }, function(data) {
            console.log('Response from server:', data); // Debugging line
            if (data == 1) {
                // Remove the group item from the DOM
                $(`.group-item[data-group-id="${groupId}"]`).remove();
                // Optionally show a success message
                // alert('Category has been deleted');
            } else {
                alert('Failed to delete group');
            }
        });
    });
        //remove task
        $('.remove-to-do').click(function() {
          const id = $(this).attr('id');

          $.post("checklist.php", {
              id: id
            },
            (data) => {
              if (data) {
                $(this).parent().hide(0);
              }
            }
          );
        });

        // Auto capitalize the group input
        $('#group_name').on('input', function() {
          let value = $(this).val();
          $(this).val(value.replace(/\b\w/g, function(l) {
            return l.toUpperCase();
          }));
        });

        //check
        $(".check-box").click(function(e) {
          const id = $(this).attr('data-todo-id');

          $.post('check.php', {
              id: id
            },
            (data) => {
              if (data != 'error') {
                const label = $(this).next('label');
                if (data === '1') {
                  label.removeClass('checked');
                } else {
                  label.addClass('checked');
                }
              }
            }
          );
        });
      });
    </script>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="jquery.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="countdown.js"></script>
  <script src="cursortrail.js"></script>
  <script type="module">
    // Import the functions you need from the SDKs you need
    import {
      initializeApp
    } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
    import {
      getAuth,
      signInWithEmailAndPassword,
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
      appId: "1:504684998639:web:0dcf7393f9b928e4f0901a",
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);
    console.log("Firebase has been initialized successfully.");

    // Logout functionality
    document
      .getElementById("logout-button")
      .addEventListener("click", function() {
        auth
          .signOut()
          .then(() => {
            // Sign-out successful.
            alert("You have been logged out.");
            window.location.href = "index.html"; // Redirect to login page
          })
          .catch((error) => {
            // An error happened.
            alert("Error logging out: " + error.message);
          });
      });

    document.getElementById('search-icon').addEventListener('click', function() {
      var searchForm = document.getElementById('search-form');
      if (searchForm.style.display === 'none' || searchForm.style.display === '') {
        searchForm.style.display = 'block';
      } else {
        searchForm.style.display = 'none';
      }
    });
  </script>
</body>
<style>
  @import url("https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");
</style>


</html>