<?php
$conn = new mysqli('localhost', 'root', '', 'asmaraloka');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($productId > 0) {
    $sql = "SELECT * FROM product_list WHERE id='$productId'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "Invalid product ID.";
    exit;
}

if (isset($_POST['update_product'])) {
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $productDescription = $_POST['product_description'];
    $productDetail = $_POST['product_detail'];
    $productCategory = $_POST['product_category'];

    
    if (!empty($_FILES['product_image']['name'])) {
        $targetDir = "products/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $targetFile = $targetDir . basename($_FILES["product_image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["product_image"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
                $imagePath = $targetFile;
            } else {
                echo "Sorry, there was an error uploading your file.";
                $imagePath = $product['image_path']; 
            }
        } else {
            echo "File is not an image.";
            $imagePath = $product['image_path']; 
        }
    } else {
        $imagePath = $product['image_path']; 
    }

    $sql = "UPDATE product_list SET name='$productName', price='$productPrice', description='$productDescription', category='$productCategory', detail='$productDetail', image_path='$imagePath' WHERE id='$productId'";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Product updated successfully");</script>';
    } else {
        echo "Error updating product: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <style>
        body {
            min-height: 100vh;
            background: url('image/bgimg.jpg') center/cover;
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            font-family: 'Cormorant Garamond', serif;
        }

        .form-container {
            width: 400px; 
            padding: 40px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            background: white;
        }

        .form-container h2 {
            margin-bottom: 20px;
        }

        .form-container input, .form-container textarea, .form-container select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-container button {
            width: 200px; 
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #555;
        }

        .go-back-button {
            position: absolute;
            right: 20px;
            bottom: 20px;
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .go-back-button:hover {
            background-color: #218838;
        }

        .current-image {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>UPDATE THE PRODUCT</h2>
        <?php if (!empty($product['image_path'])): ?>
            <div class="current-image">
                <img src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="Current Image" style="max-width: 50%; height: auto;">
            </div>
        <?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="product_name" placeholder="Enter product name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            <input type="text" name="product_price" placeholder="Enter product price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            <input type="text" name="product_detail" placeholder="Enter product detail" value="<?php echo htmlspecialchars($product['detail']); ?>" required>
            <input name="product_description" placeholder="Enter product description" value="<?php echo htmlspecialchars($product['description']); ?>" required>
            <select name="product_category" required>
                <option value="">Select a category</option>
                <option value="Catering" <?php if ($product['category'] == 'Catering') echo 'selected'; ?>>Catering</option>
                <option value="Makeup Artist" <?php if ($product['category'] == 'Makeup Artist') echo 'selected'; ?>>Makeup Artist</option>
                <option value="Henna" <?php if ($product['category'] == 'Henna') echo 'selected'; ?>>Henna</option>
                <option value="Gown" <?php if ($product['category'] == 'Gown') echo 'selected'; ?>>Gown</option>
                <option value="Venue" <?php if ($product['category'] == 'Venue') echo 'selected'; ?>>Venue</option>
            </select>
            <input type="file" name="product_image">
            <button type="submit" name="update_product">Update Product</button>
        </form>
        <a href="admin-product.php" class="go-back-button">Go Back</a>
    </div>
</body>
</html>
