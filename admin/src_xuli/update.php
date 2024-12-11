<?php

$conn = mysqli_connect("localhost", "root", "", "webapp") or die("không thể kết nối");
mysqli_query($conn, "SET NAMES 'utf8'");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Handle file upload
    if ($_FILES["image"]["error"] == 4) {
        // No new image uploaded, keep the old one
        $sql = "UPDATE products SET name='$name', description='$description', price=$price, number=$quantity WHERE id=$id";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Định dạng hình ảnh không hợp lệ'); window.location='../src/form_update.php?id=$id';</script>";
            exit;
        } elseif ($fileSize > 5000000) {
            echo "<script>alert('Kích thước hình ảnh quá lớn'); window.location='../src/form_update.php?id=$id';</script>";
            exit;
        } else {
            $targetDirectory = "uploads/";
            $newImageName = uniqid() . '.' . $imageExtension;
            $targetFile = $targetDirectory . $newImageName;

            if (move_uploaded_file($tmpName, $targetFile)) {
                // Delete the old image from server
                $oldImageQuery = "SELECT image FROM products WHERE id=$id";
                $oldImageResult = $conn->query($oldImageQuery);
                if ($oldImageResult !== false && $oldImageResult->num_rows > 0) {
                    $oldImageRow = $oldImageResult->fetch_assoc();
                    $oldImagePath = $oldImageRow['image'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $sql = "UPDATE products SET name='$name', image='$targetFile', description='$description', price=$price, number=$quantity WHERE id=$id";
            } else {
                echo "<script>alert('Xin lỗi, đã xảy ra lỗi khi tải tệp của bạn lên.'); window.location='../src/form_update.php?id=$id';</script>";
                exit;
            }
        }
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Cập nhật sản phẩm thành công'); window.location='../src_xuli/Manage.php#products';</script>";
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }
}

$conn->close();
