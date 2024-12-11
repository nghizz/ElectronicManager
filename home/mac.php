<?php
session_start();

// Kết nối tới cơ sở dữ liệu MySQL
$conn=mysqli_connect("localhost","root","","webapp") or die("không thể kết nối");
mysqli_query($conn,"SET NAMES 'utf8'");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");

// Xử lý thêm sản phẩm vào giỏ hàng
if (isset($_GET["action"]) && $_GET["action"] == "add" && isset($_GET["id"])) {
    $product_id = intval($_GET["id"]);
    if ($product_id > 0) {
        if (isset($_SESSION["cart"][$product_id])) {
            $_SESSION["cart"][$product_id]++;
        } else {
            $_SESSION["cart"][$product_id] = 1;
        }
    }
}

// Lấy thông tin sản phẩm từ database
$searchTerm = "MAC";

// Truy vấn dữ liệu từ cơ sở dữ liệu
$sql = "SELECT * FROM products WHERE name LIKE '%$searchTerm%'";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>L2N SHOP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #6a89cc, #b8e994);
            margin: 0;
            padding: 0;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .product-card {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>
    <div class="hbot">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">L2N SHOP</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nvbar" aria-controls="nvbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="nvbar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item">
                            <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
                                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Tìm kiếm..." aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm</button>
                            </form>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="phone.php">Điện thoại</a></li>
                        <li class="nav-item"><a class="nav-link" href="mac.php">Laptop</a></li>
                        <li class="nav-item"><a class="nav-link" href="phukien.php">Phụ kiện</a></li>
                        <li class="nav-item">
                            <a href="cart.php" class="btn btn-primary">Giỏ hàng</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4'>";
                        echo "<a href='details.php?id=" . $row["id"] . "' class='product-card'>";
                        echo "<div class='card'>";
                        echo "<img src='" . $row["image"] . "' alt='" . $row["name"] . "' class='card-img-top'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . $row["name"] . "</h5>";
                        echo "<p class='card-text'>Giá: " . $row["price"] . " VND</p>";
                        echo "<a href='?action=add&id=" . $row["id"] . "' class='btn btn-success'>Mua ngay</a> ";
                        echo "<a href='?action=add&id=" . $row["id"] . "' class='btn btn-info'>Thêm vào giỏ hàng</a>";
                        echo "</div>";  // Close card-body
                        echo "</div>";  // Close card
                        echo "</a>";
                        echo "</div>";  // Close col-md-4
                    }
                } else {
                    echo "<div class='col-12'><p class='text-center'>Không có sản phẩm nào.</p></div>";
                }
                ?>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="text-center">&copy; Dự án web K44E</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
