<?php
// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "webapp") or die("không thể kết nối");
mysqli_query($conn, "SET NAMES 'utf8'");

// Lấy thông tin sản phẩm từ bảng "products"
if (isset($_GET['id'])) {
    $product_id = (int) $_GET['id']; // Lấy ID sản phẩm từ URL
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result !== false && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_name = $row["name"];
        $product_image = $row["image"];
        $product_description = $row["description"];
        $product_price = $row["price"];
        $product_quantity = $row["number"];
    } else {
        echo "Không tìm thấy sản phẩm.";
        exit;
    }
} else {
    echo "Không tìm thấy ID sản phẩm.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Product</title>
    <link rel="stylesheet" href="../style/form_update.css">
</head>
<body>
    <div class="form-container">
        <h2>Update Product</h2>
        <form action="../admin/src_xuli/update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $product_id; ?>">

            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $product_name; ?>" required>

            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image">
            <img src="<?php echo $product_image; ?>" alt="Ảnh sản phẩm" width="100">

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $product_description; ?></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo $product_price; ?>" min="0" step="0.01" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?php echo $product_quantity; ?>" min="1" required>

            <button type="submit">Update Product</button>
            <button type="button"><a href="../admin/src_xuli/Manage.php">Quay lại</a></button>
        </form>
    </div>
</body>
</html>
