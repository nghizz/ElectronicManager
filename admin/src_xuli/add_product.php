<?php

$conn = mysqli_connect("localhost", "root", "", "webapp") or die("không thể kết nối");
mysqli_query($conn, "SET NAMES 'utf8'");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Handle file upload
    if ($_FILES["image"]["error"] == 4) {
        echo "<script>alert('Hình ảnh không tồn tại');</script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Định dạng hình ảnh không hợp lệ');</script>";
        } elseif ($fileSize > 5000000) {
            echo "<script>alert('Kích thước hình ảnh quá lớn');</script>";
        } else {
            $targetDirectory = "uploads/";
            $newImageName = uniqid() . '.' . $imageExtension;
            $targetFile = $targetDirectory . $newImageName;

            if (move_uploaded_file($tmpName, $targetFile)) {
                $sql = "INSERT INTO products (name, image, description, price, number)
                VALUES ('$name', '$targetFile', '$description', $price, $quantity)";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Thêm sản phẩm thành công'); window.location='../formadd_product.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "<script>alert('Xin lỗi, đã xảy ra lỗi khi tải tệp của bạn lên.');</script>";
            }
        }
    }
}
